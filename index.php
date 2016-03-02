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
     
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
     
    $_SESSION['DebugMessage'] = null;

    require_once 'library/common.php';
    //library\Debug::startDebugTrace();
?>