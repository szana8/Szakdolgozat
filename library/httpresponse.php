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

    /**
     *  Hiba a http fejléc küldésekor. 
     */
    const   errorHttpHeaderSent     = 'xhr0001';
    
    /**
     * Invalid meta tag. 
     */
    const   invalidMetaTag          = 'xhr0002';
    
    /**
     * Gyorsító tárazás kikapcsolva.
     */
    const   cacheDisabled           = 'xhr0003';
    
    /**
     * Egy JavaScript file hozzáadva.
     */
    const   addScriptFile           = 'xhr0004';
    
    /**
     * Egy stílus file hozzáadva.
     */
    const   addStyleFile            = 'xhr0005';
    
    /**
     * Egy JavaScript kód hozzáadva.
     */
    const   addScript               = 'xhr0006';
    
    /**
     * Egy stílus kód kozzáadva.
     */
    const   addStyle                = 'xhr0007';
    
    /**
     * Egy HTTP title hozzáadva.
     */
    const   addTitle                = 'xhr0008';
    
    /**
     * Egy HTTP fejléchozzáadva.
     */
    const   addHeader               = 'xhr0009';
    
################################################################################
# 2. Public Properties #########################################################
################################################################################
    
################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * HTTP fejléceket tartalmazó tömb.
     * 
     * @var type 
     */
    private static $_httpHeader = array();
    
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
    private static $_htmlHeader = array(
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
    
    /**
     * Engedélyezett meta-tag
     * @access private
     */
    private static $_MetaTags = array(
        "title",
        "description",
        "keywords",
        "robots",
        "revisit-after",
        "expires",
        "date",
        "publisher",
        "made",
        "replay to",
        "subject",
        "page-topic",
        "page-type",
        "audience",
        "rating"
    );
    
    /**
     * A content típusa amit elküldünk a böngésző felé.
     * @var array
     */
    private static $_contentType = "";
    
    /**
     * A content karakter típusa.
     * @var string
     */
    private static $_charset = "";
    
    /**
     * Az eredmény küldésének típusa.
     * @var string 
     */
    private static $_sendType = "";
    
    /**
     * El lett e küldve már a tartalom.
     * @var boolean
     */
    private static $_sentContent = false;
    
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
    public static function sendContent($pin_Content = null, $pin_ContentType = "HTML") {
        if(!$pin_ContentType)
            return false;
        
        //ide jön még egy ellenőrzés hogy ajax vagy html vagy egyéb e
        self::_sendContentHTML($pin_Content);
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
        self::_AddHttpHeader("HTTP/1.1 {$pin_HeaderStatus} ".self::$_StatusCodes[$pin_HeaderStatus]); 
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
    
    /**
     * Hozzáad egy MetaTag elemet a HTML fejléchez.
     * @param string $pin_Type              A metatag típusa
     * @param string $pin_Content           A metatag tartalma
     */
    public static function addMetaTag($pin_Type, $pin_Content = "") {
        $pin_Type = strtolower($pin_Type);
        if(in_array($pin_Type, self::$_MetaTags)) {
            self::$_htmlHeader['metatag'][$pin_Type] = $pin_Content;
        }
        else {
            Debug::setDebugMessage(array(__METHOD__, self::invalidMetaTag, "{MSG.ERROR.INVALID_META_TAG}", "err", $pin_Type));
        }
    }
    
    /**
     * Hozzáad egy JavaScript file-t a fejléchez.
     * @param string $pin_URL               A Javascript file url-je.
     */
    public static function addScriptFile($pin_URL) {
        self::$_htmlHeader['script_file'][] = $pin_URL;
        Debug::setDebugMessage(array(__METHOD__, self::addScriptFile, "{MSG.SUCC.ADD_SCRIPT_FILE}", "info", $pin_URL));
    }
    
    /**
     * Hozzáad egy CSS stílus file-t a fejléchez.
     * @param string $pin_URL               A css file url-je
     */
    public static function addStyleFile($pin_URL) {
        self::$_htmlHeader['style_file'][] = $pin_URL;
        Debug::setDebugMessage(array(__METHOD__, self::addStyleFile, "{MSG.SUCC.ADD_STYLE_FILE}", "info", $pin_URL));
    }
    
    /**
     * Hozzáad egy javascript kódot a fejléchez.
     * @param string $pin_Script            A javascript kód
     */
    public static function addScript($pin_Script) {
        self::$_htmlHeader['script'][] = $pin_Script;
        Debug::setDebugMessage(array(__METHOD__, self::addScript, "{MSG.SUCC.ADD_SCRIPT}", "info", $pin_Script));
    }
    
    /**
     * Hozzáad egy CSS kódot a fejléchez.
     * @param string $pin_Style             A CSS kód.
     */
    public static function addStyle($pin_Style) {
        self::$_htmlHeader['style'][] = $pin_Style;
        Debug::setDebugMessage(array(__METHOD__, self::addStyle, "{MSG.SUCC.ADD_STYLE}", "info", $pin_Style));
    }
    
    /**
     * Beállítja a HTML címét.
     * @param string $pin_Title             A HTML oldal címe.
     */
    public static function setTitle($pin_Title) {
        self::$_htmlHeader['title'] = $pin_Title;
        Debug::setDebugMessage(array(__METHOD__, self::addTitle, "{MSG.SUCC.ADD_TITLE}", "info", $pin_Title));
    }
    
    /**
     * Letílt minden Cache-lést.
     * @example
     * @access      public
     * @return      null
     */
    public static function NoCache() {
        self::_AddHttpHeader("Pragma", "no-cache");
        self::_AddHttpHeader("Expires", "Mon, 26 Jul 1997 05:00:00 GMT");
        self::_AddHttpHeader("Cache-Control", "no-cache, cachehack=".time());
        self::_AddHttpHeader("Cache-Control", "no-store, must-revalidate");
        self::_AddHttpHeader("Cache-Control", "post-check=-1, pre-check=-1");
        self::_AddHttpHeader("Cache-Control", "max-age=0");
        self::LastModified(gmdate("D, d M Y H:i:s")." GMT");
    }
    
    /**
     * A megadott státuszkódú HTTP státuszt ad a fejléchez.
     * @example
     *      PSS_HTTPResponse::Status(403);
     * @access      public
     * @param       string      $pin_StatusCode HTTP státuszkód.
     * @return      null
     */
    public static function Status($pin_StatusCode) {
        self::_AddHttpHeader("HTTP/1.1 {$pin_StatusCode} ".self::$_StatusCodes[$pin_StatusCode]);
    }
    
    /**
     * Az utolsó modosítás időpontját adja a HTTP fejléchez.
     * @example
     * @access      public
     * @param       string      $pin_Date       Az utolsó módosítás dátuma.
     * @return      null
     */
    public static function LastModified($pin_Date) {
        self::_AddHttpHeader("Last-Modified", $pin_Date);
    }
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
    
    /**
     * Összeállítja a HTML content-et a megadott adatok alapján.
     * 
     * @param string $pin_Content                   A content string-je.
     * @param string $pin_Cache                     Be van e kapcsolva a cache.
     */
    private static function _sendContentHTML($pin_Content = null, $pin_Cache = null) {
        $loc_Content = "";
        $loc_HTML = implode("\n", self::$_htmlCode);
        
        if($pin_Content === null) {
            $loc_Content = ob_get_contents();
            ob_end_clean();
        }
        else {
            $loc_Content = $pin_Content;
        }
        
        if(self::$_htmlHeader['title'] == "") {
            self::setTitle(APPS_NAME . " - " . APPS_VER);
        }
        $loc_MetaTags = "";
        foreach (self::$_htmlHeader['metatag'] as $loc_MetaType => $loc_MetaContent) {
            $loc_MetaTags .= "  <meta name=\"".strtoupper($loc_MetaType)."\" content=\"".$loc_MetaContent."\">\n";
        }
        
        $loc_ScriptFiles = "";
        foreach (self::$_htmlHeader['script_file'] as $loc_ScriptFile) {
            $loc_ScriptFiles .= "   <script type=\"text/javascript\" src=\"".$loc_ScriptFile."\"></script>\n";
        }
        
        $loc_StyleFiles = "";
        foreach (self::$_htmlHeader['style_file'] as $loc_StyleFile) {
            $loc_StyleFiles .= "    <link href=\"".$loc_StyleFile."\" rel=\"stylesheet\" type=\"text/css\" />\n";
        }
        
        $loc_Scripts = "";
        foreach (self::$_htmlHeader['script'] as $loc_Script) {
            $loc_Scripts .= "   <script text=\"javascript\">".$loc_Script."</script> \n";
        }
        
        $loc_Styles = "";
        foreach (self::$_htmlHeader['style'] as $loc_Style) {
            $loc_Style .= "    <style type=\"text/css\">".$loc_Style."</style>";
        }
        
        $loc_HTML = str_replace(array("{ROOT_URI}", 
                                      "{TITLE}",
                                      "{HTMLHEADER}", 
                                      "{HTMLCONTENT}"), 
                                array(APPS_D_ROOT, 
                                      self::$_htmlHeader['title'],
                                      $loc_MetaTags.$loc_ScriptFiles.$loc_StyleFiles.$loc_Scripts.$loc_Styles,
                                $loc_Content),
                                $loc_HTML);
        
        self::$_contentType = "html";
        self::$_charset = "utf-8";
        self::_sendContent($loc_HTML, $pin_Cache);
    }
    
    /**
     * Elküldi a generált tartalmat a böngészőnek. Ez bármilyen tartalom lehet, nem csak html!
     * 
     * @param type $pin_Content
     * @param type $pin_Cache
     */
    private static function _sendContent($pin_Content = null, $pin_Cache = null) {
        if(!self::$_sentContent) {
            $loc_Content = "";
            if($pin_Content === null) {
                $loc_Content = ob_get_contents();
                ob_end_clean();
            }
            else {
                $loc_Content = $pin_Content;
            }
            if(!$pin_Cache) {
                self::NoCache();
                Debug::setDebugMessage(array(__METHOD__, self::cacheDisabled, "{MSG.INFO.CACHE_DISABLED}", "info", ""));
            }
            else {
                Debug::setDebugMessage(array(__METHOD__, self::cacheEnabled, "{MSG.INFO.CACHE_ENABLED}", "info", ""));
                self::_AddHttpHeader("Cache-Control", "private");
                self::Status(304);
                $loc_Content = "";
            }
            self::_sendHTTPHeader();
            echo $loc_Content;
            
            self::$_sentContent = true;
            ob_start();
        }
        else {
            Debug::setDebugMessage(array(__METHOD__, self::contentAlreadySent, "{MSG.ERROR.CONTENT_ALREADY_SENT}", "err", ""));
            ob_end_clean();
        }
    }
    
    /**
     * Elküldi a beállított HTTP fejlécet és Sütiket.
     * 
     * @return boolean
     */
    private static function _sendHTTPHeader() {
        if(!headers_sent()) {
            foreach (self::$_httpHeader as $loc_Header) {
                if(strlen($loc_Header[1]) > 0) {
                    header("{$loc_Header[0]}: {$loc_Header[1]}");
                }
                else {
                    header($loc_Header);
                }
            }
            self::$_sentHeader = true;
            return true;
        }
        return false;
    }
    
    /**
     * Hozzáad egy fejlécet a $_httpHeader tömbhöz ha még nem lett elküldve.
     * @param string $pin_HeaderType                A fejléc típusa.
     * @param string $pin_HeaderValue               A fejléc értéke.
     */
    private static function _addHttpHeader($pin_HeaderType, $pin_HeaderValue = "") {
        if(!self::$_sentHeader) {
            $pin_HeaderType[0] = strtoupper($pin_HeaderType[0]);
            self::$_httpHeader[] = array($pin_HeaderType, $pin_HeaderValue);
            Debug::setDebugMessage(array(__METHOD__, self::addHeader, "{MSG.SUCC.ADD_HEADER}", "info", $pin_HeaderType[0] . ": " . $pin_HeaderValue));
        }
        else {
            Debug::setDebugMessage(array(__METHOD__, self::errorHttpHeaderSent, "{MSG.ERROR.HTTP_HEADER_SENT}", "err", ""));
        }
    }
    
}

?>