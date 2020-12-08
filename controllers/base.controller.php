
<?php

abstract class BaseController  {

    public function __construct () {
    }

    public function view(string $view_name, array $view_data = array(), bool $auth=False) {

        $view = array (
            "view_name" => $view_name,
            "view_data" => $view_data
        );
        if(!$auth)
            return include("views/layouts/full.layout.php");
        return include("views/layouts/auth.layout.php");
    }


    public function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }
}