<?php

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

namespace library;

class Debug {
    
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
     *
     * @var type 
     */
    public static $_DebugMessage = null;
    
    /**
     *
     * @var type 
     */
    public static $_DebugScreen = null;
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Megnézi hogy a debug mód be van e kapcsolva a config ini file-ban.
     * 
     * @return boolean
     * @version 1.0
     * @access public
     */
    public static function IsDebug() {
        return (boolean)(self::_System()->Debug['DEBUG']);
    }

    /**
     * 
     * @param type $pin_Msg
     * @param type $pin_Class
     * @param type $pin_Function
     */
    public static function DebugMsg($pin_Msg, $pin_Class = null, $pin_Function = null, $pin_Type = null) {
        $loc_Dbt = debug_backtrace(); // Hivási lánc információ lekérdezése.
        $loc_ClassID = isset($loc_Dbt[1]) ? 1 : 0;
        $loc_LineFileID = ($loc_Dbt[0]['function'] === __FUNCTION__ && $loc_Dbt[0]['class'] === __CLASS__) ? 1 : 0;
        $pin_Class = ($pin_Class) ? $pin_Class : (isset($loc_Dbt[$loc_ClassID]['class']) ? $loc_Dbt[$loc_ClassID]['class'] : "");
        $loc_Line = isset($loc_Dbt[$loc_LineFileID]['line']) ? $loc_Dbt[$loc_LineFileID]['line'] : "N/A"; // Hívó elem sora.
        $loc_File = isset($loc_Dbt[$loc_LineFileID]['file']) ? $loc_Dbt[$loc_LineFileID]['file'] : "N/A"; // Hívó elem fájlja. Melyik fájlból hívták meg.
        
        $loc_Calls = array();
        foreach($loc_Dbt as $loc_Key => $loc_Call) {
            if($loc_Key > $loc_LineFileID && isset($loc_Call['class']) && strlen($loc_Call['class'])) {
                $loc_Calls[] = $loc_Call['class']."::".$loc_Call['function'];
            }
        }

        $loc_Message = array(
            'message' => $pin_Msg,
            'line' => $loc_Line,
            'file' => $loc_File,
            'class' => $pin_Class,
            'type' => $pin_Type,
            'function' => $pin_Function,
            'call' => implode(", ", array_reverse($loc_Calls)),
            'backtrace' => "disabled"
        );
        
        self::$_DebugMessage[] = $loc_Message;
        $_SESSION['DebugMessage'][] = $loc_Message;
    }

    
    /**
     * Tömböket és objektumokat jelenít meg szinezve.
     * @example
     *      PSS_Debug::PrintA($_POST);
     * @access      public
     * @param       mixed       $pin_Var        Megjelenítendő tömb vagy objektum.
     * @param       integer     $pin_FontSize   Betűméret.
     * @param       boolean     $pin_Show       A megjelenítést szabályozza. Ha értéke true akkor ki echo-zza, ha false akkor csak visszatér a HTML kóddal.
     * @return      string
     */
    public static function PrintA($pin_Var, $pin_FontSize = 14, $pin_Show = true) {
        // A print_r segítségével megjeleníthető formára hozzuk a $pin_Var változóban tárolt tömböt vagy objektumot.
        // A szövegesen reprezentált tömbben vagy objektumban található HTML kódokat megjeleníthető formára hozzuk,
        // hogy a böngésző ne értelmezze és ne dolgozza fel, hanem csak megjelenítse.
        $loc_Text = htmlspecialchars(print_r($pin_Var, true));
        // Megszínezi az Object szöveget.
        $loc_Text = preg_replace("#(\w+)(\s+Object\s+\()#s", "<span style=\"color: #079700; font-weight: bold;\">$1</span>$2", $loc_Text);
        // Megszínezi a public, private, protected szöveget.
        $loc_Text = preg_replace("#\[(\w+)\:(public|private|protected)\]#", "[<span style=\"color: #000099; font-weight: bold;\">$1</span>:<span style=\"color: #009999; font-weight: bold;\">$2</span>]", $loc_Text);
        // Megszínezi a pontal elválasztott szavakat, melyek a tömb kulcsaiklént szerepelnek.
        $loc_Text = preg_replace("#\[(\w+)\.(\w+)\]#", "[<span style=\"color: #088A08; font-weight: bold;\">$1</span>.<span style=\"color: #009999; font-weight: bold;\">$2</span>]", $loc_Text);
        // Megszínezi a \ jellel elválasztott szavakat, melyek a tömb kulcsaiklént szerepelnek.
        $loc_Text = preg_replace("#\[(\w+)\\\\(\w+)\]#", "[<span style=\"color: #088A08; font-weight: bold;\">$1</span>\\<span style=\"color: #009999; font-weight: bold;\">$2</span>]", $loc_Text);
        // Megszínezi a tömb kulcsait.
        $loc_Text = preg_replace("#\[(\w+)\]#", "[<span style=\"color: #088A08; font-weight: bold;\">$1</span>]", $loc_Text);
        // A speciális html kódokat a böngésző által értelmezhetó html kóddá alakítja.
        $loc_Text = self::_FormatMessage($loc_Text);
        // Megadja a szövegméretet.
        $loc_Text = "<pre style=\"font-size: {$pin_FontSize}px; line-height: {$pin_FontSize}px;\">{$loc_Text}</pre>";
        if($pin_Show) {
            echo $loc_Text;
        }
        else {
            return($loc_Text);
        }
    }
    
    /**
     * A tárolt hibaüzeneteket jeleníti meg táblázat formájában.
     *
     * @example
     *      PSS_Debug::SendMsg("Tipikus hiba", "Test");
     *      PSS_Debug::ShowClassTable();
     * @access      public
     * @param       boolean     $pin_Buffered   Bufferelés bekapcsolása.
     * @param       string      $pin_Param      Az osztályok megjelenítését szabályozza.
     * @return      string
     */
    public static function ShowClassTable($pin_Buffered = false, $pin_Param = "all") {
        if($pin_Buffered) { // Bufferelés bekapcsolása.
            ob_start();
        }
        $loc_Array = $_SESSION['DebugMessage'];
        if(count($loc_Array)) { // Legenerálja a táblázatot és megjeleníti azt.
            
            echo "\n\n<!-- DEBUG INFORMATION BEGIN ".__CLASS__."::".__FUNCTION__." -->\n".
                "<style type=\"text/css\">\n".
                "html, body { overflow: auto !important;}\n".
                "</style>\n".
                "<font face=\"Consolas\" size=\"2\">\n".
                str_repeat(" ", 4)."<table border=\"0\" width=\"100%\" bgcolor=\"#C0504D\">\n";
            foreach($loc_Array as $loc_Class => $loc_Msg) {
                echo str_repeat(" ", 8)."<tr>\n".
                    str_repeat(" ", 12)."<td>\n".
                    str_repeat(" ", 16)."<font color=\"#FFFFFF\" size=\"3\"><b>{$loc_Class}</b></font>\n".
                    str_repeat(" ", 16)."<table border=\"0\" width=\"100%\">\n";
                if(is_array($loc_Msg)) {
                    foreach($loc_Msg as $loc_Key => $loc_Text) {
                       
                        switch($loc_Array[$loc_Class]['type']):
                            case 'error':
                                $loc_BgColor  = "bgcolor=\"#E6B9B8\"";
                                break;
                            case 'info':
                                $loc_BgColor = "bgcolor=\"teal\"";
                                break;
                            case 'success':
                                $loc_BgColor = "bgcolor=\"green\"";
                                break;
                            case 'wrong':
                                $loc_BgColor = "bgcolor=\"#E6B9B8\"";
                                break;
                            default:
                                $loc_BgColor = "bgcolor=\"#E6B9B8\"";
                                break;
                        endswitch;

                        $loc_Bt = "<br>".(isset($loc_Text['backtrace']) ? self::PrintA($loc_Text['backtrace'], 14, false) : "");
                        echo str_repeat(" ", 20)."<tr>\n".
                            str_repeat(" ", 24)."<td width=\"50\" {$loc_BgColor}><center><b><sub>{$loc_Key}</sub></b></center></td>\n".
                            str_repeat(" ", 24)."<td {$loc_BgColor}><font size=\"3\">".
                                 $loc_Text;
                                "</font><font size=\"2\">".
                                "</font>{$loc_Bt}</td>\n".
                            str_repeat(" ", 20)."</tr>\n";
                    }
                }
                echo str_repeat(" ", 16)."</table>\n".
                    str_repeat(" ", 12)."</td>\n".
                    str_repeat(" ", 8)."<tr>\n";
            }
            echo str_repeat(" ", 4)."</table>\n".
                "</font>\n".
                "<!-- DEBUG INFORMATION END ".__CLASS__."::".__FUNCTION__." -->\n";
        }
        if($pin_Buffered) { // Ha buffereltünk akkor visszatérünk a HTML kóddal és nem echo-zunk.
            $loc_Buffer = ob_get_contents();
            ob_end_clean();
            return($loc_Buffer);
        }
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################


    protected static function _System() {
        File::$FileName = "config.ini";
        return (object)File::GetIniContent();
    }

################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    /**
     * A hibakereső üzenetben megadott formázásokat alakítja át HTML formázássá.
     *
     * @example
     * @access      private
     * @param       string      $pin_Msg        Hibakereső üzenet.
     * @return      string
     */
    private static function _FormatMessage($pin_Msg) {
        $loc_Str = $pin_Msg;
        $loc_Str = str_replace("{nbsp}", "&nbsp;", $loc_Str);
        $loc_Str = str_replace("{nbt}", "&nbsp;&nbsp;&nbsp;&nbsp;", $loc_Str);
        $loc_Str = str_replace("{br}", "<br>", $loc_Str);
        $loc_Str = str_replace("{i}", "<i>", $loc_Str);
        $loc_Str = str_replace("{/i}", "</i>", $loc_Str);
        $loc_Str = str_replace("{b}", "<b>", $loc_Str);
        $loc_Str = str_replace("{/b}", "</b>", $loc_Str);
        $loc_Str = preg_replace("#\{color:(\#?[0-9A-Fa-f]{3,6}|(aqua|black|blue|fuchsia|gray|green|lime|maroon|navy|olive|purple|red|silver|teal|white|yellow))\}#", "<span style=\"color: $1;\">", $loc_Str);
        $loc_Str = str_replace("{/color}","</span>", $loc_Str);
        return($loc_Str);
    }
}

?>