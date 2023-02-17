<?php
    $site_title = "Moment 2";
    $divider = " | ";

    //Aktivera felrapprtering
    error_reporting(-1);
    ini_set("display_errors", 1);

    //Autoinkludering av klasser
    spl_autoload_register(function($class_name){
        include 'classes/' . $class_name . '.class.php';
    })
?>