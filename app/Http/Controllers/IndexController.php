<?php namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use App\Repositories\RoleRepositoryEloquent;
use App\Models\Role;
use App\Criteria\RoleNameCriteria;

class IndexController extends Controller{

    /**
     * @var PostRepository
     */
    protected $userRepository;

    public function __construct(UserRepositoryEloquent $userRepository, RoleRepositoryEloquent $roleRepository){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function getIndex()
    {
        
        $role = $this->roleRepository->client;

        $clients = $this->userRepository->pushCriteria(new RoleNameCriteria($role))->all();

        return view('index', ['clients' => $clients]);        
    }
}