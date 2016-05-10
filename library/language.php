<?php
namespace library;

/**
 * Link:
 * File: language.php
 * Namespace: library
 *
 * Description of file
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2015.10.05.     HUSzanaI              Created
 *
 */

class Language {

################################################################################
# 1. Constants #################################################################
################################################################################

    /**
     * A nyelvi elemek inicializálása.
     */
    const   langInitSuccess         =   'xl00001';

    /**
     * A nyelvi elem be lett állítva sikeresen.
     */
    const   setLangSuccess          =   'xl00003';

    /**
     * A nyelvi elemet nem sikerült beállítani.
     */
    const   langFileNotExists       =   'xl00004';

    /**
     * Hibás vagy nem létező nyelvi elem.
     */
    const   invalidLangElement      =   'xl00005';

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    /**
     * A nyelvi elemeket tartalmazó tömb.
     * @var array
     */
    private static $_langObj        = array();

    /**
     * Az aktuálisan beállított nyelv nevét tartalmazza.
     * @var string
     */
    private static $_lang           = 'eng';

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * Beállítjuk a keretrendszer nyelvi elemeit.
     *
     * @access public
     * @version 1.0
     */
    public static function Initialize() {
        $_langObj = array();
        self::_loadLanguageCore();
        self::_loadLanguageMenu();
        Debug::setDebugMessage(array(__METHOD__, self::langInitSuccess, "{MSG.INFO.LANG_INIT_SUCCESFULL}", "info"));
    }

    /**
     * Megvizsgálja hogy a $_langObj tartalmazza e a paraméterben kért nyelvi elemet, ha igen
     * visszaadja a nyelvi elem értékét objektumként.
     *
     * @param string $pin_Element                       A nyelvi elem neve.
     * @return \stdClass
     * @access public
     * @version 1.0
     */
    public static function getLanguageElement(string $pin_Element) {
        $loc_Obj = new \stdClass();
        if(isset(self::$_langObj[$pin_Element])) {
            $loc_Obj->success = true;
            $loc_Obj->element = self::$_langObj[$pin_Element];
        }
        else {
            $loc_Obj->success = false;
            Debug::setDebugMessage(array(__METHOD__, self::invalidLangElement, "{MSG.ERROR.INVALID_LANG_ELEMENT}", "err"));
        }
        return $loc_Obj;
    }

    /**
     * Összefésüli a nyelvi elemeket tartalmazó tömböt a paraméterben kapott tömbel,
     * az index alapján, így elkerüljük a duplikációt.
     *
     * @param array $pin_LangArray                      A nyelvi elemeket tartalmazó tömb.
     * @access public
     * @version 1.0
     */
    public static function setLang(array $pin_LangArray) {
        self::$_langObj = array_merge(self::$_langObj, $pin_LangArray);
    }

    /**
     * Betölti a module-hoz tartozó nyelvi file-t.
     *
     * @param string $pin_ModuleName                    A module neve.
     * @access public
     * @version 1.0
     */
    public static function setModuleLang(string $pin_ModuleName) {
        self::_loadModuleLang($pin_ModuleName);
    }

    /**
     * Beállítja a nyelvi elemeket, hogy a JavaScript-ből is tudjuk használni.
     */
    public static function setJavaScriptLanguage() {
        $loc_String = 'var __ROOT__URL = "http://";';

        foreach (self::$_langObj as $loc_Key => $loc_LangItem) {
            //$loc_String .= 'var '.$loc_Key.' = "'.$loc_LangItem.'";\n';
        }
        return $loc_String;
    }

    /**
     * @return array
     */
    public static function getLangObj() {
        return self::$_langObj;
    }

    /**
     * @param array $langObj
     */
    public static function setLangObj($langObj) {
        self::$_langObj = $langObj;
    }
    
    
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################

    /**
     * Privát metódus a keretrendszer nyelvi állományának betöltéséért felel. Ha a paraméter true
     * akkor a debug nyelvi elemeket is betölti.
     *
     * @param bool $pin_Option                          Szükségesek e a debug nyelvi elemek
     * @access private
     * @version 1.0
     */
    private static function _loadLanguageCore(bool $pin_Option = false) {
        if(\library\File::getFileExists(APPS_D_LOCALE . 'core.' . self::$_lang . '.php')) {
            @require_once APPS_D_LOCALE . 'core.' . self::$_lang . '.php';
        }
        else {
            @require_once APPS_D_LOCALE . 'core.eng.php';
            Debug::setDebugMessage(array(__METHOD__, self::langFileNotExists, "{MSG.ERROR.LANG_FILE_NOT_EXISTS}", "err", APPS_D_LOCALE . 'core.' . self::$_lang . '.php'));
        }
        if($pin_Option === true) {
            if(\library\File::getFileExists(APPS_D_LOCALE . 'debug/debug.' . self::$_lang . '.php')) {
                @require_once APPS_D_LOCALE . 'debug/debug.' . self::$_lang . '.php';
            }
            else {
                @require_once APPS_D_LOCALE . 'debug/debug.eng.php';
                Debug::setDebugMessage(array(__METHOD__, self::langFileNotExists, "{MSG.ERROR.LANG_FILE_NOT_EXISTS}", "err", APPS_D_LOCALE . 'debug/debug.eng.php'));
            }
        }
    }

    /**
     * Privát metódus a keretrendszer menü nyelvi állományának betöltéséért felel. Ha a paraméter true
     * akkor a debug nyelvi elemeket is betölti.
     *
     * @param bool $pin_Option                          Opciók
     * @access private
     * @version 1.0
     */
    private static function _loadLanguageMenu(bool $pin_Option = false) {
        if(\library\File::getFileExists(APPS_D_LOCALE . 'core.' . self::$_lang . '.php')) {
            @require_once APPS_D_LOCALE . 'menu.' . self::$_lang . '.php';
        }
        else {
            @require_once APPS_D_LOCALE . 'menu.eng.php';
            Debug::setDebugMessage(array(__METHOD__, self::langFileNotExists, "{MSG.ERROR.LANG_FILE_NOT_EXISTS}", "err", APPS_D_LOCALE . 'core.' . self::$_lang . '.php'));
        }
    }

    /**
     * Privát metódus, betölti a module-hoz tartozó nyelvi elemeket tartalmazó file-t.
     *
     * @param string $pin_ModuleName                        A module neve.
     * @access private
     * @version 1.0
     */
    private static function _loadModuleLang(string $pin_ModuleName) {
        (string) $loc_File = APPS_D_MODS . $pin_ModuleName . APPS_DIRECTORY_SEPARATOR . 'locale/' . $pin_ModuleName . '.' . self::$_lang . '.php';
        if(\library\File::getFileExists($loc_File)) {
            @require_once $loc_File;
        }
        else {
            @require_once APPS_D_MODS . $pin_ModuleName . APPS_DIRECTORY_SEPARATOR . 'locale/' . $pin_ModuleName . '.eng.php';
            Debug::setDebugMessage(array(__METHOD__, self::langFileNotExists, "{MSG.ERROR.LANG_FILE_NOT_EXISTS}", "err", $loc_File));
        }
    }

}

?>