<?php 

namespace App\Services\property_master;

use App\Services\property_master\PropertyMasterServices;
use App\Repo\property_master\UnitDescriptionRepo;


class UnitDescriptionServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(UnitDescriptionRepo $repo){
        $this->repo = $repo;
    }
 
    
}