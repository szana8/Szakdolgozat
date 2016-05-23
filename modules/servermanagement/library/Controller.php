<?php
namespace modules\servermanagement\library;

use library\Httprequest;

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

    /**
     * @return string
     */
    public function Run() : string {
        switch(Httprequest::getURLElement("url", 2)):
            case "email":
                return $this->_setEmail();
                break;
            case "application":
                return $this->_setApplication();
                break;
            case "ldap":
                return $this->_setLdap();
                break;
            case "language":
                return $this->_setLanguage();
                break;
            default:
                return $this->_setBasic();
                break;
        endswitch;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    private function _setBasic() {
        return View::basic();
    }

    private function _setEmail() {
        return View::email();
    }

    private function _setApplication() {
        return View::application();
    }

    private function _setLdap() {
        return View::ldap();
    }

    private function _setLanguage() {
        return View::language();
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    
    
}
