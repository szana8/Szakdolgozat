<?php
/**
 * Link:
 * File: Controller.php
 * Namespace: modules\Pluginslist
 *
 * Description of Controller
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 02.     Pisti                Created
 *
 */

namespace modules\PluginsList\library;

class Controller
{
################################################################################
# 1. Constants #################################################################
################################################################################

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    private static $_moduleName = "Pluginslist";

################################################################################
# 4. Public Methods ############################################################
################################################################################

    public function Run() {
        //\library\Httpresponse::addScriptFile(__ROOT_URL__ . 'modules/main/scripts/main.js');
        \library\Template::loadTemplate(APPS_D_ROOT . "modules" . APPS_DIRECTORY_SEPARATOR . self::$_moduleName .
            APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR . "main.html");
        $loc_Template = \library\Template::renderTemplate();
        return $loc_Template->compiled;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################



}