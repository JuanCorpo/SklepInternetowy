<?php

class RoleHelper
{
    public static function IsInRole($roleId)
    {
        $userSession = VariablesHelper::GetSessionValue('user');
        if ($userSession != null) {
            $user = unserialize($userSession);
            return $user->UserRole == $roleId;
        }
        return false;
    }

    public static function IsInClaim($claimId)
    {
        $userSession = VariablesHelper::GetSessionValue('user');
        if ($userSession != null) {
            $user = unserialize($userSession);
            return in_array($claimId, $user->UserClaims);
        }
        return false;
    }
}