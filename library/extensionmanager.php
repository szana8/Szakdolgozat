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
    
    const   initExtensionManager         = 'xhq0001';

    const   initExtensionJSFailed        = 'xhq0002';

    const   initExtensionCSSFailed       = 'xhq0003';

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
     * Az modulehoz betöltendő js fileokat tartalmazza.
     * @var array
     */
    private static $_moduleJSExtensions        = array();
    
    /**
     * Az modulehoz betöltendő stílus fileokat tartalmazza.
     * @var array
     */
    private static $_moduleCSSExtensions       = array();
    
    private static $_extensionIni              = 'extensions.ini';
    
################################################################################
# 4. Public Methods ############################################################
################################################################################    
    
    /**
     * 
     */
    public static function initialize() {
        $loc_IniContent = File::getIniContent(APPS_D_CONFIG . 'autoload.ini');
        $loc_Path = null;
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

        self::_registrateExtensions(true);
        Debug::setDebugMessage(array(__METHOD__, self::initExtensionManager, "{MSG.INFO.INITIALIZE_EXT_MANAGER}", "info", ""));
    }
    
    /**
     * 
     */
    public static function registrateExtensions() {
        self::_registrateExtensions(false);
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    /**
     * 
     * @param type $pin_ExtName
     * @return boolean
     */
    private static function _getExtLocation(string $pin_ExtName, string $pin_Type) : string {
        $loc_IniContent = File::getIniContent(APPS_D_CONFIG . self::$_extensionIni);
        foreach ($loc_IniContent->$pin_Type as $loc_Name => $loc_Path) {
            if(trim($loc_Name) == trim($pin_ExtName)) {
                return $loc_Path;
            }
        }
        return false;
    }
    
    /**
     * 
     * @param type $pin_Mode
     */
    private static function _registrateExtensions(bool $pin_Mode = false) {
        if($pin_Mode) {
            if(!empty(self::$_autloadJSExtensions))
                self::_registrateJS (self::$_autloadJSExtensions);
            
            if(!empty(self::$_autloadCSSExtensions))
                self::_registrateCSS (self::$_autloadCSSExtensions);
        }
        if(!empty(self::$_moduleJSExtensions))
            self::_registrateJS (self::$_moduleJSExtensions);
        
        if(!empty(self::$_moduleCSSExtensions))
            self::_registrateCSS (self::$_moduleCSSExtensions);
    }
    
    /**
     * 
     * @param type $pin_JSArray
     * @return boolean
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
     * 
     * @param type $pin_CSSArray
     * @return boolean
     */
    private static function _registrateCSS(array $pin_CSSArray) : bool {
        if(empty($pin_CSSArray))
            return false;

        foreach ($pin_CSSArray as $loc_Path) {
            Httpresponse::addStyleFile(__ROOT_URL__ . $loc_Path);
        }
        return true;
    }
}
?>