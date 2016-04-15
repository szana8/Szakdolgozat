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

    /**
     * Az url-ből hívott controller methódus.
     * @var string
     */
    private $_method        = '';

    /**
     * Az alap modul neve.
     * @var string
     */
    private $_mainModule    = 'main';

################################################################################
# 4. Public Methods ############################################################
################################################################################


    /**
     * Megnézzük, hogy volt e module hívás az url-ben, ha volt ellenőrízzük hogy szükséges e authentikáció
     * a module futtatásához, majd elindítjuk. Ha nem volt moule hívás, betöltjük a main module-t.
     *
     * @access public
     * @version 1.0
     */
    public function Initialize() {

        $this->_InitClasses();
        (string) $loc_URL = Httprequest::getGETElement('url');
        (array) $loc_Array = array();

        if(!is_null($loc_URL))
            $loc_Array = explode('/', $loc_URL);
        else
            $loc_Array = array();

        if(!empty($loc_Array))
            $this->_method = $loc_Array[0];
        else {
            $this->_method = 'startModule';
            $loc_Array[1] = $this->_mainModule;
        }

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

    /**
     * @param array $pin_Param
     */
    public function main(array $pin_Param = array()) {
        if(\library\Modulemanager::needAuthentication($this->_method) === true) {
            //ide jön az auth
            $this->_loadModule($this->_method);
        }
    }

    /**
     * @param string $pin_Param
     */
    public function ajaxCall(string $pin_Param) {

    }

    /**
     * @param array $pin_Param
     */
    public function startModule(array $pin_Param = array()) {
        if($pin_Param[1] == '') {
            $pin_Param[1] = $this->_mainModule;
        }

        \library\Language::setModuleLang($pin_Param[1]);
        
        if(\library\Modulemanager::needAuthentication($this->_method) === true) {
            if(Authentication::isAuth()) {
                $this->_loadModule($pin_Param[1]);
            }
            else {
                $this->ShowErrorPage(500);
            }
        }
        else
            $this->_loadModule($pin_Param[1]);
    }

    /**
     * @param int $pin_Code
     */
    public function ShowErrorPage(int $pin_Code) {
        echo $pin_Code;
        echo $this->_method;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    /**
     * @param string $pin_Module
     */
    protected function _loadModule(string $pin_Module) {
        @require_once APPS_D_MODS . $pin_Module . APPS_DIRECTORY_SEPARATOR . 'library/Controller.php';
        (string) $loc_Class = '\\modules\\'.$pin_Module.'\\library\\Controller';

        (object) $obj_Ctrl = new $loc_Class;
        $obj_Ctrl->Run();
    }

    /**
     * @param string $pin_Module
     */
    protected function _loadModuleDependecies(string $pin_Module) {

    }

    /**
     *
     */
    protected function _InitClasses() {
        \library\Httprequest::initialize();
        \library\Session::initialize();
        \library\Extensionmanager::initialize();
        \library\Httpresponse::initialize();
        \library\Language::Initialize();
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}