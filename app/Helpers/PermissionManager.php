<?php


namespace App\Helpers;


use Modules\Ums\Entities\User;

class PermissionManager
{
    public static function hasPendingPermission($project)
    {
        // get user
        $user = User::find(auth()->user()->id);

        if ($project->status != 0) return false;

        if (AuthManager::isAdmin() || (AuthManager::isClient() && $project->author_id == $user->id)) {
            return true;
        }

        return false;
    }

    public static function hasApprovedPermission($project)
    {
        // get user
        $user = User::find(auth()->user()->id);

        if ($project->status != 1) return false;

        if (AuthManager::isAdmin() || (AuthManager::isClient() && $project->author_id == $user->id) || (AuthManager::isCompany() && in_array($user->id, $project->company_id))) {
            return true;
        }

        return false;
    }

    public static function hasAcceptedPermission($project)
    {
        // get user
        $user = User::find(auth()->user()->id);

        if ($project->status != 2) return false;

        if (AuthManager::isAdmin() || (AuthManager::isClient() && $project->author_id == $user->id) || (AuthManager::isCompany() && in_array($user->id, $project->company_id))) {
            return true;
        }

        return false;
    }
}
