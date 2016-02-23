<?php
namespace library;
/**
 * Link: 
 * File: pluginmanager.php
 * Namespace: library
 * 
 * Description of pluginmanager
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2016.02.22.     Pisti              Created
 * 
 */
if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}


class Pluginmanager {

################################################################################
# 1. Constants #################################################################
################################################################################    
    
    const   initPluginsManager         = 'xhq0001';

################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    private static $_autloadJSPlugins       = array();
    
    private static $_autloadCSSPlugins      = array();
    
    private static $_moduleJSPlugins        = array();
    
    private static $_moduleCSSPlugins       = array();
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################    
    
    public static function initialize() {
        $loc_IniContent = File::getIniContent(APPS_D_CONFIG . 'extensions.ini');
        foreach ($loc_IniContent->JavaScriptExtensions as $loc_Key => $loc_Path) {
            Httpresponse::addScriptFile(__ROOT_URL__ . $loc_Path);
        }
        
        foreach ($loc_IniContent->CSSExtensions as $loc_Key => $loc_Path) {
            Httpresponse::addStyleFile(__ROOT_URL__ . $loc_Path);
        }
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
}

?>