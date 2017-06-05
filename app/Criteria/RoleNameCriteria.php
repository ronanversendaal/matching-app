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
        $model = $model->where('role_id','=', $this->role_id );

        return $model;
    }
}
