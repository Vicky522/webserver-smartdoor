<?php

//Các chức năng đăng nhập, đăng kí không cần chứng thực
Router::$web->get("signin", "AuthController::signin_view");
Router::$web->post("signin", "AuthController::signin");
Router::$web->get("login", "AuthController::login_view");
Router::$web->post("login", "AuthController::login");
Router::$web->get("error", "HomeController::error");
Router::$web->get("seen", "HomeController::seen");
Router::$web->get("detail", "HomeController::detail");
Router::$web->post("create", "HomeController::create");
// Các route phía dưới câu này yêu cầu phải chứng thực.
//Tất các các request tới đây đều bị chặn lại ở đây để kiểm tra middeleware
//Ở đây sử dụng 1 call back function. Khi chạy tới Router::Excute() gặp middlware() 
//thì nó sẽ tới đây kiểm tra session, cookie. Nếu check có thì trả về True, phía trong sẽ by pass tiếp tục thực thi 
// nhưng câu truy vấn
Router::$web->all("(.*)", function () {
    if(isset($_COOKIE["token"])){
        $token = $_COOKIE["token"];
        $content = base64_decode($token);
        list($username, $hashed_password) = explode (':', $content);
        if(isset($_SESSION[$username])){
            if($_SESSION[$username] == $token)
                return true;
        }
    }
    return false;
    // if (md5($password, substr(md5($password), 0, 2)) == $hashed_password) {
    //     echo "ok";
    // }
});
// Chạy tới được đây nghĩa là đã chứng thực

Router::$web->get("", "HomeController::index");
Router::$web->get("create", "HomeController::create_view");

Router::$web->get("edit", "HomeController::edit_view");
Router::$web->post("edit", "HomeController::edit");
Router::$web->get("delete", "HomeController::delete");

