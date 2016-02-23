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
    //library\Debug::startDebugTrace();
    
    //library\File::getIniContent(APPS_D_CONFIG . "config.ini");
    $loc_Tmp = \library\Httprequest::getData('url');
    $loc_Script = "alert('{$loc_Tmp}');";
    //\library\Httpresponse::sendContent();
    
    library\Pluginmanager::initialize();
    library\Httpresponse::addScript($loc_Script);
    \library\Httpresponse::sendContent();
?>