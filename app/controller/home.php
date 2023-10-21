<?php

class home extends Controller{
    public function index(){
        $data = Middel::all();
        foreach ($data as $user){
            var_dump($user->username);
        }
        $this->loadView('welcome');
    }

    public function about(){
        $data = User::all();
        $this->loadView('about', $data);
    }
}