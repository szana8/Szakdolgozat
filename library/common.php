<?php
declare(strict_types = 1);
/**
 * File: Common.php
 * Description:
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

//Kimeneti bufferelés bekapcsolása
ob_start();

ignore_user_abort(true);

define("APPS_NAME", (string) "Application");

define("APPS_VER", (string) "1.0.0");

//Kód futásának kezdete
define("APPS_START_TIME", (int) microtime());

//Könytár elválasztó
define("APPS_DIRECTORY_SEPARATOR", (string) "/");

//Op rendszer álltal használt elválasztó
define("APPS_ENV_SEPARATOR", (string) DIRECTORY_SEPARATOR);

 //A program gyökerének elérési útja. Az a ROOT könyvtárunk, amiben a core.php található.
define("APPS_D_ROOT", (string) apps_dirpath(dirname(__DIR__)));

define("APPS_D_LOCALE", APPS_D_ROOT . "locale" . APPS_DIRECTORY_SEPARATOR);

// A program konfigurációs állományait tartalmazó könyvtár elérési útja
define("APPS_D_CONFIG", (string) APPS_D_ROOT."config".APPS_DIRECTORY_SEPARATOR);

// A program által használt keretrendszereket tartalmazó könyvtár elérési útja.
define("APPS_D_PLGS", (string) APPS_D_ROOT."frameworks".APPS_DIRECTORY_SEPARATOR);

// A program programkódjait tartalmazó könyvtár elérési útja.
define("APPS_D_LIBS", (string) APPS_D_ROOT."library".APPS_DIRECTORY_SEPARATOR);

// A program moduljait tartalmazó könyvtár elérési útja.
define("APPS_D_MODS", (string) APPS_D_ROOT."modules".APPS_DIRECTORY_SEPARATOR);

// A program moduljait tartalmazó könyvtár elérési útja.
define("APPS_D_JS", (string) APPS_D_ROOT."javascript".APPS_DIRECTORY_SEPARATOR);

// A program moduljait tartalmazó könyvtár elérési útja.
define("APPS_D_CSS", (string) APPS_D_ROOT."style".APPS_DIRECTORY_SEPARATOR);

// Sablon fájlokat tartalmazó könyvtár elérési útja.
define("APPS_D_TPL", (string) APPS_D_ROOT."templates".APPS_DIRECTORY_SEPARATOR);

// Ideiglenes fájlokat tartalmazó könyvtár elérési útja.
define("APPS_D_TMP", (string) APPS_D_ROOT."tmp".APPS_DIRECTORY_SEPARATOR);

// Ideiglenes fájlokat tartalmazó könyvtár elérési útja.
define("APPS_D_TRACE", (string) APPS_D_ROOT."debug".APPS_DIRECTORY_SEPARATOR."trace".APPS_DIRECTORY_SEPARATOR);

define("DEFAULT_DATE_FORMAT", (string) "Y-m-d H:i:s");


/**
 * A paraméterben megadott könyvtár elérési útvonalban lecseréli
 * a rendszer által használt könyvtár elválasztót a CI által hsznált könyvtár 
 * elválasztóra.
 * 
 * @access      public
 * @package     library
 * @subpackage  Common\Functions
 * @param       string          $pin_Path       Elérési útvonal.
 * @return      string
 */
function apps_dirpath(string $pin_Path) : string {
    $v_path_trim = rtrim($pin_Path, APPS_ENV_SEPARATOR.APPS_DIRECTORY_SEPARATOR);
    return(str_replace(APPS_ENV_SEPARATOR, APPS_DIRECTORY_SEPARATOR, $v_path_trim).APPS_DIRECTORY_SEPARATOR);
}


/**
 * Automatikusan betölti a paraméterben megadott osztály forrás file-ját majd
 * példányosítja az oasztályt. A beépített autoload függvény helyett.
 * 
 * @access          public
 * @package         library
 * @subpackage      Common\Functions
 * @param type      $pin_ClassName              Osztály neve namespace-el
 * @return boolean;
 */
function autoload(string $pin_ClassName) : bool
{        
    $loc_Directory = explode("\\", $pin_ClassName);
    $loc_Location = NULL;

    for($loc_Cycle=0;$loc_Cycle<=count($loc_Directory)-2;$loc_Cycle++) {
        $loc_Location .= '/' . $loc_Directory[$loc_Cycle]; 
    }

    if($loc_Directory[0] == 'modules') {
        $loc_Location .= '/library/'. end($loc_Directory);
    }
    elseif($loc_Directory[0] == 'WebServices') {
        $loc_Location .= '/' . end($loc_Directory) . '/' .  end($loc_Directory);
    }
    else {
        $loc_Location .= '/'. end($loc_Directory);
    }

    $loc_File = str_replace('/', APPS_DIRECTORY_SEPARATOR, APPS_D_ROOT . strtolower($loc_Location) . '.php');

    if(strlen($loc_File) <= 260) {
        if(is_file($loc_File)) {
            require_once $loc_File;
            return true;
        }
        else {
            return false;
        }
    }
    return false;
}


    //Beállítja az autoload függvényt.
    spl_autoload_register('autoload');

    //Beállítja a debug üzenetek szintjét
    set_app_debug();


/**
 * Meghatározza a root uri-t.
 * 
 * @access      public
 * @package     library
 * @subpackage  Core\Functions
 * @return      string
 */
function app_root_uri() : string {
    
    $loc_DocRoot = apps_dirpath(library\Enviroment::GetEnv("DOCUMENT_ROOT"));
    
    if(substr(APPS_D_ROOT, 0, strlen($loc_DocRoot)) == $loc_DocRoot) {
        return(APPS_DIRECTORY_SEPARATOR.preg_replace("#^".apps_dirpath(\library\Enviroment::GetEnv("DOCUMENT_ROOT"))."#", "", APPS_D_ROOT));
    }
    else {
        // Ha alias miatt nem a document_root alatt helyezkedik el CI,
        // akkor a SCRIPT_FILENAME és SCRIPT_NAME segítségével határozzuk meg a root uri-t.
        $loc_Paths = explode(APPS_DIRECTORY_SEPARATOR_DS, \library\Enviroment::GetEnv("SCRIPT_FILENAME"));
        $loc_Uris = explode(APPS_DIRECTORY_SEPARATOR_DS, \library\Enviroment::GetEnv("SCRIPT_NAME"));
        $loc_Path = "";
        for($loc_Index = count($loc_Paths) - 1; $loc_Index > -1; $loc_Index--) {
            $loc_Path = implode(APPS_DIRECTORY_SEPARATOR_DS, $loc_Paths).APPS_DIRECTORY_SEPARATOR_DS;
            if($loc_Path == APPS_D_ROOT) {
                unset($loc_Uris[$loc_Index]);
                break;
            }
            unset($loc_Paths[$loc_Index]);
            unset($loc_Uris[$loc_Index]);
        }
        return(implode(APPS_DIRECTORY_SEPARATOR, $loc_Uris).APPS_DIRECTORY_SEPARATOR);
    }
}

// CI parancssori futtatás jelzése. Ha parancssorból hívnak meg egy CI 
// futtatható fájlt, értéke true lesz. 
define("__CLI__", (string) defined("STDIN") && strtolower(php_sapi_name()) == "cli");

// A futtatott script (amit meghívtak a böngészőből) abszolút elérési útja a szerveren.
define("__SCRIPT_DIR__", (string) apps_dirpath(dirname(realpath(\library\Enviroment::GetEnv("SCRIPT_FILENAME")))));

// Az alkalmazás gyökér URI-ja.
define("__ROOT_URI__", (string) app_root_uri());

// Az alkalmazás gyökér URL-je.
define("__ROOT_URL__", (string)  __CLI__ ? "" : (((\library\Enviroment::GetEnv("HTTPS")) ? "https://" : "http://").\library\Enviroment::GetEnv("HTTP_HOST").__ROOT_URI__));


/**
 * Beállítja a PHP debug üzenetek megjelenítési szintjét.
 * 
 * @return null
 * @access public
 * @version  1.0
 */
function set_app_debug() {
    $loc_FilaName = APPS_D_CONFIG . "config.ini";
    $loc_IniObject = library\File::getIniContent($loc_FilaName);

    ini_set("display_error", (string)($loc_IniObject->Loging->DISPLAY == true ? 1 : 0));
    if($loc_IniObject->Loging->ERROR == true) {
        error_reporting(E_ALL);
    }
    else {
        error_reporting(null);
    }
}

/**
 * Beregisztrál egy shutdown függvényt.
 * @example
 * @access      public
 * @subpackage  Core\Functions
 * @param       integer         $pin_Function   Függvénynév.
 * @return      null
 */
function app_register_shutdown(string $pin_Function) {
    static $stc_Function = array();
    static $stc_Debug = array();
    if(!in_array($pin_Function, $stc_Function)) {
        $stc_Function[] = $pin_Function;
        register_shutdown_function($pin_Function);
    }
}


    //Inicializálunk
/**
    \library\Httprequest::initialize();
    \library\Session::initialize();
    \library\Extensionmanager::initialize();
    \library\Httpresponse::initialize();
    \library\Language::initialize();
    \library\Modulemanager::initialize();
 */