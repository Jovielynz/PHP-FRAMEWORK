<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        $this->view('auth/login', ['title' => 'Login']);
    }

    public function login(): void
    {
        $user = User::findByEmail((string) $this->request->input('email'));

        if ($user && password_verify((string) $this->request->input('password'), $user['password'])) {
            $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
            $this->flash('Welcome back, ' . $user['name'] . '!');
            $this->redirect('/');
        }

        $this->flash('Invalid email or password.', 'error');
        $this->redirect('/login');
    }

    public function registerForm(): void
    {
        $this->view('auth/register', ['title' => 'Create Account']);
    }

    public function register(): void
    {
        $name  = trim((string) $this->request->input('name'));
        $email = trim((string) $this->request->input('email'));
        $pass  = (string) $this->request->input('password');

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6) {
            $this->flash('Please fill all fields (password at least 6 characters).', 'error');
            $this->redirect('/register');
        }
        if (User::findByEmail($email)) {
            $this->flash('That email is already registered.', 'error');
            $this->redirect('/register');
        }

        $id = User::register($name, $email, $pass);
        $_SESSION['user'] = ['id' => $id, 'name' => $name, 'email' => $email];
        $this->flash('Account created. Happy shopping!');
        $this->redirect('/');
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        $this->flash('You have been logged out.');
        $this->redirect('/');
    }
}
