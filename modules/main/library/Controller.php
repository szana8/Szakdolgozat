<?php
namespace modules\main\library;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Pisti
 */
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
    
    public static function Run() {
        \library\Httpresponse::addScriptFile(__ROOT_URL__ . 'modules/main/scripts/main.js');
        \library\Httpresponse::sendContent('Ide kerül a module content');
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    
    
}
