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
 *   1.0.0      2015.09.29.     HUSzanaI              Created
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

    public static function arrayToObject($pin_Array, &$pout_Object)
    {
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
    protected static function _DebugMsg($pin_Msg, $pin_Namespace, $pin_Type) {
        Debug::DebugMsg($pin_Msg, $pin_Namespace, "", $pin_Type);
        return($pin_Msg);
    }
   
################################################################################
# 6. Private Methods ###########################################################
################################################################################

}

?>