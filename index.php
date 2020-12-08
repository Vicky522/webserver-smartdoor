<?php

    require_once("classes/router.class.php");
    require_once("routers/web.router.php");

    require_once("./controllers/base.controller.php");
    require_once("./controllers/home.controller.php");
    require_once("./controllers/auth.controller.php");

    Router::execute();


