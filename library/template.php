<?php
namespace library;
/**
 * Link: 
 * File: template.php
 * Namespace: library
 * 
 * Description of template
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Pisti              Created
 * 
 */



class Template {

################################################################################
# 1. Constants #################################################################
################################################################################

    /*Hiba a template betöltésekor. */
    const   errLoadTemplate   =   'xtmp0001';

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    /**
     * A template nevét tartalmazó attribútum.
     */
    private static $_templateName       = "";

    /**
     * A template-ek nyers kódját tartalmazó tömb.
     */
    private static $_templateSource     = array();

    /**
     * A template-ek lefordított kódját tartalmazó tömb.
     */
    private static $_templateCompile    = array();

    /**
     * A template változóit tartalmazó tömb.
     */
    private static $_templateVariables  = array();

    /**
     * A template nyelvi elemeit tartalmazó tömb.
     */
    private static $_templateLanguage   = array();

    /**
     * Cache-elés ki be kapcsolása.
     */
    private static $_templateCache      = false;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * Generál egy template azonosítót majd megpróbálja betölteni a template kódját
     * a $_templateSource attribútumba a generált azonosítóval indexelve.
     *
     * @param string $pin_Template              A template neve.
     * @return bool                             Sikeres volt e a betöltés.
     * @version 1.0
     * @access public
     */
    public static function loadTemplate(string $pin_Template) : bool {
        try{
            self::$_templateName = md5($pin_Template);
            self::$_templateSource[self::$_templateName] = File::getFileContent($pin_Template);
            return true;
        }
        catch(\Exception $ex) {
            Debug::setDebugMessage(array(__METHOD__, $ex->getCode(), $ex->getMessage(), $pin_Template));
            return false;
        }

    }

    /**
     * Lefordítja a $_templateName attribútumban megadott template-et majd visszatért
     * a template objektum-al, ami tartalmazza a lefordított és nyers templatet is.
     *
     * @return \stdClass                    A lefordított template objektum.
     * @version 1.0
     * @access public
     */
    public static function renderTemplate() : \stdClass {
        self::_getVariables(self::$_templateName);
        self::_templateCompile(self::$_templateName);
        return self::$_templateCompile[self::$_templateName];
    }


################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################

    /**
     * Visszadja a paraméterben kapott template információit objektumként. Tartalmazza a
     * nyelvi elemeket, változókat, stb.
     *
     * @param string $pin_Template              A template neve.
     * @return \stdClass                        A template információi.
     * @version 1.0
     * @access private
     */
    private static function _getTemplateInfo(string $pin_Template) : \stdClass {
        $loc_Info = new \stdClass();
        $loc_Info->time = date('Y-m-d H:i:s');
        $loc_Info->cache = self::$_templateCache;
        $loc_Info->languageElements = self::_getLanguageElements($pin_Template);
        $loc_Info->variables = self::_getVariables($pin_Template);
        return $loc_Info;
    }

    /**
     * Lekérdezi a paraméterben kapott template változóit, amik %% közé vannak megadva.
     *
     * @param string $pin_Template              A template neve.
     * @example Ez egy %változó_neve% változó.
     * @version 1.0
     * @access private
     */
    private static function _getVariables(string $pin_Template) {
        $loc_Template = self::$_templateSource[$pin_Template];
        preg_match_all("/%(.*)%/", $loc_Template, $loc_Mathces);
        self::$_templateVariables[$pin_Template] = $loc_Mathces[1];
    }

    /**
     * Lekérdezi a paraméterben kapott template nyelvi változóit amik {} között vannak megadva.
     *
     * @param string $pin_Template              A template neve.
     * @example Ez egy nyelvi {változó_neve} változó.
     * @version 1.0
     * @access private
     */
    private static function _getLanguageElements(string $pin_Template) {
        $loc_Template = self::$_templateSource[$pin_Template];
        preg_match_all("/{.*?}/", $loc_Template, $loc_Mathces);
        self::$_templateLanguage[$pin_Template] = $loc_Mathces[0];
    }

    /**
     * @param string $pin_Template
     * @return string
     */
    private static function _getType(string $pin_Template) : string {
        return "";
    }

    /**
     * @param string $pin_Template
     * @return bool
     */
    private static function _getCache(string $pin_Template) : bool {
        return true;
    }

    /**
     * @param string $pin_Mode
     * @return bool
     */
    private static function _setCache(string $pin_Mode) : bool {
        return true;
    }

    /**
     * @param string $pin_Mode
     * @return bool
     */
    private static function _isCache(string $pin_Mode) : bool {
        return ture;
    }

    private static function _addComment() {

    }

    /**
     * @param string $pin_Template
     */
    private static function _setTemplateInfo(string $pin_Template) {
    }

    /**
     * Behelyettesíti a $_templateLanguage attribútumból a nyelvi elemeket a megfelelő helyre. A
     * nyelvi elemek {} között kell legyenek.
     *
     * @param string $pin_Template              A template neve.
     * @return string                           A lefordítot template.
     * @version 1.0
     * @access private
     */
    private static function _translateLanguageVariables(string $pin_Template) : string {
        self::_getLanguageElements($pin_Template);
        
        foreach(self::$_templateLanguage[$pin_Template] as $loc_MatchesValue)
        {
            $loc_Replaced = str_replace(array('{', '}'), array('', ''), $loc_MatchesValue);
            $loc_Const = $loc_Replaced;

            if(\library\Language::getLanguageElement($loc_Replaced)->success)
                 $loc_Const = \library\Language::getLanguageElement($loc_Replaced)->element;
            else
                $loc_Const = $loc_Replaced;
            
            $loc_ReplaceArray[] = $loc_Const;
            $loc_PatternArray[] = '/{'.$loc_Replaced.'}/';
        }

        if(isset($loc_PatternArray)) {
            $loc_ReplacedResult = preg_replace($loc_PatternArray, $loc_ReplaceArray, self::$_templateSource[$pin_Template]);
            return $loc_ReplacedResult;
        }
        else {
            return self::$_templateSource[$pin_Template];
        }
    }

    /**
     * Befordítja a paraméterben kaporr template-et. Kicseréli a nyelvi elemeket,
     * változókat, stb.
     *
     * @param string $pin_Template                  A template neve.
     * @version 1.0
     * @access private
     */
    private static function _templateCompile(string $pin_Template) {
        self::$_templateCompile[$pin_Template] = new \stdClass();
        self::$_templateCompile[$pin_Template]->raw = self::$_templateSource[$pin_Template];
        self::$_templateCompile[$pin_Template]->compiled = self::_translateLanguageVariables($pin_Template);
        self::$_templateCompile[$pin_Template]->info = self::_getTemplateInfo($pin_Template);
    }

}

?>