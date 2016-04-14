<?php
namespace library;
/**
 * Link: 
 * File: authentication.php
 * Namespace: library
 * 
 * Description of authentication
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Pisti              Created
 * 
 */

class Authentication extends Core {


    /**
     * Viszadja hogy a felhasználó be vna e jeletkezve vagy sem.
     * @return bool
     * @access public
     * @version 1.0
     */
    public static function isAuth() : bool {
        return true;
    }


}

?>