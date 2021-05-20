<?php

namespace App\Repositories\UserRepository;


interface UserRepository{
    public function saveUpdateUser($userAuth, $userUpdateData): Object;
    public function savePhotoProfile($userAuth, $photo);
    public function getPhotoProfile($user_id);
}