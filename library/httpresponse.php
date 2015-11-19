<?php
namespace library;
/**
 * Link: 
 * File: httpresponse.php
 * Namespace: library
 * 
 * Description of httpresponse
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.11.     HUSzanaI              Created
 * 
 */


if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}

class Httpresponse extends Core {

################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Inicializálja a http választ kezelő osztály. Beállítja a cache-t és az
     * automatikus elküldést.
     * 
     * @return boolean                      Sikeres volt e az inicializálás vagy sem.
     * @version 1.0
     */
    public static function initialize() {
        return true;
    }
    
    /**
     * Elküldi a tartalmat a megfeleő típussal a böngésző felé. Alapértelmezetten
     * HTML-ként küldi el.
     *  
     * @param sttring $pin_ContentType      A tartalom típusa.
     * @return boolean                      Sikeres volt e a küldés vagy sem.
     * @version 1.0
     */
    public static function sendContent(string $pin_ContentType = "HTML") {
        if(!$pin_ContentType)
            return false;
        
        return true;
    }
    
    /**
     * Átirányít egy a $pin_PageURL paraméterben megkapott oldalra.
     * 
     * @param string $pin_PageURL           Az url ahová átirányítani szeretnénk.
     * @return boolean
     * @version 1.0
     */
    public static function redirectPage(string $pin_PageURL) {
        if(!$pin_PageURL)
            return false;
    }
    
    /**
     * Hozzáad egy státuszt a fejléchez.
     * 
     * @param string $pin_HeaderStatus
     * @return boolean
     */
    public static function addHeaderStatus(string $pin_HeaderStatus) {
        return false;
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
}

?>