<?php
namespace library;
/**
 * Link: 
 * File: session.php
 * Namespace: library
 * 
 * Description of session
 * 
 * 
 *  Version     Date            Author               Changelog   
 *  1.0.0       2015.11.17.     HUSzanaI             Created
 * 
 */

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}

class Session extends Core {
    
################################################################################
# 1. Constants #################################################################
################################################################################
    
    /**
     * Nem érvényes SESSION név hibakódja.
     */
    const   invalidSessionName      = 'xs00001';
    
    /**
     * Nem érvényes SESSION érték hibakódja.
     */
    const   invalidSessionValue     = 'xs00002';
    
    /**
     * A SESSION értéke nem létezik hibakódja. 
     */
    const   sessionValueNotExists   = 'xs00003'; 
    
    /**
     * A SESSION destroy művelet nem sikerült.
     */
    const   sessionDestroyFailed    = 'xs00004';

################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * Post metódussal átadott ürlapmező nevek melyeket el kell menteni a munkamenetben.
     * @access private
     */
    private static $_formFields = array();
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    
    public static function initialize() {
        session_start();
    }


    
    /**
     * Megvizsgálja, hogy a $pin_SessionName paraméterben kapott session létezik-e,
     * ha igen vosszaadja az értékét. Ha nem létezik a SESSION <b>false</b> értékkel
     * tér vissza.
     * 
     * @param string $pin_SessionName           A SESSION neve, aminek az értékét szeretnénk.
     * @return boolean|string                   A SESSION értéke vagy false ha nem létezik.
     * @version 1.0                   
     */
    public static function getSession(string $pin_SessionName) {
        if(!$pin_SessionName || !isset($_SESSION[$pin_SessionName])) {
            return false;
        }
            
        return $_SESSION[$pin_SessionName];
    }
    
    /**
     * Beállítja a SESSION-t a $pin_SessionName paraméterben kapott azonosítóval
     * és a $pin_SessionValue paraméterben kapott értékkel. Ha a paraméterek nem
     * megfelelőek, <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_SessionName           A SESSION neve amit létre akarunk hozni.
     * @param string $pin_SessionValue          A SESSION értéke amit tárolni akarunk.
     * @return boolean                          Sikeres volt e a SESSION létrehozás vagy sem.
     * @version 1.0
     */
    public static function setSession(string $pin_SessionName, $pin_SessionValue) : bool {
        if(!$pin_SessionName || !$pin_SessionValue) {
            return false;
        }
        $_SESSION[$pin_SessionName] = $pin_SessionValue;
        return true;
    }
    
    /**
     * Törli az összes SESSION munkamenet változókat. Ha sikeres volt a törlés 
     * true-val tér vissza, egyébként false-al.
     * 
     * @return boolean                          Sikeres volt e a törlés vagy sem.
     * @version 1.0
     */
    public static function destroySession() : bool {
        if(session_destroy() === false) {
            Debug::setDebugMessage(array(__METHOD__, self::sessionDestroyFailed, "{MSG.ERROR.SESSION_DESTROY_FAILED}", "err", ""));
            return false;
        }
        session_unset();
        return true;
    }
    
    /**
     * Ha létezik a SESSION, kitörli az értékét. 
     * 
     * @param string $pin_SessionName           SESSION neve amit törölni szeretnénk.
     * @return boolean                          Sikeres volt e a kiürítés vagy sem.
     * @version 1.0
     */
    public static function unsetSession(string $pin_SessionName) : bool {
        if(!$pin_SessionName || !isset($_SESSION[$pin_SessionName])) {
            Debug::setDebugMessage(array(__METHOD__, self::invalidSessionName, "{MSG.ERROR.INVALID_SESSION_NAME}"), "err", $pin_SessionName);
            return false;
        }
        
        unset($_SESSION[$pin_SessionName]);
        return true;
    }
    
    
    public static function saveFormFields() {
        
    }
    
    /**
     * Beregisztráljuk a menteni kívánt form elemeit.
     * @param type $pin_FieldName
     * @return boolean
     */
    public static function registrateForm(string $pin_FieldName) : bool {
        if(!isset(self::$_formFields[$pin_FieldName])) {
            array_push(self::$_formFields, $pin_FieldName);
        }
        return true;
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################
   
    
}

?>