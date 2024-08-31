<?php

namespace App\ControllerRepo;
use App\BaseRepo\BaseRpo;  
use App\Models\User;
class AuthReprository extends BaseRpo{
  public function __construct(User $user){
    parent::__construct($user);
  }
}