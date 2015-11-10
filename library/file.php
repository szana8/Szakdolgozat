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
    
    /**
     * A file nem létezik hibakód.
     */
    const   fileNotExists       = 'xf00000';
    
    /**
     * Hibás file típus hibakód.
     */
    const   invalidFileType     = 'xf00001';
    
    /**
     * A file mérete 0 byte hibakód.
     */
    const   fileSizeNull        = 'xf00002';
    
    /**
     * A file nem olvasható hibakód.
     */
    const   fileIsNotReadable   = 'xf00003';
    
    /**
     * A file nem írható hibakód.
     */
    const   fileIsNotWritable   = 'xf00004';
    
    /**
     * Hiba a file létrehozásakor.
     */
    const   errorFileCreate     = 'xf00005';
    
    /**
     * Hiba a file felülírásakor.
     */
    const   errorFileUpdate     = 'xf00006';
    
    /**
     * Hiba a file törlésekor.
     */
    const   errorFileDelete     = 'xf00007';

    /**
     * Hibás könyvtár név.
     */
    const   invalidDirectory    = 'xf00008';
    
    /**
     * Elégtelen jogosultság.
     */
    const   permissionError     = 'xf00009';
    
    /**
     * Érvénytelen file név.
     */
    const   invalidFileName     = 'xf00010';
    
################################################################################
# 2. Public Properties #########################################################
################################################################################

    

################################################################################
# 3. Protected Properties ######################################################
################################################################################
    
    
    
################################################################################
# 4. Public Methods ############################################################
################################################################################
    
    /**
     * Megvizsgálja, hogy az adott file létezik e, majd visszatért az eredménnyel.
     * 
     * @param string $pin_FileName          File neve.
     * @return boolean                      Ha létezik a file true-val tér vissza, 
     *                                      különben false-al.
     * @version 1.0
     */
    public static function getFileExists($pin_FileName) {
        if(!$pin_FileName)
            return false;
        
        return callStatic()->_isFileExists($pin_FileName);
    }
    
    /**
     * Megvizsgálja a file típusát, majd visszatért vele. Ha a file nem létezik
     * <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return string                       A file típusa string-ként.
     * @version 1.0
     */
    public static function getFileType($pin_FileName) {
        if(!$pin_FileName)
            return false;
        
        return "";
    }
    
    
    /**
     * Beolvassa a file tartalmát egy változóba, majd string-ként visszatért vele.
     * Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return string                       A file tartalma, string-ként.
     * @version 1.0
     */
    public static function getFileContent($pin_FileName) {
        if(!$pin_FileName)
            return false;
        
        return "";
    }
    
    /**
     * Beolvassa az ini file tartalmát egy objektumba majd visszatért az objektummal.
     * Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return object                       Az ini file tartalma objektum-ként.
     * @version 1.0
     */
    public static function getIniContent($pin_FileName) {
        if(!$pin_FileName)
            return false;
        
        $loc_IniContent = NULL;
        return object($loc_IniContent);
    }
    
    /**
     * Megvizsgálja a file méretét és visszatér vele. Ha a file nem létezik 
     * <b>false</b> értékkel tér vissza.
     * 
     * @param type $pin_FileName            File neve. 
     * @return double                       A file mérete.
     * @version 1.0
     */
    public static function getFileSize($pin_FileName) {
        if(!$pin_FileName)
            return false;
        
        $loc_Size = NULL;
        return doubleval($loc_Size);
    }
    
    /**
     * Megvizsgálja, hogy a file mikor volt módosítva, majd visszatért a módosítás
     * dárumával. Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return date                         File módosításának dátuma.
     * @version 1.0
     */
    public static function getFileLastMTime($pin_FileName) {
        $loc_FileLastMTime = NULL;
        return date($loc_FileLastMTime, DEFAULT_DATE_FORMAT);
    }
    
    /**
     * Megvizsgálja, hogy az adott file-t ki módosította utoljára, majd visszatért
     * vele. Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return string                       A módosító user neve.
     * @version 1.0
     */
    public static function getFileLastMUser($pin_FileName) {
        $loc_LastMUser = NULL;
        return $loc_LastMUser;
    }
    
    /**
     * Megvizsgálja, hogy a file olvasható e, majd visszatér az eredménnyel.
     * Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return boolean                      Olvasható e vagy nem.
     * @version 1.0
     */
    public static function isReadable($pin_FileName) {
        $loc_IsReadable = false;
        return $loc_IsReadable;
    }
    
    /**
     * Megvizsgálja, hogy a file írható e, majd visszatér az eredménnyel.
     * Ha a file nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @return boolean                      Írható e vagy nem.
     * @version 1.0
     */
    public static function isWritable($pin_FileName) {
        $loc_IsWritable = false;
        return $loc_IsWritable;
    }
    
    /**
     * Beinclude-ál egy php file-t a hívás helyére. Ha a file nem létezik 
     * <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve
     * @return boolean                      Sikeres volt e a betöltés vagy sem.
     * @version 1.0
     */
    public static function loadFile($pin_FileName) {
        return true;
    }
    
    /**
     * Létrehoz egy file-t a megadott helyen, a megadott tartalommal. Ha a file 
     * nem létezik <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve, absolute lokációval.
     * @param string $pin_FileContent       File tartalma.
     * @return boolean                      Sikeres volt e a file létrehozás vagy sem.
     * @version 1.0
     */
    public static function createFile($pin_FileName, $pin_FileContent = "") {
        return true;
    }
    
    /**
     * Update-el egy file-t a megadott tartalommal. Ha a $pin_ForceUpdate paraméter
     * true akkor ha nem létezik a file létrehozza előtte.
     * 
     * @param string $pin_FileName          File neve, absolute lokációval.
     * @param string $pin_FileContent       File új, tartalma.
     * @param boolean $pin_ForceUpdate      Kényszerített update
     * @return boolean                      Sikeres volt e az update vagy sem.
     * @version 1.0
     */
    public static function updateFile($pin_FileName, $pin_FileContent = "", $pin_ForceUpdate = false) {
        return true;
    }
    
    /**
     * Kitörli a megadott file-t a megadott helyről. Ha a $pin_ForceRemove paraméter
     * true, akkor is kitörli a file-t ha nem 0 byte a tartalma. 
     * 
     * @param string $pin_FileName          File neve, absolute lokációval.
     * @param boolean $pin_ForceRemove      Kényszerített törlés.
     * @return boolean                      Sikeres volt e a törlés vagy sem.
     * @version 1.0
     */
    public static function removeFile($pin_FileName, $pin_ForceRemove = false) {
        return true;
    }
    
    /**
     * Megkeresi a megadott file-t a megadott helyen. Ha a $pin_Recursive paraméter
     * true, akkor rekurzívan keres, majd visszatér a file elérési útjával, vagy
     * <b>false</b> értékkel ha a file nem létezik a megadott helyen.
     * 
     * @param string $pin_FileName          File neve
     * @param string $pin_Directory         A mappa ahol keresni akarunk
     * @param boolean $pin_Recursive        Rekurzív legyen e a keresés?
     * @return boolean                      Sikeres volt e a keresés
     * @version 1.0
     */
    public static function searchFile($pin_FileName, $pin_Directory, $pin_Recursive = false) {
        return false;
    }
    
    /**
     * A megadott file-ban keresi a megadott string-et. Ha létezik true-val tér
     * vissza.
     * 
     * @param string $pin_FileName          File neve
     * @param string $pin_SearchString      Keresett sztring
     * @return boolean                      Sikeres volt e a keresés vagy sem.
     * @version 1.0
     */
    public static function searchInFile($pin_FileName, $pin_SearchString) {
        $loc_IsStringExists = false;
        return $loc_IsStringExists;
    }
    
    /**
     * Kényszerített letöltés. A megadott file-t letölti a böngészőben. Szükséges
     * hozzá a download.js javascript függvénykönyvtár.
     * 
     * @param string $pin_FileName          File neve.
     * @return boolean                      Sikeres volt e a letöltés vagy sem.
     * @version 1.0
     */
    public static function downloadFile($pin_FileName) {
        return true;
    }
    
    /**
     * A megadott file-t átmozgatja a megadott lokációra. Ha a $pin_ForceMove true
     * akkor ha nem létezik a cél könyvtár létrehozza előtte. Ha a file nem létezik
     * <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve
     * @param boolean $pin_ForceMove        Ha nem létezik a könyvtár ahová mozgatni 
     *                                      akarjuk létrehozzuk előtte.
     * @return boolean                      Sikeres volt e a file mozgatás vagy sem.
     * @version 1.0
     */
    public static function moveFile($pin_FileName, $pin_ForceMove = false) {
        return true;
    }
    
    /**
     * A <i>FILE</i> globális tömb-ből feltölti a megadott file-t a megadott mappába.
     * Ha a $pin_ForceUpload paraméter true és nem létezik a megadott könyvtár
     * először létrehozzuk azt.
     * 
     * @param string $pin_FileName          A <i>FILE</i> globális tömb-ből a file neve.
     * @param string $pin_DirectoryName     A mappa ahová fel akarjuk tölteni a file-t.  
     * @param boolean $pin_ForceUpload      Ha nem létezik a könyvtár ahová mozgatni
     *                                      akarjuk létrehozzuk előtte.
     * @return boolean                      Sikeres volt e a file feltöltés vagy sem.
     * @version 1.0
     */
    public static function uploadFile($pin_FileName, $pin_DirectoryName, $pin_ForceUpload = false) {
        return true;
    }
    
    /**
     * Megvizsgálja, hogy a megadott file típusa egyezik e a $pin_TypeName paraméterben
     * megadott típussal, majd visszatér az eredménnyel. Ha a file nem létezik 
     * <b>false</b> értékkel tér vissza.
     * 
     * @param string $pin_FileName          File neve.
     * @param string $pin_TypeName          Típus neve
     * @return boolean                      Egyezik e a file típusa a megadottal vagy sem.
     * @version 1.0
     */
    public static function checkFileType($pin_FileName, $pin_TypeName) {
        return true;
    }
    
    /**
     * Létrehoz egy könyvtárat a megadott helyen. ha sikeres volt a könyvtár létrehozása
     * true értékkel tér vissza, különben false-al.
     * 
     * @param string $pin_DirectoryName     Könyvtár neve.
     * @param string $pin_Path              Az absolute lokáció, ahol létre szeretnénk
     *                                      hozni a könyvtárat.
     * @return boolean                      Sikeres volt e a könyvtár létrehozás vagy sem.
     * @version 1.0
     */
    public static function createDirectory($pin_DirectoryName, $pin_Path) {
        return true;
    }
    
    /**
     * Egy asszociatív tömb-be gyűjti össze a könyvtár tartalmát. Ha a $pin_DirectoryOnly
     * paraméter true, csak a könyvtárakat vesszi figyelembe. A $pin_FileTypes 
     * paraméterben meg lehet adni string-ként vagy tömb-ként azokat a file típusokat 
     * amiket listázni szeretnénk. A $pin_Recursive paraméterrel tudunk rekurzívan
     * keresni a mappában.
     * 
     * @param string $pin_DirectoryName     Könyvtár neve.
     * @param boolean $pin_DirectoryOnly    Csak könyvtárakat listázunk vagy mindent.
     * @param string|array $pin_FileTypes   A listázandó file típusok. Ha null mindent listáz.
     * @param boolean $pin_Recursive        Rekurzívan akarunk e listázni vagy sem.
     * @return array                        A találatok, tömbje.
     * @version 1.0
     * @uses File::listDirectory("images", false, array("jpg", "png", "jpeg"), true);
     */
    public static function listDirectory($pin_DirectoryName, $pin_DirectoryOnly = false, $pin_FileTypes = NULL, $pin_Recursive = false) {
        return array();
    }
    
    /**
     * Egy könyvtár nevére keres a megadott könyvtárban. Ha a $pin_Recursive paraméter
     * true akkor rekurzívan keres. Ha megtalálta a könyvtárat true-val tér vissza.
     * 
     * @param string $pin_DirectoryName     Könyvtár neve.
     * @param string $pin_Path              Absolute elérési út ahol keresünk.
     * @param boolean $pin_Recursive        Rekurzív legyen e a keresés?
     * @return boolean                      Sikeres volt e a keresés vagy sem.
     * @version 1.0
     */
    public static function searchDirectory($pin_DirectoryName, $pin_Path, $pin_Recursive = false) {
        return false;
    }
    
    /**
     * A megadott könyvtár nevét megváltoztatja a $pin_NewName paraméterben kapott
     * névre. Ha a $pin_ForceUpdate true, akkor is megváltoztatja ha a könyvtár
     * tartalmaz más mappákat vagy file-okat. 
     * 
     * @param string $pin_DirectoryName     Könyvtár neve, absolute elérási úttal.
     * @param string $pin_NewName           A könyvtár új neve.
     * @param boolean $pin_ForceUpdate      Kényszerített update.
     * @return boolean                      Sikeres volt a az update vagy sem.
     * @version 1.0
     */
    public static function updateDirectory($pin_DirectoryName, $pin_NewName, $pin_ForceUpdate = false) {
        return false;
    }
    
    /**
     * Kitöröli a megadott könyvtárat. Ha a $pin_ForceRemove paraméter true akkor
     * is törli ha tartalmaz almappákat ill file-okat.
     * 
     * @param string $pin_DirectoryName     Könyvtár neve, absolute elérási úttal.
     * @param boolean $pin_ForceRemove      Kényszerített törlés (rekurzív).
     * @return boolean                      Sikeres volt e a törlés vagy sem.
     * @version 1.0
     */
    public static function removeDirectory($pin_DirectoryName, $pin_ForceRemove = false) {
        return true;
    }
    
    
################################################################################
# 5. Protected Methods #########################################################
################################################################################
    
    /**
     * Önmagát példányosítja és visszatér a File objektummal a statikus függvényeknek.
     * 
     * @return \library\File                File objektum.
     * @version 1.0
     */
    protected static function callStatic() {
        return new \library\File();
    }
    
    /**
     * Protected függvény. Megvizsgálja, hogy a megadott file létezik e, majd
     * visszatért az eredménnyel.
     * 
     * @param string $pin_FileName          File neve.
     * @return boolean                      Létezik e a file vagy nem.
     * @version 1.0
     */
    protected function _isFileExists($pin_FileName) {
        if(is_file($pin_FileName))
            return true;
        
        return false;
    }
   
    
################################################################################
# 6. Private Methods ###########################################################
################################################################################
}

?>