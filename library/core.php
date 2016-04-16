<?php
namespace library;
/**
 * Link: https://github.com/szana8/Szakdolgozat/blob/master/library/core.php
 * File: core.php
 * Namespace: library
 * 
 * Description of core
 * 
 * 
 *  Version     Date            Author               Changelog   
 *  1.0.0       2015.09.29.      HUSzanaI            Created
 * 
 */

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}



class Core {
    
################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
 
################################################################################
# 3. Private Properties ########################################################
################################################################################
    
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * @param array $pin_Array
     * @param \stdClass $pout_Object
     * @return \stdClass
     */
    public static function arrayToObject(array $pin_Array, \stdClass &$pout_Object) : \stdClass {
        foreach ($pin_Array as $loc_Key => $loc_Value)
        {
          if (is_array($loc_Value)) {
            $pout_Object->$loc_Key = new \stdClass();
            self::arrayToObject($loc_Value, $pout_Object->$loc_Key);
          }
          else {
            $pout_Object->$loc_Key = $loc_Value;
          }
        }
        
        return $pout_Object;
    }

    /**
     * @return \stdClass
     */
    public static function arrayToHierarchy(array $pin_List, int $pin_Root) : \stdClass {
        $loc_Parents = array();
        foreach ($pin_List as $loc_Array) {
            $loc_Parents[$loc_Array['parent']][] = $loc_Array;
        }
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    /**
     * Beállítja a Hibakereső üzenetet, ami tartalmazza az üzenetet, sor számát, 
     * file nevét, stb.
     * 
     * @param string $pin_Msg                       Hibakereső Üzenet tömbje
     * @param string $pin_Namespace                 Hívó függvény névtere
     * @param string $pin_Type                      Üzenet típusa
     * @return string                               Hibakereső üzenet
     */
    protected static function _DebugMsg(string $pin_Msg, string $pin_Namespace, string $pin_Type) : string {
        Debug::DebugMsg($pin_Msg, $pin_Namespace, "", $pin_Type);
        return($pin_Msg);
    }

    protected static function _createBranch(&$pin_Parents, $pin_Children) {
        $loc_Tree = array();
        foreach ($pin_Children as $loc_Child) {
           
        }
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}

?>