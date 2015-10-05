<?php

/**
 * Link: 
 * File: enviroment.php
 * Namespace: library
 * 
 * Description of enviroment
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.10.05.     HUSzanaI              Created
 * 
 */

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this file directly!</html>";
    exit();
}

namespace library;

class Enviroment {
    
################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
 
################################################################################
# 3. Private Properties ########################################################
################################################################################
    
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Környezeti információkat kérdezhetünk le.
     * 
     * @example \library\Enviroment::GetEnv("DOCUMENT_ROOT");
     * @access      public
     * @param       string      $pin_EnvKey     Környezeti változó neve.
     * @return      string
     */
    public static function GetEnv($pin_EnvKey) {
        // get HTTPS
        if($pin_EnvKey == "HTTPS") {
            if(isset($_SERVER) && !empty($_SERVER)) {
                return(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on");
            }
            else {
                return(strpos(self::GetEnv("SCRIPT_URI"), "https://") === 0);
            }
        }
        if(isset($_SERVER[$pin_EnvKey])) {
            return($_SERVER[$pin_EnvKey]);
        }
        elseif(isset($_ENV[$pin_EnvKey])) {
            return($_ENV[$pin_EnvKey]);
        }
        elseif(getenv($pin_EnvKey) !== false) {
            return(getenv($pin_EnvKey));
        }
        elseif(function_exists("apache_getenv")) { // IIS Server nem támogatja az apache_getenv függvényt.
            if(apache_getenv($pin_EnvKey) !== false) {
                return(apache_getenv($pin_EnvKey));
            }
        }
        // get SCRIPT_FILENAME
        if($pin_EnvKey == "SCRIPT_FILENAME" && defined("SERVER_IIS") && SERVER_IIS === true) {
            return(str_replace("\\\\", "\\", self::GetEnv("PATH_TRANSLATED")));
        }
        // get DOCUMENT_ROOT
        if($pin_EnvKey == "DOCUMENT_ROOT") {
            $loc_Offset = 0;
            if(!strpos(self::GetEnv("SCRIPT_NAME"), ".php")) {
                $loc_Offset = 4;
            }
            return(substr(self::GetEnv("SCRIPT_FILENAME"), 0, strlen(self::GetEnv("SCRIPT_FILENAME")) - (strlen(self::GetEnv("SCRIPT_NAME")) + $loc_Offset)));
        }
        // get PHP_SELF
        if($pin_EnvKey == "PHP_SELF") {
            return str_replace(self::GetEnv("DOCUMENT_ROOT"), "", self::GetEnv("SCRIPT_FILENAME"));
        }
       
        return("");
    }

    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
}

?>