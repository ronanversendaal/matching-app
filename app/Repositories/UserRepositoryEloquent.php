<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Match;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Creates a match between volunteer and client
     * 
     * @param  [type] $volunteer [description]
     * @param  [type] $client    [description]
     * @return [type]            [description]
     */
    public function match($volunteer, $client)
    {
        Match::create([
            'user_id' => $volunteer->id,
            'client_id' => $client->id,
        ]);
    }

    /**
     * Unmatches the users by force deleting the record
     * @param  [type] $volunteer [description]
     * @param  [type] $client    [description]
     * @return [type]            [description]
     */
    public function unmatch($volunteer, $client)
    {
        $match = Match::where(['user_id' => $volunteer->id, 'client_id' => $client->id])->first();

        return $match->forceDelete();
    }
}
