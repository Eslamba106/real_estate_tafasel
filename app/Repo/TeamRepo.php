<?php

namespace App\Repo;

use App\Models\Team;
use App\Repo\property_master\PropertyMasterRepo;


class TeamRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Team::class);
    }

}