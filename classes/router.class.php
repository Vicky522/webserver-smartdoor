<?php


class Web {
    public $prefix = "/";
    
    public function __construct () { 
        $this->prefix = "/";
    }
    
    protected function path (string $path) {
        return $this->prefix . $path;
    }

    public function get(string $path, $action) {
        array_push(Router::$gets, array("route" => $this->path($path), "action" => $action, "middleware" => function () {
            return true;
        }));
    }

    public function get_with_middleware(string $path, $middleware, $action) {
        array_push(Router::$gets, array("route" => $this->path($path), "action" => $action, "middleware" => $middleware));
    }

    public function post(string $path, $action) {
        array_push(Router::$posts, array("route" => $this->path($path), "action" => $action, "middleware" => function () {
            return true;
        }));
    }

    public function post_with_middleware($path, $middleware, $action) {
        array_push(Router::$posts, array("route" => $this->path($path), "action" => $action, "middleware" => $middleware));
    }

    public function all($path, $middleware) {
        $this->get_with_middleware($path, $middleware, true);
        $this->post_with_middleware($path, $middleware, true);
    }
}


class Router {
    public static $gets = array();
    public static $posts = array();

    public static $middlewares = array();


    public static $web;

    public static function execute() {
        // Khi co request toi, mothod Router::excute() se duoc goi
        // Ham nay se lay REQUEST_URI, boc tach cac phan nhu route, action
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = "";
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $method = "posts";
                break;
            case 'GET':
                $method = "gets";
                break;
            
            default:
                throw new Exception("Error Processing Request", 1);
                break;
        }
        try {
            foreach (self::$$method as $obj) {
                $value = $obj["action"];
                $key = $obj["route"];

                //Dung regex de kiem tra request, neu sai format thi throw exception
                preg_match("/^" . str_replace("/", "\\/", $key) . "$/u", $path, $matches);
                if ($matches) {
                    //Neu request da dung format thi se duoc vao day
                    //Tại đây kiểm tra xem có quyền đi tiếp hay không, bằng cách kiểm tra middleware
                    //Nếu không có quyền thì redirect về trang login
                    if ($obj["middleware"]() === false) {
                        header('Location: http://localhost:8080/login');
                        die();
                    }
                    //Nếu đã chứng thực thì cho request đi qua và thực thi bình thường
                    if ($value === true) {
                        continue;
                    };

                    $folder_name = "";
                    if (count(explode("/", $value)) == 2) {
                        $folder_name = explode("/", $value)[0] . "/";
                        $value = explode("/", $value)[1];
                    }


                    $arr = explode("::", $value);
                    if (count($arr) < 1) throw new Exception("Error Processing Request", 1);
                    $controller = $arr[0];
                    $method = "index";
                    if (count($arr) == 2) $method = $arr[1];

                    require_once("controllers/" . $folder_name . substr(strtolower($controller), 0, -10) . ".controller.php");
                    if (class_exists($controller)) {
                        $controller_instance = new $controller();
                        if (method_exists($controller_instance, $method)) {
                            call_user_func_array(array($controller_instance, $method), array_splice($matches, 1));
                            exit();
                        }
                    }
                    // throw new Exception("Error Processing Request", 1);
                }
            }
            // Redirect to 404 page
            throw new Exception("Error Processing Request", 1);
        } catch (\Throwable $th) {

            // Return HTML or error page
            echo json_encode(array(
                "status" => false,
                "data" => $th->getMessage()
            ));
        }
    }
}

Router::$web = new Web();