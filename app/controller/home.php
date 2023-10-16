<?php

class home extends Controller{
    public function index(){
        $this->loadView('welcome');
    }

    public function about(){
        $data = User::all();
        $this->loadView('about', $data);
    }
}