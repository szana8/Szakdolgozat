<?php
/**
 * Link:
 * File: Addon.php
 * Namespace: library
 *
 * Description of Addon: A keretrendszerhez és a moduleokhoz tartozó
 * plugin-okat kezelő osztály. Tartalmazza az installáláshoz szükséges
 * metódusokat és egyéb függvényeket.
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 04.     Pisti                Created
 *
 */

namespace library;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class Addon
{
################################################################################
# 1. Constants #################################################################
################################################################################

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
     * Lekérdezi az adatbázisból a plugin-ek listáját.
     *
     * @return \stdClass    A pluginek listáját tartalmazó objektum.
     * @version 1.0
     * @access publiuc
     */
    public static function getAddons() : array {
        $loc_DB = new \library\Mysql(\PDO::FETCH_OBJ);
        $loc_List = $loc_DB->query('SELECT * FROM fnd_addons ORDER BY name');
        return $loc_List;
    }

    /**
     * Megnézi, hogy a paraméterben kapott zip file-ban létezik e a pom.xml file.
     * @param string $pin_FileName          A vizsgált zip file
     * @return bool                         Létezik e a pom vagy sem
     */
    public static function isPOMExists(string $pin_FileName) : bool {
        $obj_Zip = new Zip();
        $obj_Zip->setZipFile($pin_FileName);
        (array)$loc_Zip = $obj_Zip->getZipFileContent();
        (array)$loc_Tmp = array();

        foreach ($loc_Zip as $loc_File)
           $loc_Tmp = array_merge($loc_Tmp, explode('/', $loc_File));

        if(in_array('pom.xml', $loc_Tmp))
            return true;

        return false;
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################

}