<?php
namespace library;
/**
 * Link: 
 * File: httprequest.php
 * Namespace: library
 * 
 * Description of httprequest
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Pisti              Created
 * 
 */

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}

class Httprequest extends Core {
    
################################################################################
# 1. Constants #################################################################
################################################################################    
    
    const   initHttpRequest         = 'xhq0001';


################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    private static $_httpRequestArray   = array();
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * 
     */
    public static function initialize() {
        self::$_httpRequestArray = array('DateTime' => date('Y-m-d H:i:s'));
        Debug::setDebugMessage(array(__METHOD__, self::initHttpRequest, "{MSG.ERROR.INIT_HTTP_REQEST}", "info", self::$_httpRequestArray['DateTime']));
    }
    
    /**
     * 
     * @param type $pin_Name
     * @return type
     */
    public static function getGETElement($pin_Name) {
        if(isset($_GET[$pin_Name]))
            return $_GET[$pin_Name];
        
        return null;
    }

    /**
     * @return mixed
     */
    public static function getGET() : array {
        return $_GET;
    }

    /**
     * 
     * @return type
     */
    public static function getPOSTData($pin_Name) : string {
        if(!empty($_POST[$pin_Name]))
            return $_POST[$pin_Name];
        
        return null;
    }
    
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
}
?>