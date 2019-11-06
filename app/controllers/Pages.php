<?php
    Class Pages extends Controller {
        public function __construct(){
            
        }

        public function index(){
            
        }

        public function about($id = ''){
            echo 'This is the about page, to which we can send parameters. Here they are: <br>';
            echo $id;
        }
    }