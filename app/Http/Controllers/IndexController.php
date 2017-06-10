<?php namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use App\Repositories\RoleRepositoryEloquent;
use App\Criteria\RoleNameCriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var PostRepository
     */
    protected $userRepository;

    public function __construct(UserRepositoryEloquent $userRepository, RoleRepositoryEloquent $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }



    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        
        switch ($user->role->name) {
            case 'volunteer':
                return route('app');
                break;
            case 'executive':
            case 'admin':
            case 'superuser':
                return route('voyager.dashboard');
            default:
                return route('index');
                break;
        }
    }

    public function getIndex()
    {
        $role = $this->roleRepository->client;

        $clients = $this->userRepository->pushCriteria(new RoleNameCriteria($role))->all();

        return view('index', ['clients' => $clients]);
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {

            if(!Auth::user()->approved){

                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * [storeMatch description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeMatch(Request $request)
    {

        try{
            $volunteer = $this->userRepository->find($request->get('user_id'));
            $client = $this->userRepository->find($request->get('client_id'));    

            $this->userRepository->match($volunteer, $client);

            return response()->json([
                'success' => true,
                'message' => 'Uw aanvraag is in behandeling'
            ]);


        } catch ( ModelNotFoundException $e ){
            return response()->json([
                'success' => false,
                'message' => 'Gebruiker niet gevonden of bestaat niet meer.'
            ], 404);
        } catch ( QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Match bestaat al.'
            ], 400);
        }
        catch ( \Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Er is iets mis gegaan.'
            ], 500);
        }
    }

    /**
     * Removes the match
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function destroyMatch(Request $request)
    {
        try{
            $volunteer = $this->userRepository->find($request->get('user_id'));
            $client = $this->userRepository->find($request->get('client_id'));    

            $this->userRepository->unmatch($volunteer, $client);

            return response()->json([
                'success' => true,
                'message' => 'Match ongedaan gemaakt'
            ]);
        } catch ( ModelNotFoundException $e ){
            return response()->json([
                'success' => false,
                'message' => 'Gebruiker niet gevonden of bestaat niet meer.'
            ], 404);
        }
        catch ( \Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Er is iets mis gegaan.'
            ], 500);
        }
    }
}
