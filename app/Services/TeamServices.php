<?php 

namespace App\Services;

use App\Services\property_master\PropertyMasterServices;
use App\Repo\TeamRepo;


class TeamServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(TeamRepo $repo){
        $this->repo = $repo;
    }
 
    
}