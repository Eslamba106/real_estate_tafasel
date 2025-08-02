<?php

namespace App\Services;

use App\Repo\EmployeeRepo;
use App\Services\property_master\PropertyMasterServices;


class EmployeeServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(EmployeeRepo $repo){
        $this->repo = $repo;
    }


}
