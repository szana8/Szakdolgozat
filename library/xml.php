<?php
/**
 * Link:
 * File: Xml.php
 * Namespace: library
 *
 * Description of Xml: Az XML file-ok feldolgozásáért felelős osztály.
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 05.     Pisti                Created
 *
 */

namespace library;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class Xml extends File {

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
     * Az XML file neve amin az aktuális példány dolgozik.
     * @var string
     */
    private $_xmlFileName       = '';

    /**
     * Az XML file attribútumainak listája.
     * @var array
     */
    private $_xmlFileElements   = array();

    /**
     * Az SimpleXML osztály példánya.
     * @var
     */
    private $_xmlObject;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * Az oasztály példányosításakor a megadott xml file-t megnyitja,
     * majd az objektumot beleteszi az _xmlObject property-be.
     *
     * Xml constructor.
     * @param string $pin_XmlFile           Az XML file neve,
     * @version 1.0
     * @access public
     */
    public function __construct(string $pin_XmlFile) {
        $this->_xmlFileName = $pin_XmlFile;
        $this->_openXML();
    }

    /**
     * Visza adja az XML file-ból a paraméterben megadott elemet,
     * objektumként.
     *
     * @param string $pin_ElementName       Az elem neve
     * @return string                       Az elem objektumként
     * @version 1.0
     * @access public
     */
    public function getXMLElement(string $pin_ElementName) : string {
        return null;
    }

    /**
     * Vissza adja az XML file-ból a paraméterben kapott elemeket,
     * objektumként.
     *
     * @param array $pin_Elements
     * @return \stdClass
     */
    public function getXMLElements(array $pin_Elements) : \stdClass {
        return new \stdClass();
    }

    /**
     * Vissza adja az XML elem paraméterben kapott attribútumát.
     *
     * @param string $pin_AttributeName     Az atrubútum neve
     * @return String                       Az attribőtum értéke
     * @version 1.0
     * @access public
     */
    public function getAttribute(string $pin_AttributeName) : String {
        return $this->_getAttribute($pin_AttributeName);
    }

################################################################################
# 5. Protected Methods #########################################################
################################################################################

################################################################################
# 6. Private Methods ###########################################################
################################################################################

    /**
     * Ellenőrzi hogy valid e az xml file.
     *
     * @return bool                 Valid e az xml vagy sem
     * @version 1.0
     * @access private
     */
    private function _isValid() : bool {
        $this->$this->_openXML();
        $this->_xmlObject->rewind();
        return $this->_xmlObject->valid();
    }

    /**
     * Megnyitja az <code>_xmlFileName</code> propertyben szereplő xml file-t.
     *
     * @return \XMLReader           A megnyitott file objektuma
     * @version 1.0
     * @access private
     */
    private function _openXML() {
        $this->_xmlObject = new \SimpleXMLElement($this->getFileContent($this->_xmlFileName));
        return $this->_xmlObject;
    }

    /**
     * Privát metódus az XML attribútumát adja vissza.
     *
     * @param string $pin_AttrName      Az attribútum neve
     * @return mixed                    Az attribútum értéke
     * @version 1.0
     * @access private
     */
    private function _getAttribute(string $pin_AttrName) {
        return $this->_xmlObject[0]->$pin_AttrName;
    }

}