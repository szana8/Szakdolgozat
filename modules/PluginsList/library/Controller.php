<?php
namespace modules\PluginsList\library;
use library\Addon;
use library\File;
use library\Httpresponse;
use library\Mysql;
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
     * A main függvénye a module-nak. Ezt indítja a keretrenszer.
     * @return string   A module kimenete.
     * @version 1.0
     * @access public
     */
    public function Run() : string {
        /*
        $obj_Zip = new Zip();
        $obj_Zip->setZipFile('test.zip');
        $obj_Zip->getZipStream();
        */

        $obj_Addons = new Addon();
        $obj_Addons->isPOMExists('test.zip');

        return View::Run(self::_loadAddons());
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
    private static function _loadAddons() {
        try {
            $obj_Addons = new Addon();
            return $obj_Addons->getAddons();
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################



}