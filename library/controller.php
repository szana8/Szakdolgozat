<?php
namespace library;

/**
 * Link:
 * File: controller.php
 * Namespace: library
 *
 * Description of file
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2015.10.05.     HUSzanaI              Created
 *
 */

class Controller {

################################################################################
# 1. Constants #################################################################
################################################################################
    
    const   moduleNotExists         = 'xc00001';

    const   moduleExceptionErr      = 'xc00002';



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

    private $_menu          = '';

    private static $_dependecies    = 'dependencies.ini';



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

        $this->_initClasses();
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
            }
            catch (\Exception $e) {
                Debug::setDebugMessage(array(__METHOD__, self::moduleExceptionErr, "{MSG.ERROR.MODULE_EXCEPTION_ERR}", "err", $e->getMessage()));
                $this->ShowErrorPage(500);
            }
        }
        else {
            Debug::setDebugMessage(array(__METHOD__, self::moduleNotExists, "{MSG.ERROR.MODULE_NOT_EXISTS}", "err", $this->_method));
            $this->ShowErrorPage(404);
        }
    }


    /**
     * Ajax hívásoknál használt controller metódus. Ha csak egy div-be szeretnénk betölteni egy module-t
     * vagy egy részét ezt használjuk. Nem generál le menu-t footer-t, stb-t.
     *
     * @param array $pin_Param                         A module neve tömbként.
     * @access public
     * @version 1.0
     */
    public function ajaxCall(array $pin_Param = array()) {
        echo $pin_Param[1];
    }

    /**
     * Alap module betöltő metódus. Megvizsgálja hogy szükséges e authentikáció a module-hoz, ha igen
     * megnézi, hogy a user be van e jelentkezve, ha be van továbbengedi, ha nem átdobja a login page-re.
     *
     * @param array $pin_Param                          A module neve tömbként.
     * @access public
     * @version 1.0
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
        else {
            $this->_loadModule($pin_Param[1]);
        }
    }

    /**
     * Ha hiba van a module betöltésénél ez a metódus végzi el a post process-t majd irányít a megfelelő
     * oldal-ra.
     *
     * @param int $pin_Code                         A hiba kódja
     * @access public
     * @version 1.0
     */
    public function ShowErrorPage(int $pin_Code) {
        echo $pin_Code;
        echo $this->_method;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    /**
     * Protected function a module betöltő metódus-hoz.
     * @param string $pin_Module
     */
    protected function _loadModule(string $pin_Module) {
        @require_once APPS_D_MODS . $pin_Module . APPS_DIRECTORY_SEPARATOR . 'library/Controller.php';
        (string) $loc_Class = '\\modules\\'.$pin_Module.'\\library\\Controller';
        (object) $obj_Ctrl = new $loc_Class;
        $loc_Module = $obj_Ctrl->Run();
        $this->_loadModuleDependecies($pin_Module);


        $loc_CoreElements = $this->_loadCoreElements();
        $this->_loadMenu();
        \library\Httpresponse::sendContent(str_replace(array("<%core.menu%>", "<%core.body%>"), array($this->_menu, $loc_Module), $loc_CoreElements));
    }

    /**
     * Beregisztrálja a module függőségeit a betöltés előtt, hogy a html fejléc biztosan tartalmazza
     * a megfelelő javascript és css fileokat amikre a module-nak szüksége van.
     *
     * @param string $pin_Module                        A module neve
     * @access protected
     * @version 1.0
     */
    protected function _loadModuleDependecies(string $pin_Module) {
        $loc_IniContent = new \stdClass();
        $loc_IniContent = \library\File::getIniContent(APPS_D_MODS . $pin_Module .  '/config/' . self::$_dependecies);
        \library\Extensionmanager::registrateModuleExtensions($loc_IniContent);
    }

    /**
     * Betölti a menüt.
     */
    protected function _loadMenu() {
        $obj_Menu = new \library\Menu();
        $this->_menu = $obj_Menu->createMenu();
    }

    /**
     * Elvégzi a szükséges osztályok inicializálását az oldal betöltése előtt.
     *
     * @access proetcted
     * @version 1.0
     */
    protected function _initClasses() {
        \library\Httprequest::initialize();
        \library\Session::initialize();
        \library\Extensionmanager::initialize();
        \library\Httpresponse::initialize();
        \library\Language::Initialize();
    }

    /**
     * Betölti a keretrendszer core template-jeit.
     *
     * @return string
     * @access protected
     * @version 1.0
     */
    protected function _loadCoreElements() : string {
        \library\Template::loadTemplate(APPS_D_ROOT . 'etc/templates/core.menu.html');
        $loc_Menu = \library\Template::renderTemplate();

        \library\Template::loadTemplate(APPS_D_ROOT . 'etc/templates/core.body.html');
        $loc_Body = \library\Template::renderTemplate();

        \library\Template::loadTemplate(APPS_D_ROOT . 'etc/templates/core.footer.html');
        $loc_Footer = \library\Template::renderTemplate();

        return $loc_Menu->compiled . "\n" . $loc_Body->compiled . "\n" . $loc_Footer->compiled;
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}