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


class Extensionmanager {

################################################################################
# 1. Constants #################################################################
################################################################################    
    
    const   initExtensionManager         = 'xhq0001';

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
     * @var type 
     */
    private static $_autloadCSSExtensions      = array();
    
    /**
     * Az modulehoz betöltendő js fileokat tartalmazza.
     * @var type 
     */
    private static $_moduleJSExtensions        = array();
    
    /**
     * Az modulehoz betöltendő stílus fileokat tartalmazza.
     * @var type 
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
            $loc_Path = self::_getExtLocation($loc_Name);
            self::$_autloadJSExtensions = array_push($loc_Path);
        }
        
        foreach ($loc_IniContent->CSSExtensions as $loc_Name) {
            $loc_Path = self::_getExtLocation($loc_Name);
            self::$_autloadCSSExtensions = array_push($loc_Path);
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
    private static function _getExtLocation($pin_ExtName) {
        $loc_IniContent = File::getIniContent(APPS_D_CONFIG . self::$_extensionIni);
        foreach ($loc_IniContent as $loc_Name => $loc_Path) {
            if($loc_Name == $pin_ExtName)
                return $loc_Path;
        }
        return false;
    }
    
    /**
     * 
     * @param type $pin_Mode
     */
    private static function _registrateExtensions($pin_Mode = false) {
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
    private static function _registrateJS($pin_JSArray) {
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
    private static function _registrateCSS($pin_CSSArray) {
        foreach ($pin_CSSArray as $loc_Path) {
            Httpresponse::addStyleFile(__ROOT_URL__ . $loc_Path);
        }
        return true;
    }
}

?>