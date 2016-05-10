<?php
/**
 * Link:
 * File: Zip.php
 * Namespace: library
 *
 * Description of Zip
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 05.     Pisti                Created
 *
 */

namespace library;


class Zip extends File {

################################################################################
# 1. Constants #################################################################
################################################################################

    /**
     * A hiba a file megnyitásakor
     */
    const   errorZipFileOpen           = "xz00000";

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    /**
     * Ebben a property-ben tároljuk a zip file nevét amivel az aktuális
     * példányban dolgozunk.
     * @var string
     */
    private $_zipFile;

    /**
     * Ebben a propeerty-ben tároljuk a zip file tartalmát.
     * @var array
     */
    private $_zipStream;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * Vissza adja a property-ben megadott zip file tartalmát.
     * @return mixed            A zip file tartalma
     * @version 1.0
     * @acces public
     */
    public function getZipFileContent() {
        $obj_Zip = $this->_extractZip();
        $this->_getZipFile($obj_Zip);
        return $this->_zipStream;
    }

    /**
     * Vissza adja a zipFile property értékét.
     * @return mixed            A property értéke
     * @versiom 1.0
     * @access public
     */
    public function getZipFile() {
        return $this->_zipFile;
    }

    /**
     * Beállítja a zipFile property értékét.
     * @param mixed $zipFile    A prtoperty értéke
     * @version 1.0
     * @access public
     */
    public function setZipFile($zipFile) {
        $this->_zipFile = $zipFile;
    }

    /**
     * Vissza adja a zipstream property értékét.
     * @return mixed            A property értéke
     * @version 1.0
     * @access public
     */
    public function getZipStream() {
        return $this->_zipStream;
    }

    /**
     * Beállítja a zipStream property-t.
     * @param mixed $zipStream  A prtoperty értéke
     * @version 1.0
     * @access public
     */
    public function setZipStream($zipStream) {
        $this->_zipStream = $zipStream;
    }



################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################

    /**
     * Megnyitja a _zipFile property-ben levő zip-et.
     * @return \ZipArchive              A megnyitott file objektuma.
     * @version 1.0
     * @access private
     */
    private function _extractZip() : \ZipArchive {
        $obj_Zip = new \ZipArchive();
        if(!$this->getFileExists(APPS_D_TMP . $this->_zipFile)) {
            $obj_Zip->status = 'error';
            return $obj_Zip;
        }

        try {
            $obj_Zip->open(APPS_D_TMP . $this->_zipFile);
            return $obj_Zip;
        } catch(\Exception $e) {
            Debug::setDebugMessage(array(__METHOD__, self::errorZipFileOpen, "{MSG.ERROR.ERROR_ZIP_FILE_OPEN}", "err", $this->_zipFile));
            $obj_Zip->status = 'error';
            return $obj_Zip;
        }
    }

    /**
     * A paraméterben kapott zip objektumból kiveszi a file-ok és mappák neveit.
     * @param \ZipArchive $pin_ZipObj   A vizsgált zip objektum.
     * @version 1.0
     * @access private
     */
    private function _getZipFile(\ZipArchive $pin_ZipObj) {
        for($i=0;$i<$pin_ZipObj->numFiles;$i++) {
            $this->_zipStream[] = $pin_ZipObj->getNameIndex($i);
        }
    }

}