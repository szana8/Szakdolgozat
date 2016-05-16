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

    /**
     * A HTTP request inicializálásakor fellépő hiba kódja.
     */
    const   initHttpRequest         = 'xhq0001';


################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################

    /**
     * Ebben a property-ben tároljuk a httpRequest-eket
     * @var array
     */
    private static $_httpRequestArray   = array();
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Inicializáló függvény.
     */
    public static function initialize() {
        self::$_httpRequestArray = array('DateTime' => date('Y-m-d H:i:s'));
        Debug::setDebugMessage(array(__METHOD__, self::initHttpRequest, "{MSG.ERROR.INIT_HTTP_REQEST}", "info", self::$_httpRequestArray['DateTime']));
    }
    
    /**
     * Vissza adja a GET globális változóból a paraméterben megadott elem értékét.
     * @param string $pin_Name        Az elem neve
     * @return string                 Az elem értéke
     * @version 1.0
     * @access public
     */
    public static function getGETElement(string $pin_Name) {
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
     * Vissza adja a POST globális változóból a paraméterben megadott elem értékét.
     * @param string $pin_Name        Az elem neve
     * @return string                 Az elem értéke
     * @version 1.0
     * @access public
     */
    public static function getPOSTData(string $pin_Name) : string {
        if(!empty($_POST[$pin_Name]))
            return $_POST[$pin_Name];
        
        return null;
    }

    /**
     * @param $pin_GetID
     * @param $pin_Index
     * @return mixed
     */
    public static function getURLElement(string $pin_GetID, string $pin_Index) : string {
        if(isset($_GET[$pin_GetID])) {
            $loc_Tmp = $_GET[$pin_GetID];
            $loc_Array = explode("/", $loc_Tmp);
            if(isset($loc_Array[$pin_Index]))
                return $loc_Array[$pin_Index];
        }
        return "";
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
}
?>