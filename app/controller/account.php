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
        $erorr = ['not'];
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
            } else {
                if (User::where('username', '=', $_POST['username'])->count() == 0 and User::where('email', '=', $_POST['email'])->count() == 0) {
                    User::create(
                        [
                            'username' => $_POST['username'],
                            'email' => $_POST['email'],
                            'password' => $_POST['password'],
                        ]
                    );
                    header('location:' . URLROOT . 'account/login');
                } else {
                    array_push($erorr, 'کاربری با این نام کاربری و یا ایمیل ثبت نام کرده است');
//                    $erorr = ['کاربری با این نام کاربری و یا ایمیل ثبت نام کرده است'];
                }
            }

        }
        $this->loadView('register', $erorr);
    }

    public function login()
    {
        $validator = new Validator;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = $validator->validate($_POST, [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ]);
            if ($validation->fails()) {
                // handling errors
                $validation->setMessages([
                    'email:required' => 'لطفا ایمیل را وارد کنید',
                    'email:email' => 'ایمیل را به درستی وارد کنید',
                    'password:required' => 'لطفا پسورد را وارد کنید',
                ]);
                $validation->validate();
                $errors = $validation->errors();
                $_SESSION['alert'] = $errors;
                //var_dump($errors);
            }else{
                if (User::where('email' , '=', $_POST['email'])->count() == 1 and User::where('password' , '=', $_POST['password'])->count() == 1){

                }
            }
        }
        $this->loadView('login');
    }
}