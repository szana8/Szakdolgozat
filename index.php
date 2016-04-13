<?php
    /**
     * File: Common.php
     * Description:
     * 
     * 
     *  Version     Date            Author               Changelog   
     *   1.0.0      2015.10.05.     HUSzanaI              Created
     * 
     */

    set_time_limit(0);
    require_once 'library/common.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $loc_Controller = new library\Controller();
    $loc_Controller->Initialize();
?>