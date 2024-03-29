<?php
    /*
     * Base Controller
     * This loads the models and views
     */
    Class Controller{
        // Load model
        public function model($model){
            // Require the model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate model
            return new $model;
        }

        // Load view
        public function view($view, $data = []){
            // Check if view file exists
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                die('View does not exist');
            }
        }
    }
