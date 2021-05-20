<?php

namespace App\Services\UserService;


interface UserService{
    public function updateUser($request);
    public function updateUserPhoto($request);
    public function getUserPhoto($request);
}