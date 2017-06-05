<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoleRepository;
use App\Models\Role;
use App\Validators\RoleValidator;
use App\Traits\TransformDataTrait;
/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{


    use TransformDataTrait;


    
    /**
     * 
     */
    public function __construct()
    {
        self::setupData($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
