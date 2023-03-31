<?php
    $obj_phpProjects = $gitApiService->FetchPhpProjects();

    foreach($obj_phpProjects as $key=>$value) {
        if(Settings::$debug) echo nl2br("looping through \$obj_phpProjects (obj) (level 1)\n\n");
        if(Settings::$debug) $util->echoKeyValue($key,$value);
        
        if($key == 'items') {
            // $value is an array
            foreach($value as $key2=>$value2) {
                if(Settings::$debug) echo nl2br("looping through items (arr) (level 2)\n\n");
                if(Settings::$debug) $util->echoKeyValue($key2,$value2);
                
                // $value2 is an object
                if(Settings::$debug) {
                    foreach($value2 as $key3=>$value3) {
                        if(Settings::$debug) echo nl2br("looping through item (obj) (level 3)\n\n");
                        if(Settings::$debug) $util->echoKeyValue($key3,$value3);
                    }
                }

                if(
                    is_object($value2)
                    && property_exists($value2, 'id')
                    && property_exists($value2, 'name')
                    && property_exists($value2, 'html_url')
                    && property_exists($value2, 'created_at')
                    && property_exists($value2, 'pushed_at')
                    && property_exists($value2, 'description')
                    && property_exists($value2, 'stargazers_count')
                ) {
                    $phpProject = new PhpProject();
                    $phpProject->repositoryId = $value2->id;
                    $phpProject->name = $value2->name;
                    $phpProject->url = $value2->html_url;
                    $phpProject->createdDate = $value2->created_at;
                    $phpProject->lastPushDate = $value2->pushed_at;
                    $phpProject->description = $value2->description;
                    $phpProject->numberOfStars = $value2->stargazers_count;
                    try{
                        $phpProject->save(); // save data to DB
                    } catch (Exception $e) {
                        if(Settings::$debug) echo nl2br("Caught exception: " .  $e->getMessage() . "\n\n");
                    }
                } else {
                    if(Settings::$debug) echo nl2br("Skipping repository because required data not specified.\n\n");
                }
            }
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(true);
?>