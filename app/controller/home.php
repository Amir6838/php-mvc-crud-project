<?php

class home extends Controller{
    public function index(){
//        $data = User::all('username', 'id' );
        $data = User::where('username', '=', 'hossein')->get();
        foreach ($data as $user){
            var_dump($user->username);
            var_dump($user->id);
        }
        $this->loadView('welcome');
    }

    public function about(){
        $data = User::all();
        $this->loadView('about', $data);
    }
}