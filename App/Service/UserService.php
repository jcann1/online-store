<?php
namespace Shop\Service;

use Shop\Models\Twitter;
use Shop\Models\TwitterQuery;
use Shop\Models\User;
use Shop\Models\UserQuery;

class UserService extends BaseService
{
    public function createUser($user)
    {
        $userModel = new User();
        $userModel->setForename($user->forename);
        $userModel->setSurname($user->surname);
        $userModel->setUsername($user->username);
        $userModel->setPassword($user->password);
        $userModel->setLevel(0);
        $userModel->save();
    }

    public function getUserByUsername($username)
    {
        return (new UserQuery)->findOneByUsername($username) ?? null;
    }

    public function getAllUsers()
    {
        return (new UserQuery)->orderByUserId();
    }
    
    public function createTwitterUser($userId, $data)
    {
        $twitter = new Twitter();
        $twitter->setTwitterApiId($data->id);
        $twitter->setName($data->username);
        $twitter->save();

        $user = (new UserQuery)->findOneByUserId($userId);
        $user->setTwitterId($twitter->getTwitterId());
        $user->save();
    }

    public function getUserByTwitterId($twitterUserId)
    {
        $twitterId = (new TwitterQuery)->findOneByTwitterApiId($twitterUserId);

        if ($twitterId == null)
        {
            return null;
        }
        
        return (new UserQuery)->findOneByTwitterId($twitterId->getTwitterId()) ?? null;
    }

    public function banUserByUserId($userId)
    {
        $user = (new UserQuery)->findOneByUserId($userId);
        $user->setIsBanned(true);
        $user->save();
    }

    public function unBanUserByUserId($userId)
    {
        $user = (new UserQuery)->findOneByUserId($userId);
        $user->setIsBanned(false);
        $user->save();
    }
}