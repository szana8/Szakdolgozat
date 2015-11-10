<?php   
if (!isset($_SESSION)){session_start();}
    /**
     * File: Common.php
     * Description:
     * 
     * 
     *  Version     Date            Author               Changelog   
     *   1.0.0      2015.10.05.     HUSzanaI              Created
     * 
     */
     
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
     
    $_SESSION['DebugMessage'] = null;
    require_once 'library/common.php';

    echo"<pre>" , print_r(library\File::getIniContent(APPS_D_CONFIG . "config.ini")), "</pre>";

    var_dump(library\File::searchFile("NetbeansSettings.zip", APPS_D_ROOT . "documents", true));
    //\library\Controller::main();
?>