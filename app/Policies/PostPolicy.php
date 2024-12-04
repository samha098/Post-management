<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    
         public function create(User $user)
    {
        return $user->hasPermission('create');
    }

    public function update(User $user, Post $post)
    {
        return $user->hasPermission('update');
    }

    public function delete(User $user, Post $post)
    {
        return $user->hasPermission('delete');
    }

    public function view(User $user, Post $post)
    {
        return $user->hasPermission('read');
    }
    
}