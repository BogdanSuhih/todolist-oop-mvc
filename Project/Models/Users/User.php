<?php

namespace Project\Models\Users;

use Project\Models\AbstractActiveRecord;
use Project\Services\Db;
use Project\Exceptions\UserException;

class User extends AbstractActiveRecord
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $authToken;
    protected $passwordHash;
    protected $createdAt;
    protected $camelCaseName;

    public function getNickname(): string
    {
        return $this->nickname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function isUserConfirmed(): bool
    {
        return (bool) $this->isConfirmed;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public static function createRegistrUser(array $data): ?self
    {
        $userData = self::prepareUserData($data);
        $columns = '`nickname`, `email`, `password_hash`, `auth_token`';
        $values = ':nickname, :email, :password, :token';

        if (self::getByNickname($userData['nickname'])) {
            throw new UserException('Пользователь с таким никнейм уже существует');
        } if (self::getByEmail($userData['email'])) {
            throw new UserException('Пользователь с таким e-mail уже существует');
        }

        $userExist = self::createRecord($columns, $values, $userData);
        
        return $userExist ? self::getByEmail($userData['email']) : null;
    }

    public static function checkAuthUser(array $data)
    {
        $userData = self::prepareUserData($data);
        $user = User::getByEmail($userData['email']);
        if (!$user) {
            throw new UserException('Такого пользователя не существует');
        } if (!password_verify($data['password'], $user->getHash())) {
            throw new UserException('Пароль введен неверно');
        }
        
        return $user->setAuthToken($userData['token']) ? $user : false;
    }

    protected static function getByEmail(string $email): ?self
    {
        $db = Db::getInstanse();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE email = :email;',
            [':email' => $email],
            static::class
        );

        return $entities ? $entities[0] : null;
    }
    protected static function getByNickname(string $nickname): ?self
    {
        $db = Db::getInstanse();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `nickname`= :nickname;',
            ['nickname' => $nickname],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    protected static function prepareUserData(array $data): array
    {
        $result = [];

        if (isset($data['nickname'])) {
            $nickname = trim($data['nickname']);
            if (empty($nickname)) {
                    throw new UserException('Введите никнейм');
            } if (preg_match('/[^a-zA-Z0-9]/', $nickname)) {
                    throw new UserException('Никнейм должен состоять только из латинских букв и цифр');
            }
            $result['nickname'] = $nickname;
        }

        $email = strtolower(trim($data['email']));
        if (empty($email)) {
            throw new UserException('Введите емейл');
        } if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new UserException('Введите корректный емейл');
        }
        $result['email'] = $email;

        if (empty($data['password'])) {
            throw new UserException('Введите пароль');
        } if (mb_strlen($data['password']) < 6) {
            throw new UserException('Пароль должен состоять как минимум из 6-ти символов');
        }
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $result['password'] = $password;

        $result['token'] = sha1(random_bytes(100)).sha1(random_bytes(100));

        return $result;
    }

    protected function setAuthToken(string $token): bool
    {
        $this->authToken = $token;
        return $this->updateById($this->getId(), 'auth_token', $token);
    }

    protected function getHash(): string
    {
        return $this->passwordHash;
    }
}
