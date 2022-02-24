<?php

namespace Project\Models\Users;

use Project\Models\AbstractActiveRecord;
use Project\Models\Users\User;

class WorkCookies extends AbstractActiveRecord
{
    public static function makeCookies(User $user)
    {
        $hash = (string)$user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $hash, 0, "/", '', false, true);
        header('Location: index.php', true, 302);
    }

    public static function checkUserCookie(): ?User
    {
        $token = $_COOKIE['token']??'';
        if (empty($token)) {
            return null;
        }
        [$userId, $userToken] = explode(':', $token, 2);

        $user = User::getById($userId, User::class);

        if (empty($user)) {
            return null;
        }
        if ($user->getAuthToken() !== $userToken) {
            return null;
        }
        return $user;
    }
    
    protected static function getTableName(): string
    {
        return 'users';
    }
}
