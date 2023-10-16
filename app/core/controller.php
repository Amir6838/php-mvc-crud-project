<?php
class Controller{

    public function loadModel($model){
        require_once '../app/model/'.$model.'.php';
        return new $model();
    }

    public function loadView($view, $data = []){
        if (file_exists('../app/view/' . $view . '.php')) {
            require_once '../app/view/template/header.php';
            require_once '../app/view/' . $view . '.php';
            require_once '../app/view/template/footer.php';
        }else{
            echo 'View Not Exist';
        }
    }
}