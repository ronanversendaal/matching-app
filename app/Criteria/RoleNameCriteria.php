<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleNameCriteria
 * @package namespace App\Criteria;
 */
class RoleNameCriteria implements CriteriaInterface
{

    private $role_id;

    /**
     * 
     */
    public function __construct($role_id)
    {
       $this->role_id = $role_id; 
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.id','=', $this->role_id );

        return $model;
    }
}
