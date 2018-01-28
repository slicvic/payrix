<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Exceptions\UsernameAlreadyTakenException;
use App\Exceptions\ValidationException;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->view('signup/form.html');
    }

    public function successAction()
    {
        return $this->view('signup/success.html');
    }

    public function signupAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $error = false;

            try {
                $user = new User;
                $user->fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
                $user->username = isset($_POST['username']) ? $_POST['username'] : '';
                $user->password = isset($_POST['password']) ? $_POST['password'] : '';

                $userRepository = new UserRepository;
                $userRepository->insert($user);

                $this->redirect("/?a=success&user={$user->fullname}");
            }
            catch(UsernameAlreadyTakenException $e) {
                $error = $e->getMessage();
            }
            catch (ValidationException $e) {
                $error = $e->getErrors();
            }
            catch (\Exception $e) {
                $error = 'An error occurred. Please try again!';
            }

            return $this->view('signup/form.html', ['error' => $error]);
        }

        return $this->view('signup/form.html');
    }
}
