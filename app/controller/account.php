<?php

use Rakit\Validation\Validator;

class account extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        //$this->login();
    }

    public function register()
    {
        App::chekLogIn();
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
//                $validation->setMessages([
//                    'username:required' => 'لطفا نام کاربری را وارد کنید',
//                    'email:required' => 'لطفا ایمیل را وارد کنید',
//                    'email:email' => 'ایمیل را به درستی وارد کنید',
//                    'password:required' => 'لطفا پسورد را وارد کنید',
//                    'password:min' => 'حداقل طول پسورد باد یه حرف باشد',
//                    'repassword:required' => 'لطفا تکرار پسورد را وارد کنید',
//                    'repassword:same' => 'پسورد و تکرار آن برابر نیست'
//                ]);
                $validation->validate();
                $errors = $validation->errors();
                $_SESSION['alert'] = $errors->firstOfAll();
                //var_dump($errors);
            } else {
                if (User::where('username', '=', $_POST['username'])->count() == 0 and User::where('email', '=', $_POST['email'])->count() == 0) {
                    User::create(
                        [
                            'username' => $_POST['username'],
                            'email' => $_POST['email'],
                            'password' => md5($_POST['password']),
                        ]
                    );
                    $_POST = null;
                    header('location:' . URLROOT . 'account/login');
                } else {
                    $_SESSION['alert'] = ['count' => 'A user has registered with this username or email'];
                }
            }

        }
        $this->loadView('register', $erorr);
    }









    //Log in Controller
    public function login()
    {
        App::chekLogIn();
        $validator = new Validator;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = $validator->validate($_POST, [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ]);
            if ($validation->fails()) {
                // handling errors
//                $validation->setMessages([
//                    'email:required' => 'لطفا ایمیل را وارد کنید',
//                    'email:email' => 'ایمیل را به درستی وارد کنید',
//                    'password:required' => 'لطفا پسورد را وارد کنید',
//                    'password:min' => 'حداقل طول پسورد باید شش کاراکتر باشد'
//                ]);
                $validation->validate();
                $errors = $validation->errors();
//              var_dump($errors->firstOfAll());
                $_SESSION['alert'] = $errors->firstOfAll();
            }else{
                if (User::where('email' , '=', $_POST['email'])->count() == 1){
                    $user = User::where('email' , '=', $_POST['email'])->first()->toArray();
                    if ($user['password'] == md5($_POST['password'])) {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = User::where('email', '=', $_POST['email'])->get()[0]['username'];
                    }else{
                        $_SESSION['alert'] = ['nopass' => 'The password is incorrect'];
                    }
                }else{
                    if (User::where('email' , '=', $_POST['email'])->count() == 0)
                        $_SESSION['alert'] = ['count' => 'There is no user with this email'];
                }
            }
        }
        $this->loadView('login');
    }

    public function edit(){
        if (isset($_SESSION['login'])) {
            $this->loadView('edit');
        }else{
            $this->login();
        }
    }


    public function logout(){
        session_destroy();
        $this->login();
    }
}