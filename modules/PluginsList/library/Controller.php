<?php
namespace modules\PluginsList\library;
use library\Addon;
use library\File;
use library\Httprequest;
use library\Httpresponse;
use library\Mysql;
use library\Xml;
use library\Zip;

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

    /**
     * A module neve.
     * @var string
     */
    private static $_moduleName = "Pluginslist";

    /**
     * A rendszerbe telepített pluginek listája.
     * @var array
     */
    private $_addonList;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * A main függvénye a module-nak. Ezt indítja a keretrenszer. Minden ebből a fv-ből
     * hívódik.
     * @return string   A module kimenete.
     * @version 1.0
     * @access public
     */
    public function Run() : string {
        switch(Httprequest::getURLElement("url", 2)):
            case "licence":
                return $this->setLicence();
                break;
            default:
                return $this->setAddonsList();
                break;
        endswitch;
    }

    /**
     * Vissza adja a telepített pluginek listát.
     * @return string           A pluginek listája.
     * @version 1.0
     * @acces public
     */
    public function setAddonsList() : string {
        switch(Httprequest::getURLElement("url", 2)):
            case "phpextension":
                $loc_AddonType = 1;
                break;
            case "cssextension":
                $loc_AddonType = 3;
                break;
            case "javascriptextension":
                $loc_AddonType = 2;
                break;
            default:
                $loc_AddonType = null;
        endswitch;

        View::$_addonObj = self::_loadAddons($loc_AddonType);
        return View::Run();
    }

    public function setLicence() : string {
        return View::Licence();
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    /**
     * Betölti a plugineket egy objektumba majd visszatér vele.
     * @return \stdClass        A pluginek információit tartalmazó objektum.
     * @throws \Exception       Kivétel a betöltéskor.
     * @version 1.0
     * @access private
     */
    private static function _loadAddons($pin_AddonType) {
        try {
            $obj_Addons = new Addon();
            return $obj_Addons->getAddons($pin_AddonType);
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################



}