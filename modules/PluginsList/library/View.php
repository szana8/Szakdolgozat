<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.05.03.
 * Time: 14:00
 */

namespace modules\PluginsList\library;


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

    private static $_moduleName = "Pluginslist";

    private $_addonList;

    private static $_addonString = "";

################################################################################
# 4. Public Methods ############################################################
################################################################################

    public static function Run($pin_AddonObj) : string {
        self::_createAddonList($pin_AddonObj);
        $loc_String = self::_loadTemplate();
        $loc_String = str_replace('%MODULE.LIST.ADDONS_LIST%', self::$_addonString, $loc_String);
        return $loc_String;
    }
################################################################################
# 5. Protected Methods #########################################################
################################################################################

    /**
     * @return string
     */
    private static function _loadTemplate() : string {
        \library\Template::loadTemplate(APPS_D_ROOT . "modules" . APPS_DIRECTORY_SEPARATOR . self::$_moduleName
            . APPS_DIRECTORY_SEPARATOR . "templates" . APPS_DIRECTORY_SEPARATOR . "main.html");
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