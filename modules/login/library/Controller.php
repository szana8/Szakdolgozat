<?php
namespace modules\login\library;

/**
 * File: Controller.php
 * Namespace: modules\main\library
 *
 *
 *
 *  Version     Date            Author               Changelog
 *  1.0.0       2015.09.29.     HUSzanaI             Created
 *
 */


use library\Extensionmanager;
use library\Httpresponse;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class Controller {

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
    
    public function Run() {
        Httpresponse::addStyleFile(__ROOT_URL__ . 'modules/login/style/login.css');
        
        \library\Httpresponse::addScriptFile(__ROOT_URL__ . 'modules/main/scripts/main.js');
        \library\Template::loadTemplate(APPS_D_ROOT . "modules" . APPS_DIRECTORY_SEPARATOR . "login" .
                                        APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR . "login.html");
        $loc_Template = \library\Template::renderTemplate();
        //\library\Httpresponse::sendContent($loc_Template->compiled);
        return $loc_Template->compiled;
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    
    
}
