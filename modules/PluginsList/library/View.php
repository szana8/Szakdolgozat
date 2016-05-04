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

    public static function Run(\stdClass $pin_AddonObj) : string {
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
    private static function _createAddonList(\stdClass $pin_AddonObj) {
        foreach ($pin_AddonObj->CSSExtensions as $loc_Key => $loc_Object) {
            self::$_addonString .= '<div class="list-group">
                                        <a class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <h4 class="list-group-item-heading"><img src="'.__ROOT_URL__.'images/plugin.png" width="30px" /> '.$loc_Key.'</h4>
                                                    <p>
                                                        <ul class="list-inline addon-version">
                                                            <li >Installed version: 1.11</li>
                                                            <li>Location: '.$loc_Object.'</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-primary" style="margin-top: 20px;"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p>The '.$loc_Key.' is a CSSExtension. You can not update or delete this. </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
        }

        foreach ($pin_AddonObj->JavaScriptExtensions as $loc_Key => $loc_Object) {
            self::$_addonString .= '<div class="list-group">
                                        <a class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <h4 class="list-group-item-heading"><img src="'.__ROOT_URL__.'images/plugin.png" width="30px" /> '.$loc_Key.'</h4>
                                                    <p>
                                                        <ul class="list-inline addon-version">
                                                            <li >Installed version: 1.11</li>
                                                            <li>Location: '.$loc_Object.'</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-primary" style="margin-top: 20px;"><i class="glyphicon glyphicon-refresh"></i>Update</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p>The '.$loc_Key.' is a JavaScriptExtensions. You can not update or delete this. </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
        }

        foreach ($pin_AddonObj->PHPExtensions as $loc_Key => $loc_Object) {
            self::$_addonString .= '<div class="list-group">
                                        <a class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <h4 class="list-group-item-heading"><img src="'.__ROOT_URL__.'images/plugin.png" width="30px" /> '.$loc_Key.'</h4>
                                                    <p>
                                                        <ul class="list-inline addon-version">
                                                            <li >Installed version: 1.11</li>
                                                            <li>Location: '.$loc_Object.'</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-primary" style="margin-top: 20px;"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p>The '.$loc_Key.' is a PHPExtensions. You can not update or delete this. </p>
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