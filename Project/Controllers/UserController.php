<?php

namespace Project\Controllers;

use Project\Models\Users\User;
use Project\Models\Users\WorkCookies;
use Project\Controllers\AbstractController;
use Project\Exceptions\UserException;
use Project\Exceptions\DbException;

class UserController extends AbstractController
{

    public function register()
    {
        if (!empty($_POST)) {
            try {
                $user = User::createRegistrUser($_POST);
            } catch (UserException $ex) {
                $this->view->renderTemplate(
                    'registration/registration.php',
                    [
                        'title'=>'Регистрация',
                        'msg'=>$ex->getMessage(),
                    ]
                );
                exit();
            } catch (DbException $ex) {
                $this->view->renderTemplate(
                    'errors/500.php',
                    ['error' => $ex->getMessage(), 'title' => 'DB Error'],
                    500
                );
                exit();
            }
            if ($user) {
                WorkCookies::makeCookies($user);
                exit();
            }
        }
        $this->view->renderTemplate('registration/registration.php', ['title'=>'Регистрация']);
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::checkAuthUser($_POST);
            } catch (UserException $ex) {
                $this->view->renderTemplate(
                    'login/login.php',
                    [
                        'title'=>'Вход',
                        'msg'=>$ex->getMessage(),
                    ]
                );
                exit();
            } catch (DbException $ex) {
                $this->view->renderTemplate(
                    'errors/500.php',
                    ['error' => $ex->getMessage(), 'title' => 'DB Error'],
                    500
                );
                exit();
            }
            if ($user) {
                WorkCookies::makeCookies($user);
                exit();
            }
        }
        
        $this->view->renderTemplate('login/login.php', ['title'=>'Вход']);
    }

    public function logout()
    {
        setcookie('token', '', -1, "/", '', false, true);
        header('Location: index.php', true, 302);
        exit();
    }
}
