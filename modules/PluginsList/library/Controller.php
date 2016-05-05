<?php
namespace modules\PluginsList\library;
use library\Addon;
use library\File;
use library\Httpresponse;
use library\Mysql;

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
     * @var string
     */
    private static $_moduleName = "Pluginslist";

    /**
     * @var
     */
    private $_addonList;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * @return string
     */
    public function Run() : string {
        //Httpresponse::addStyleFile(__ROOT_URL__ . 'modules/pluginslist/style/pluginslist.css');

        return View::Run(self::_loadAddons());
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

    /**
     * @return \stdClass
     * @throws \Exception
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