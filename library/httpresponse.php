<?php
namespace library;
/**
 * Link: 
 * File: httpresponse.php
 * Namespace: library
 * 
 * Description of httpresponse
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.11.     HUSzanaI              Created
 * 
 */


if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
         . " file directly!</html>";
    exit();
}

class Httpresponse extends Core {

################################################################################
# 1. Constants #################################################################
################################################################################
    
    const   errorHttpHeaderSent      = 'xhr0001';
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * A HTML kód készítéséhez template.
     * @var type 
     */
    private static $_htmlCode = array(
        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">",
            "<html xmlns=\"http://www.w3.org/1999/xhtml\">",
            "    <head>",
            "    <!-- STATIC METATAG BEGIN -->",
            "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />",
            "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=8, IE=edge\" >",
            "    <meta name=\"AUTHOR\" content=\"{AUTHOR}\" />",
            "    <meta name=\"COPYRIGHT\" content=\"{COPYRIGHT}\" />",
            "    <meta name=\"GENERATOR\" content=\"{SYSTEM_NAME}\" />",
            "    <link rel=\"shortcut icon\" href=\"{ROOT_URI}logo.ico\" TYPE=\"image/x-icon\" />",
            "    <link rel=\"icon\" href=\"{ROOT_URI}logo.ico\" TYPE=\"image/ico\" />",
            "    <!-- STATIC METATAG END -->",
            "    <!-- ADDED HEADER HTML ELEMENT BEGIN -->",
            "{HTMLHEADER}",
            "    <!-- ADDED HEADER HTML ELEMENT END -->",
            "    <title>{TITLE}</title>",
            "    </head>",
            "    <body>",
            "{HTMLCONTENT}",
            "    </body>",
            "</html>"
    );
    
    /**
     * A Http fejlécben elhelyezendő kódok.
     * @access private
     */
    private static $_httpHeader = array(
        'title' => "",
        'metatag' => array(),
        'script_file' => array(),
        'style_file' => array(),
        'script' => array(),
        'style' => array()
    );
    
    /**
     * Flag amely a HTTP fejléc elküldésekor true-ra vált.
     * @access private
     */
    private static $_sentHeader = false;
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Inicializálja a http választ kezelő osztály. Beállítja a cache-t és az
     * automatikus elküldést.
     * 
     * @return boolean                      Sikeres volt e az inicializálás vagy sem.
     * @version 1.0
     */
    public static function initialize() {
        return true;
    }
    
    /**
     * Elküldi a tartalmat a megfeleő típussal a böngésző felé. Alapértelmezetten
     * HTML-ként küldi el.
     *  
     * @param sttring $pin_ContentType      A tartalom típusa.
     * @return boolean                      Sikeres volt e a küldés vagy sem.
     * @version 1.0
     */
    public static function sendContent($pin_ContentType = "HTML") {
        if(!$pin_ContentType)
            return false;
        
        return true;
    }
    
    /**
     * Átirányít egy a $pin_PageURL paraméterben megkapott oldalra.
     * 
     * @param string $pin_PageURL           Az url ahová átirányítani szeretnénk.
     * @return boolean
     * @version 1.0
     */
    public static function redirectPage($pin_PageURL, $pin_Now = false) {
        if(!$pin_PageURL)
            return false;
        
        if($pin_Now) {
            header('Location: ' . $pin_PageURL); exit();
        }
        else {
            self::_addHttpHeader("Location", $pin_PageURL);
        }
    }
    
    /**
     * Hozzáad egy státuszt a fejléchez.
     * 
     * @param string $pin_HeaderStatus
     * @return boolean
     */
    public static function addHeaderStatus($pin_HeaderStatus) {
        return false;
         
    }
    
    /**
     * Hozzáad egy fájltartalmat jelző elemet a header buffer-hez.
     * 
     * @access      public
     * @param       string      $pin_Filename       A megjelenítendő fájlnév mentés során.
     * @param       string      $pin_Disposition    Meghatározza, hogy mentésre vagy megtekintésre szánjuk e a tartalmat (mentésre: "attachment" megtekintésre: "inline").
     * @return      null
     */
    public static function contentFile($pin_Filename, $pin_Disposition = "inline") {
        self::_AddHttpHeader("Content-Disposition", "{$pin_Disposition}; filename=\"{$pin_Filename}\"");
    }
    
    
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    private static function _addHttpHeader($pin_HeaderType, $pin_HeaderValue = "") {
        if(!self::$_SentHeader) {
            $pin_HeaderType[0] = strtoupper($pin_HeaderType[0]);
            self::$_HttpHeader[] = array($pin_HeaderType, $pin_HeaderValue);
        }
        else {
            Debug::setDebugMessage(array(__METHOD__, self::errorHttpHeaderSent, "{MSG.ERROR.HTTP_HEADER_SENT}", "err", ""));
        }
    }
    
}

?>