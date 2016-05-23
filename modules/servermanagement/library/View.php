<?php
/**
 * Link:
 * File: View.php
 * Namespace: modules\servermanagement\library
 *
 * Description of View
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 21.     Pisti                Created
 *
 */

namespace modules\servermanagement\library;


class View
{
################################################################################
# 1. Constants #################################################################
################################################################################

   const templateDirectory  = APPS_D_ROOT . 'modules' . APPS_DIRECTORY_SEPARATOR . "servermanagement"
   . APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR;

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    private static $_moduleName         = "ServerManagement";

    private $_addonList                 = array();

    private static $_addonString        = "";



    private static $_mainTemplate       =  self::templateDirectory . "servermanagement.html";

    private static $_basicTemplate      = self::templateDirectory . "basic.html";

    private static $_emailTemplate      = self::templateDirectory . "email.html";

    private static $_applicationTemplate = self::templateDirectory . "application.html";

    private static $_ldapTemplate       = self::templateDirectory . "ldap.html";

    private static $_languageTemplate   = self::templateDirectory . "language.html";

    public static $_addonObj;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    public static function basic() : string {
        $loc_TemplateName = self::$_basicTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        $loc_Template = \library\Template::renderTemplate();

        \library\Template::setTemplateData(self::$_mainTemplate, "SERVER.MANAGEMENT.FORM", $loc_Template->compiled);
        \library\Template::setTemplateData(self::$_mainTemplate, "basic-active", 'class="active"');
        $loc_Main = self::_loadMain();
        return $loc_Main;
    }

    public static function email() : string {
        $loc_TemplateName = self::$_emailTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        $loc_Template = \library\Template::renderTemplate();

        \library\Template::setTemplateData(self::$_mainTemplate, "SERVER.MANAGEMENT.FORM", $loc_Template->compiled);
        \library\Template::setTemplateData(self::$_mainTemplate, "email-active", 'class="active"');
        $loc_Main = self::_loadMain();
        return $loc_Main;
    }

    public static function application() : string {
        $loc_TemplateName = self::$_applicationTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        $loc_Template = \library\Template::renderTemplate();

        \library\Template::setTemplateData(self::$_mainTemplate, "SERVER.MANAGEMENT.FORM", $loc_Template->compiled);
        \library\Template::setTemplateData(self::$_mainTemplate, "application-active", 'class="active"');
        $loc_Main = self::_loadMain();
        return $loc_Main;
    }

    public static function ldap() {
        $loc_TemplateName = self::$_ldapTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        $loc_Template = \library\Template::renderTemplate();

        \library\Template::setTemplateData(self::$_mainTemplate, "SERVER.MANAGEMENT.FORM", $loc_Template->compiled);
        \library\Template::setTemplateData(self::$_mainTemplate, "ldap-active", 'class="active"');
        $loc_Main = self::_loadMain();
        return $loc_Main;
    }

    public static function language() {
        $loc_TemplateName = self::$_languageTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        $loc_Template = \library\Template::renderTemplate();

        \library\Template::setTemplateData(self::$_mainTemplate, "SERVER.MANAGEMENT.FORM", $loc_Template->compiled);
        \library\Template::setTemplateData(self::$_mainTemplate, "language-active", 'class="active"');
        $loc_Main = self::_loadMain();
        return $loc_Main;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    private static function _loadMain() : string {
        $loc_TemplateName = self::$_mainTemplate;
        \library\Template::loadTemplate($loc_TemplateName);

        $loc_Template = \library\Template::renderTemplate();
        return $loc_Template->compiled;
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}