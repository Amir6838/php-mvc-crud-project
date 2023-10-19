<?php

use Rakit\Validation\Validator;

class account extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        echo 'index';
    }

    public function register()
    {
        $this->loadView('register');
        $validator = new Validator;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = $validator->validate($_POST, [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:3',
                'repassword' => 'required|same:password',
            ]);

            if ($validation->fails()) {
                // handling errors
                $validation->setMessages([
                    'username:required' => 'لطفا نام کاربری را وارد کنید',
                    'email:required' => 'لطفا ایمیل را وارد کنید',
                    'email:email' => 'ایمیل را به درستی وارد کنید',
                    'password:required' => 'لطفا پسورد را وارد کنید',
                    'password:min' => 'حداقل طول پسورد باد یه حرف باشد',
                    'repassword:required' => 'لطفا تکرار پسورد را وارد کنید',
                    'repassword:same' => 'پسورد و تکرار آن برابر نیست'
                ]);
                $validation->validate();
                $errors = $validation->errors();
                $_SESSION['alert'] = $errors;
                //var_dump($errors);
                exit;
            } else {
                $user = '';
                User::create(
                    [
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'roll' => 0
                    ]
                );
                if ($user){
                    var_dump($user);
                }
            }

        }

    }

    public function login()
    {
        $this->loadView('login');
    }
}