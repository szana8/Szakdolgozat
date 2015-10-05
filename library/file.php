<?php

/**
 * Link: 
 * File: file.php
 * Namespace: library
 * 
 * Description of file
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

class File extends Core {
    
################################################################################
# 1. Constants #################################################################
################################################################################
    
################################################################################
# 2. Public Properties #########################################################
################################################################################

    /**
     * A file neve, amivel dolgozni szeretnénk.
     * 
     * @var string 
     */
    public static $FileName = null;
    
    /**
     * A beolvasott ini file tartalma.
     * 
     * @var array 
     */
    public static $FileContent = array();
    
    /**
     * A File lokációja, amit vizsgálni szeretnénk.
     * 
     * @var string 
     */
    public static $FileLocation = null;
    
    /**
     * A modul neve, amit használni akarunk a függvényekben.
     * 
     * @var string 
     */
    public static $Module = null; 

################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    /**
     * A beolvasott file tartalma.
     * 
     * @var atring 
     */
    protected static $_fileObject = null;
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Beolvassa a FileName attribútumban megadott ini filet majd a file tömbjével 
     * tér vissza, vagy false értékkel ha a file nem létezik.
     * 
     * @return array | false                     Ini file tömb-je
     * @version 1.0
     * @access public
     */
    public static function GetIniContent() {
        if(self::GetFileExists(APPS_D_CONFIG . self::$FileName)) {
            self::_DebugMsg(APPS_D_CONFIG . self::$FileName . " file load success!", __CLASS__, "success");
            return self::_GetIniContent(APPS_D_CONFIG . self::$FileName);
        }
        else {
            self::_DebugMsg(APPS_D_CONFIG . self::$FileName . " file not exists!", __CLASS__, "error");
            return(false);
        }
    }
    
    /**
     * Beolvassa a megadott module konfigurációs ini file-ját, majd berakja az 
     * eredményt egy tömb-be és ezzel tér vissza, vagy false értékkel ha a file
     * nem létezik.
     * 
     * @return array | false                    Ini file tömb-je
     * @version 1.0
     * @access public
     */
    public static function GetModuleContent() {
        if(self::GetFileExists(APPS_D_MODS . self::$Module . '/config/' . self::$FileName)) { 
            self::_DebugMsg(self::$Module . '/config/' . self::$FileName . " file not exists!", __CLASS__, "wrong");
            return self::_GetIniContent(APPS_D_MODS . self::$Module . '/config/' . self::$FileName);
        }
        else {
            self::_DebugMsg(self::$Module . '/config/' . self::$FileName . " file not exists!", __CLASS__, "wrong");
            return(false);
        }
    }
    
    /**
     * Megnézi hogy a paraméterben megadott file létezik e.
     * 
     * @param string $pin_FileLocation              File lokációja
     * @return boolean
     * @version 1.0
     * @access public
     */
    public static function GetFileExists($pin_FileLocation) {
        return is_file($pin_FileLocation);
    }
    
    /**
     * Megnyit egy file-t és visszatér a file tartalmával, vagy false értékkel ha
     * a file nem létezik.
     * 
     * @param string $pin_TemplateName              File lokációja
     * @return string | false
     * @version 1.0
     * @access public
     */
    public static function OpenFile($pin_FileName) {
        if(self::GetFileExists($pin_FileName)) {
            return self::_FileOpen($pin_FileName, "r");
        }
        else {
            return(false);
            self::_DebugMsg("{MSG_FAIL_LOAD}", __CLASS__, "wrong");
        }
    }
    
    /**
     * Az adott könyvtárban található programfájlt tölti be.
     * 
     * @access      public
     * @param       string      $pin_Path       A fájlt tartalmazó könyvtár elérési útja.
     * @param       string      $pin_File       A betöltendő fájl neve.
     * @param       string      $pout_Variables A betöltött fájlban definiált változók.
     * @param       string      $pin_Trigger    Felhasználói error kiváltása.
     * @return      boolean
     */
    public static function Load($pin_Path, $pin_FileName, &$pout_Variables = null) {
        return (self::_Load($pin_Path, $pin_FileName, false, $pout_Variables));
    }


################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    /**
     * Az ini file tömb-é alakító publikus függvény protected függvénye. Visszatér
     * az ini file tartalmával.
     * 
     * @param string $pin_FileLocation              A file lokációja
     * @param boolean $pin_Sections                 Opció, az asszociatív tömb-bé alakításhoz
     * @return array                                Ini file tömb-je
     * @version 1.0
     * @access protected
     */
    protected static function _GetIniContent($pin_FileLocation, $pin_Sections = true) {
        return parse_ini_file($pin_FileLocation, $pin_Sections);
    }
    
    /**
     * Az OpenFile publikus függvény protected függvénye. Megnyitja a paraméterben 
     * megadott file-t, majd visszatér a file tartalmával.
     * 
     * @param string $pin_File                  A elérési útvonala és neve
     * @param string $pin_Mode                  A megnyitás módja (pl. read, write, ...)
     * @return string | false                   A file tartalma vagy false ha nem tudja megnyitni
     * @version 1.0
     * @access protected
     */
    protected static function _FileOpen($pin_File, $pin_Mode)
    {
        $loc_FileObj = fopen($pin_File, $pin_Mode);
        self::$_fileObject = stream_get_contents($loc_FileObj);
        return self::$_fileObject;
    }
    
    /**
     * Betölti a megadott könyvtárban lévő programkódot.
     * 
     * @access      private
     * @param       string      $pin_Path       Programkód könyvtára.
     * @param       string      $pin_File       Programkód fájlneve.
     * @param       string      $pin_ForceLower Fájlnév kisbetűssé alakítása.
     * @param       string      $pout_Variables A betöltött fájlban definiált változók.
     * @param       string      $pin_Trigger    Felhasználói error kiváltása.
     * @return      boolean
     */
    protected static function _Load($pin_Path, $pin_File, $pin_ForceLower = true, &$pout_Variables = null) {
        if($pin_ForceLower) {
            $pin_File = strtolower($pin_File);
        }
        
        if(file_exists($loc_Inc = $pin_Path.$pin_File)) {
            require_once($loc_Inc);
            $loc_Variables = get_defined_vars();
            unset($loc_Variables['pin_Path']);
            unset($loc_Variables['pin_File']);
            unset($loc_Variables['pin_ForceLower']);
            unset($loc_Variables['pout_Variables']);
            unset($loc_Variables['pin_Trigger']);
            unset($loc_Variables['loc_Inc']);
            $pout_Variables = $loc_Variables;
            return(true);
        }
        else {
            self::_DebugMsg("{MSG_FAIL_LOAD}", __CLASS__, "wrong");
            return(false);
        }
    }
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
}

?>