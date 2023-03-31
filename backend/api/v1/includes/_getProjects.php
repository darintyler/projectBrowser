<?php
    require_once './model/PhpProjectService.php';

    $phpProjectService = new PhpProjectService();
    $arr_phpProjects = $phpProjectService->GetPhpProjects();

    if(Settings::$debug) {
        echo nl2br("var_dump(\$arr_phpProjects) == \n");
        var_dump($arr_phpProjects);
        echo nl2br("\n\n");
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_phpProjects);