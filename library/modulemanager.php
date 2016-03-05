<?php
namespace library;
/**
 * Link: 
 * File: modulemanager.php
 * Namespace: library
 * 
 * Description of modulemanager
 * 
 * 
 *  Version     Date            Author              Changelog
 *   1.0.0      2015.11.28.     Pisti               Created
 * 
 */

class Modulemanager extends Core {

################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    /**
     * A főmodule neve amit mindig betöltünk
     */
    private static $_mainModule         = 'main';
    
    /**
     * Szükség van e authentikációra a module-hoz.
     * @var type 
     */
    private static $_needAuthenticate   = false;
    
    /**
     * A module amit be szeretnénk tölteni.
     * @var type 
     */
    private static $_loadModule         = null;

################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    public static function initialize() {
        //A főmodule-t mindig betöltjük
        //Ha nincs meghatározva betöltendő module akkor a main-be megyünk.
        if(self::$_loadModule == null) {
            @require_once APPS_D_MODS . self::$_mainModule . APPS_DIRECTORY_SEPARATOR . 'library/Controller.php';
            \modules\main\library\Controller::Run();
        }
        else {
            
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