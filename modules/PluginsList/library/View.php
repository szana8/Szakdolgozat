<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.05.03.
 * Time: 14:00
 */

namespace modules\PluginsList\library;

use library\Httprequest;
use library\JavaScript;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class View
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

    private static $_moduleName         = "Pluginslist";

    private $_addonList                 = array();

    private static $_addonString        = "";

    private static $_mainTemplate       = APPS_D_ROOT . "modules" . APPS_DIRECTORY_SEPARATOR . "Pluginslist"
    . APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR . "main.html";

    private static $_licenceTemplate    = APPS_D_ROOT . "modules" . APPS_DIRECTORY_SEPARATOR . "Pluginslist"
    . APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR . "licence.html";

    public static $_addonObj;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    public static function Run() : string {
        $loc_String = self::_loadTemplate();
        return $loc_String;
    }

    public static function Licence() : string {
        $loc_TemplateName = self::$_licenceTemplate;
        \library\Template::loadTemplate($loc_TemplateName);

        $loc_Template = \library\Template::renderTemplate();
        return $loc_Template->compiled;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################


    private static function _setElementsValue() {
        self::_createAddonList(self::$_addonObj);
        $loc_TemplateName = self::$_mainTemplate;
        \library\Template::setTemplateData($loc_TemplateName, "MODULE.LIST.ADDONS_LIST", self::$_addonString);
        \library\Template::setTemplateData($loc_TemplateName, "ext-".Httprequest::getURLElement("url", 2)."-checked", "selected");
    }

    /**
     * @return string
     */
    private static function _loadTemplate() : string {
        $loc_TemplateName = self::$_mainTemplate;
        \library\Template::loadTemplate($loc_TemplateName);
        self::_setElementsValue();

        $loc_Template = \library\Template::renderTemplate();
        return $loc_Template->compiled;
    }

    /**
     * @param \stdClass $pin_AddonObj
     * @return string
     */
    private static function _createAddonList($pin_AddonObj) {

        foreach ($pin_AddonObj as $loc_Key => $loc_Object) {
            switch($loc_Object->type):
                case 1:
                    $loc_Icon = 'php-plugin';
                    break;
                case 2:
                    $loc_Icon = 'plugin';
                    break;
                case 3:
                    $loc_Icon = 'css-plugin';
                    break;
                default:
                    $loc_Icon = 'php-plugin';
            endswitch;

            self::$_addonString .= '<div class="list-group">
                                        <a class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <h4 class="list-group-item-heading"><img src="'.__ROOT_URL__.'images/'.$loc_Icon.'.png" width="30px" /> '.$loc_Object->name.'</h4>
                                                    <p>
                                                        <ul class="list-inline addon-version">
                                                            <li>Installed version: '.$loc_Object->version.'</li>
                                                            <li>Location: '.$loc_Object->location.'</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-primary" style="margin-top: 20px;"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p>'.$loc_Object->description.'</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
        }
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}