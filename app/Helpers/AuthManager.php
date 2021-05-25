<?php


namespace App\Helpers;


use Modules\Ums\Entities\User;

class AuthManager
{
    public static function isAdmin()
    {
        // get user
        $user = User::find(auth()->user()->id);

        // check if admin user
        if ($user->hasRole('admin') || $user->hasRole('super_admin')) {
            return true;
        }

        return false;
    }

    public static function isClient()
    {
        // get user
        $user = User::find(auth()->user()->id);

        // check if client user
        if ($user->hasRole('client')) {
            return true;
        }

        return false;
    }

    public static function isCompany()
    {
        // get user
        $user = User::find(auth()->user()->id);

        // check if company user
        if ($user->hasRole('company')) {
            return true;
        }

        return false;
    }
}
