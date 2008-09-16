<?php

check("./", "*.php");
check("./", "*.inc");
check("./", "*.tpl");
check("./", "*.html");
check("./", "*.ini");


function check($path, $match){
    static $count = 0;
    $dirs = glob($path. "*");
    $files = glob($path. $match);
    foreach($files as $file){
        if (is_file($file)){
            #echo "$file\n";

            $fp = fopen($file, 'r');
            while (!feof($fp)) {
                $line = fgets($fp);
                if (preg_match("/\r\n$/", $line, $matches)) {
                    echo "$file\n";
                    #echo "$line";
                    break;
                }
            }
            fclose($fp);

            $count++;
        }
    }
    foreach($dirs as $dir){
        if(is_dir($dir)){
            $dir = basename($dir) . "/";
            check($path.$dir, $match);
        }
    }
    return $count;
}

?>

