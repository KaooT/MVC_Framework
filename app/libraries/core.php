<?php
    /*
     * App Core Class
     * Creates URL and loads core controller
     * URL FORMAT: /controller/method/params
     */
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->getURL();

            // Check controllers for first value, if exists, set it
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once('../app/controllers/' . $this->currentController . '.php');

            // Instantiate controller
            $this->currentController = new $this->currentController;

            // Check for second part or URL
            if(isset($url[1])){
                // Check if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Get parameters
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getURL(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }