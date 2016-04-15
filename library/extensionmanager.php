<?php
namespace library;
/**
 * Link: 
 * File: extensionmanager.php
 * Namespace: library
 * 
 * Description of extensionmanager
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2016.02.22.     Pisti                Created
 * 
 */
if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}


class Extensionmanager extends Core {

################################################################################
# 1. Constants #################################################################
################################################################################    

    /**
     * Hibakód a bővítménykezelő inicializálásakor.
     */
    const   initExtensionManager         = 'xhq0001';

    /**
     * Hibakód a JavaScript bővítmények regisztrálásakor.
     */
    const   initExtensionJSFailed        = 'xhq0002';

    /**
     * Hibakód a stílus könyvtár bővítmények regisztrálásakor.
     */
    const   initExtensionCSSFailed       = 'xhq0003';

    /**
     * Hibakód a stílus könyvtár bővítmények regisztrálásakor.
     */
    const   initExtensionPHPFailed       = 'xhq0004';

    /**
     * Hibakód a bővítmények helyének meghatározásakor.
     */
    const   missingExtLocation           = 'xhq0005';

################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * Az automatikusan mindig betöltendő js fileokat tartalmazza.
     * @var array 
     */
    private static $_autloadJSExtensions       = array();
    
    /**
     * Az automatikusan mindig betöltendő stílus fileokat tartalmazza.
     * @var array
     */
    private static $_autloadCSSExtensions      = array();

    /**
     * Az automatikusan mindig betöltendő php fileokat tartalmazza.
     * @var array
     */
    private static $_autloadPHPExtensions      = array();

    /**
     * Az modulehoz betöltendő js fileokat tartalmazza.
     * @var array
     */
    private static $_moduleJSExtensions        = array();
    
    /**
     * Az modulehoz betöltendő stílus fileokat tartalmazza.
     * @var array
     */
    private static $_moduleCSSExtensions       = array();

    /**
     * Az modulehoz betöltendő php fileokat tartalmazza.
     * @var array
     */
    private static $_modulePHPExtensions       = array();

    /**
     * A bővítmények elérését tartalmazó ini file.
     * @var string
     */
    private static $_extensionIni              = 'extensions.ini';

    /**
     * A alap bővítmények listálya amit mindig betöltünk.
     * Ezek kellenek az alap rendszer működéséhez.
     * @var string
     */
    private static $_autloadIni                = 'autoload.ini';
    
################################################################################
# 4. Public Methods ############################################################
################################################################################    
    
    /**
     * Inicializáljuk a bővítményeket, amik az autoload.ini-ben vannak be fognak töltődni a lap fejlécében.
     *
     * @version 1.0
     */
    public static function initialize() {
        (object) $loc_IniContent = File::getIniContent(APPS_D_CONFIG . self::$_autloadIni);

        foreach ($loc_IniContent->JavaScriptExtensions as $loc_Name) {
            try {
                self::$_autloadJSExtensions[] = self::_getExtLocation($loc_Name, 'JavaScriptExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionJSFailed, "{MSG.ERR.INITIALIZE_JS_ERROR}", "error", $loc_Name));
            }
        }
        
        foreach ($loc_IniContent->CSSExtensions as $loc_Name) {
            try {
                self::$_autloadCSSExtensions[] = self::_getExtLocation($loc_Name, 'CSSExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionCSSFailed, "{MSG.ERR.INITIALIZE_STYLE_ERROR}", "error", $loc_Name));
            }
        }

        foreach ($loc_IniContent->PHPExtensions as $loc_Name) {
            try {
                self::$_autloadPHPExtensions[] = self::_getExtLocation($loc_Name, 'PHPExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionPHPFailed, "{MSG.ERR.INITIALIZE_PHP_ERROR}", "error", $loc_Name));
            }
        }

        self::_registrateExtensions(true);
        Debug::setDebugMessage(array(__METHOD__, self::initExtensionManager, "{MSG.INFO.INITIALIZE_EXT_MANAGER}", "info", ""));
    }


    /**
     * Regisztrálja a js és css bővítményeket amik a property-ben meg vannak adva.
     *
     * @version 1.0
     */
    public static function registrateExtensions() {
        self::_registrateExtensions(false);
    }

    public static function manualLoadCSSExtension(string $pin_ExtensionURL) {
        self::$_moduleCSSExtensions[] = $pin_ExtensionURL;
    }

    public static function manualLoadJSExtension(string $pin_ExtensionURL) {
        self::$_moduleJSExtensions[] = $pin_ExtensionURL;
    }

    /**
     * @param object $pin_ExtObject
     */
    public static function registrateModuleExtensions($pin_ExtObject) {
        foreach ($pin_ExtObject->JavaScriptExtensions as $loc_Name) {
            try {
                self::$_moduleJSExtensions[] = self::_getExtLocation($loc_Name, 'JavaScriptExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionJSFailed, "{MSG.ERR.INITIALIZE_JS_ERROR}", "error", $loc_Name));
            }
        }

        foreach ($pin_ExtObject->CSSExtensions as $loc_Name) {
            try {
                self::$_moduleCSSExtensions[] = self::_getExtLocation($loc_Name, 'CSSExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionCSSFailed, "{MSG.ERR.INITIALIZE_STYLE_ERROR}", "error", $loc_Name));
            }
        }

        foreach ($pin_ExtObject->PHPExtensions as $loc_Name) {
            try {
                self::$_modulePHPExtensions[] = self::_getExtLocation($loc_Name, 'PHPExtensions');
            }
            catch(\Exception $ex) {
                Debug::setDebugMessage(array(__METHOD__, self::initExtensionPHPFailed, "{MSG.ERR.INITIALIZE_PHP_ERROR}", "error", $loc_Name));
            }
        }
        self::_registrateExtensions(false);
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    /**
     * Megkeresi a bővítmény lokációját az extensions.ini-ben.
     *
     * @param string $pin_ExtName           A bővítmény neve.
     * @param string $pin_Type              A bővítmény típusa.
     * @return boolean
     */
    private static function _getExtLocation(string $pin_ExtName, string $pin_Type) : string {
        (object) $loc_IniContent = File::getIniContent(APPS_D_CONFIG . self::$_extensionIni);
        foreach ($loc_IniContent->$pin_Type as $loc_Name => $loc_Path) {
            if(trim($loc_Name) == trim($pin_ExtName)) {
                return $loc_Path;
            }
        }
        throw new \Exception("{MSG.WRN.MISSING_EXTENSION_LOCATION}", self::missingExtLocation);
    }
    
    /**
     * A paraméter alapján beregisztrálja a bővítményeket.
     *
     * Ha a paraméter true akkor az autload.ini-ből töltjük be a bővítményeket,
     * ha false akkor amit megadtunk a property-kben.
     *
     * @param boolean $pin_Mode             A bővítmény típusa
     * @version 1.0
     */
    private static function _registrateExtensions(bool $pin_Mode = false) {
        if($pin_Mode) {
            if(!empty(self::$_autloadJSExtensions))
                self::_registrateJS (self::$_autloadJSExtensions);
            
            if(!empty(self::$_autloadCSSExtensions))
                self::_registrateCSS (self::$_autloadCSSExtensions);

            if(!empty(self::$_autloadPHPExtensions))
                self::_registratePHP (self::$_autloadPHPExtensions);
        }

        if(!empty(self::$_moduleJSExtensions))
            self::_registrateJS (self::$_moduleJSExtensions);
        
        if(!empty(self::$_moduleCSSExtensions))
            self::_registrateCSS (self::$_moduleCSSExtensions);

        if(!empty(self::$_modulePHPExtensions))
            self::_registratePHP (self::$_modulePHPExtensions);
    }
    
    /**
     * Beregisztrálja a Httpresponse osztályban a paraméterben kapott JavaScript könyvtárakat.
     *
     * @param array $pin_JSArray                    A JavaScript könyvtárak tömbje.
     * @return boolean
     * @version 1.0
     */
    private static function _registrateJS(array $pin_JSArray) : bool {
        if(empty($pin_JSArray))
            return false;

        foreach ($pin_JSArray as $loc_Path) {
            Httpresponse::addScriptFile(__ROOT_URL__ . $loc_Path);
        }
        return true;
    }
    
    /**
     * Beregisztrálja a Httpresponse osztályban a paraméterben kapott stílus könyvtárakat.
     *
     * @param array $pin_CSSArray                   A stílus könyvtárak tömbje.
     * @return boolean
     * @version 1.0
     */
    private static function _registrateCSS(array $pin_CSSArray) : bool {
        if(empty($pin_CSSArray))
            return false;

        foreach ($pin_CSSArray as $loc_Path) {
            Httpresponse::addStyleFile(__ROOT_URL__ . $loc_Path);
        }
        return true;
    }

    /**
     * Beregisztrálja a paraméterben kapott php könyvtárakat.
     *
     * @param array $pin_PHPArray                   A php könyvtárak tömbje.
     * @return boolean
     * @version 1.0
     */
    private static function _registratePHP(array $pin_PHPArray) : bool {
        if(empty($pin_PHPArray))
            return false;

        foreach ($pin_PHPArray as $loc_Path) {
            @require_once APPS_D_ROOT . $loc_Path;
        }
        return true;
    }
}
?>