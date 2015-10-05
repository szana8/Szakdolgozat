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

    $_SESSION['DebugMessage'] = null;
    @require_once 'library/Common.php';
    //\library\Controller::main();
?>