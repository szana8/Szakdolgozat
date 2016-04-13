<?php
/**
 * Created by PhpStorm.
 * User: Pisti
 * Date: 2016. 04. 13.
 * Time: 19:38
 */

namespace library;


class Controller {

################################################################################
# 1. Constants #################################################################
################################################################################

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Private Properties ########################################################
################################################################################

    private $_method        = '';

    private $_mainModule    = 'main';

################################################################################
# 4. Public Methods ############################################################
################################################################################


    /**
     *
     */
    public function Initialize() {

        $loc_URL = Httprequest::getGETElement('url');
        if(!is_null($loc_URL))
            $loc_Array = explode('/', $loc_URL);
        else
            $loc_Array = null;

        if(!is_null($loc_Array))
            $this->_method = $loc_Array[0];
        else
            $this->_method = $this->_mainModule;

        if(method_exists($this, $this->_method)) {
            try {
                call_user_func_array(array($this, $this->_method), array($loc_Array));
            } catch (\Exception $e) {
                $this->ShowErrorPage(500);
            }
        }
        else {
            $this->ShowErrorPage(404);
        }
    }

    public function main(array $pin_Param = array()) {
        if(\library\Modulemanager::needAuthentication($this->_method) === true) {
            //ide jön az auth
            $this->_loadModule($this->_method);
        }
        else {
            //$this->_loadModule($this->_method);

        }
    }

    public function ajaxCall(string $pin_Param) {

    }

    public function ShowErrorPage(Integer $pin_Code) {
        
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################

    public function _loadModule(string $pin_Module) {
        @require_once APPS_D_MODS . $pin_Module . APPS_DIRECTORY_SEPARATOR . 'library/Controller.php';
        $loc_Ctrl = new \modules\main\library\Controller;
        $loc_Ctrl->Run();
    }

    protected function _InitClasses() {

        \library\Httprequest::initialize();
        \library\Session::initialize();
        \library\Extensionmanager::initialize();

        //\library\Httpresponse::initialize();
        //\library\Language::initialize();
        //\library\Modulemanager::initialize();
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}