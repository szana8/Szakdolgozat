<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.14.
 * Time: 16:10
 */

namespace library;


class Language {

################################################################################
# 1. Constants #################################################################
################################################################################

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    private static $_langObj        = array();

    private static $_lang           = 'eng';

################################################################################
# 4. Public Methods ############################################################
################################################################################


    public static function Initialize() {
        $_langObj = array();
        self::_loadLanguageCore();
    }

    public static function getLanguageElement(string $pin_Element) {
        //var_dump(self::$_langObj);
        $loc_Obj = new \stdClass();
        $loc_Obj->success = true;
        $loc_Obj->element = self::$_langObj[$pin_Element];

        return $loc_Obj;
    }


    public static function setLang(array $pin_LangArray) {
        self::$_langObj = array_merge(self::$_langObj, $pin_LangArray);
    }

    public static function setModuleLang(string $pin_ModuleName) {
        self::_loadModuleLang($pin_ModuleName);
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################

    private static function _loadLanguageCore() {
        @require_once(APPS_D_LOCALE . 'core.' . self::$_lang . '.php');
    }

    private static function _loadModuleLang(string $pin_ModuleName) {
        require_once APPS_D_MODS . $pin_ModuleName . APPS_DIRECTORY_SEPARATOR . 'locale/' . $pin_ModuleName . '.' . self::$_lang . '.php';
    }

}

?>