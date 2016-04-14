<?php
namespace library;
/**
 * Link: 
 * File: debug.php
 * Namespace: library
 * 
 * Description of debug
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.10.05.     HUSzanaI              Created
 * 
 */

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}


class Debug {
    
################################################################################
# 1. Constants #################################################################
################################################################################
    
    /**
     * A debug SESSION neve ahol az üzeneteket tároljuk.
     */
    const   debugSessionName            =  'APP_DEBUG_SESSION';
    
    /**
     * Aktív e a debug trace vagy sem.
     */
    const   debugSessionTrace           =  'APP_DEBUG_TRACE';
    
    /**
     * A Debug trace file neve, ahol a trace üzeneteket tároljuk
     */
    const   debugSessionTraceName       =  'APP_DEBUG_TRACE_NAME';
    
    /**
     * A Debug módot tároljuk ebben a SESSION-ben
     */
    const   debugSessionMode            =  'APP_DEBUG_MODE';
    
    /**
     * A Debug üzenetek szintjét tároljuk ebben a SESSION-ben.
     */
    const   debugSessionLevel           =  'APP_DEBUG_LEVEL';

################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * Debug üzenetek tárolására szolgáló attribútum.
     * 
     * @var type 
     */
    private static $_debugMessages = "";

    /**
     * Trace üzenetek tárolására szolgáló attribútum.
     * @var string
     */
    private static $_traceMessage = "";

    /**
     * A különböző debug módok tömbje.
     * 
     * @var array 
     */
    private static $_debugMode = array("comment", 
                                       "screen",
                                       "file", 
                                       "none");
    
    /**
     * Az ini file helye ahol a debug configurációját tároljuk.
     * 
     * @var type 
     */
    private static $_debugIniFile = APPS_D_CONFIG . 'config.ini';
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Vissza adja a debug üzeneteket tartalmazó tömb-öt, a $pin_DebugLevel paraméter-ben
     * kapott szintnek megfelelően. Ha nincs debug üzenet <b>false</b> értékkel
     * tér vissza.
     * 
     * @param string $pin_DebugLevel            A debug üzenetek típusa (ALL, ERROR, WARNING, NOTICE)
     * @return array                            A debug üzeneteket tartalmazó tömb.
     * @version 1.0
     */
    public static function getDebugMessage(string $pin_DebugLevel = "ALL") : string {
        if(!$pin_DebugLevel)
            return false;
        
        return Session::getSession(self::debugSessionName);
    }
    
    /**
     * Vissza adja a debug üzenetek tárolásának szintjét. A default szint az ALL.
     * 
     * @return string                           A debug üzenetek tárolásának szintje.
     * @version 1.0
     */
    public static function getDebugLevel() {
        return Session::getSession((string) self::debugSessionLevel);
    }
    
    /**
     * Vissza adja a debug üzenetek megjelenítési módját. Pl. Comment-ha a forráskódban
     * komment-ként jelenik meg, Screen ha a képernyőre íratjuk, stb. A teljes listát
     * lsd. dokumentáció->debug osztály->_debugMode attrubútum.
     * 
     * @return string                           A debug üzenetek megjelenítési módja.
     * @version 1.0
     */
    public static function getDebugMode() {
        return Session::getSession((string) self::debugSessionMode);
    }
    
    /**
     * Hozzáadja a megadott hibaüzenetet tartalmazó tömböt a többi debug üzenethez.
     * Ha nincs debug üzenet <b>false</b> értékkel tér vissza.
     * 
     * @param array $pin_MessageArray           A debug üzenetet tartalmazó tömb.      
     * @return boolean                          Sikeres volt e a hozzáadás vagy sem.
     * @version 1.0
     */
    public static function setDebugMessage(array $pin_MessageArray) : bool {
        if(empty($pin_MessageArray))
            return false;

        if(Session::getSession(self::debugSessionTrace) === true) {
            if(Session::getSession(self::debugSessionTraceName) != "") {
                self::_setDebugTraceMessage($pin_MessageArray);
            }
        }
        return true;
    }
    
    /**
     * Beállítja a debug üzenetek tárolási módját. Alapértelmezetten minden üzenetet
     * tárolunk. 
     * 
     * @param string $pin_DebugLevel            A debug üzenetek megjelenítési módja.
     * @return boolean                          Sikeres volt e a beállítás vagy sem.
     * @version 1.0
     */
    public static function setDebugLevel(string $pin_DebugLevel) : bool {
        if(!$pin_DebugLevel)
            return false;
        
        return Session::setSession(self::debugSessionLevel, $pin_DebugLevel);
    }
    
    /**
     * Beállítja a debug módot. Pl. comment-ha a forráskódban comment-ként jelenik 
     * meg, screen ha a képernyőre íratjuk, stb. A teljes listát lsd. 
     * dokumentáció->debug osztály->_debugMode attrubútum.
     * 
     * @param string $pin_DebugMode             A debug mód amit be szeretnénk állítani
     * @return boolean                          Sikeres volt e a beállítás vagy sem.
     * @version 1.0
     */
    public static function setDebugMode(string $pin_DebugMode) : bool {
        if(!$pin_DebugMode)
            return false;
        
        if(in_array($pin_DebugMode, self::$_debugMode))
            return Session::setSession(self::debugSessionMode, $pin_DebugMode);
    }
    
    /**
     * Elindítja a debug trace-t. Ilyenkor minden esemény, alprogram hívás log-olva
     * van a debug/trace mappában.
     * 
     * @return boolean                          Elindult e a debug trace vagy sem.
     * @version 1.0
     */
    public static function startDebugTrace() : bool {
        if(!Session::getSession(self::debugSessionTraceName)) {
            (string) $loc_FileName = APPS_D_TRACE . "l" . strtotime(date("".DEFAULT_DATE_FORMAT."")) . ".trc";
            File::createFile($loc_FileName, "Start debug trace: " . date("".DEFAULT_DATE_FORMAT.""));
            Session::setSession(self::debugSessionTrace, true);
            return Session::setSession(self::debugSessionTraceName, $loc_FileName);
        }

        return true;
    }

    /**
     * Megállítja a debug trace-t.
     *
     * @return boolean                          Sikeres volt e a művelet vagy sem.
     * @version 1.0
     */
    public static function stopDebugTrace() : bool {
        (string) $loc_Filename = "";
        fclose($loc_Filename);
        Session::setSession(self::debugSessionTrace, false);
        
        return Session::unsetSession(self::debugSessionTraceName);
    }
    
    /**
     * Lekérdezi a debug.ini-ben beállított értékeket, majd visszaadja hogy be van
     * e állítva a debugolás vagy sem.
     * 
     * @return boolean                          Be van e állítva a debugolás vagy sem.
     * @version 1.0
     */
    public static function isDebug() : bool {
        (object) $loc_IniObj = File::getIniContent(self::$_debugIniFile);
        foreach($loc_IniObj as $loc_Key => $loc_Value) {
            if(($loc_Key == "DEBUG") && ($loc_Value == 'true'))
                return true;
        }
        return true;
    }
    
    /**
     * Vissza adja, hogy a debug üzenetek trace-elve vannak e. Ha igen az debug üzenetek
     * és az hívási lánc log-golásra kerül a debug/trace mappába.
     * 
     * @return boolean                          A debug trace be van kapcsolva.
     * @version 1.0
     */
    public static function isDebugTrace() : bool {
        return Session::getSession(self::debugSessionTrace);
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    /**
     * Szétszedi a debug message tömböt és visszaad-ja azt amit a $pin_DebugKey-ben
     * megadtunk.
     * 
     * @param array $pin_DebugMessage           A dbug üzenetet tartalmazó tömb.
     * @param string $pin_DebugKey              A debug tömb egy kulcsa.
     * @return string                           A debug tömb[kulcs] értéke.
     * @version 1.0
     */
    private static function parseDebugMsg(array $pin_DebugMessage, string $pin_DebugKey) : bool {
        if(empty($pin_DebugMessage) || !$pin_DebugKey)
            return false;

        (string) $loc_MsgBckTrc  = $pin_DebugMessage[0];
        (string) $loc_MsgCode    = $pin_DebugMessage[1];
        (string) $loc_MsgValue   = $pin_DebugMessage[2];
        (string) $loc_MsgType    = $pin_DebugMessage[3];
        (string) $loc_MsgFile    = $pin_DebugMessage[4];
        
        self::$_debugMessages = "\n" . date("Y-M-d H:i:s") . " " . $loc_MsgType . ": "
                                . $loc_MsgCode . " " . $loc_MsgBckTrc . " " . $loc_MsgValue . " " . $loc_MsgFile;
        
        return true;
    }
    
    /**
     * Összeállítja a debug trace üzenetet a $pin_DebugMessage paraméterben kapott
     * tömb-ből, majd visszatér vele.
     * 
     * @param array $pin_DebugMessage           A Debug üzenetet tartalmazó tömb.
     * @return string                           A debug trace üzenet.
     * @version 1.0
     */
    private static function _parseTraceMsg(array $pin_DebugMessage) : bool {
        (string) $loc_MsgBckTrc  = $pin_DebugMessage[0];
        (string) $loc_MsgCode    = $pin_DebugMessage[1];
        (string) $loc_MsgValue   = $pin_DebugMessage[2];
        (string) $loc_MsgType    = $pin_DebugMessage[3];
        (string) $loc_MsgFile    = $pin_DebugMessage[4];
        
        self::$_traceMessage = "\n" . date("Y-M-d H:i:s") . " " . $loc_MsgType . ": "
                                . $loc_MsgCode . " " . $loc_MsgBckTrc . " " . $loc_MsgValue . " " . $loc_MsgFile;
        
        return true;
    }
    
    /**
     * Beállítja a debug trace üzenetet, majd beírja file-ba. 
     * 
     * @param array $pin_DebugMessage           A debug üzenetet tartalmazó tömb.
     * @return boolean                          Sikeres volt e a file-ba írás vagy sem.
     */
    private static function _setDebugTraceMessage(array $pin_DebugMessage) : bool {
        self::_parseTraceMsg($pin_DebugMessage);
        return File::updateFile(Session::getSession(self::debugSessionTraceName), self::$_traceMessage);
    }
    
}

?>