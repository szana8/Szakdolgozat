<?php
namespace modules\main\library;

/**
 * File: Controller.php
 * Namespace: modules\main\library
 *
 *
 *
 *  Version     Date            Author               Changelog
 *  1.0.0       2015.09.29.     HUSzanaI             Created
 *
 */


use library\Mysql;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class Controller {

################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    public function Run() {
        return View::Run();
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    
    
}
