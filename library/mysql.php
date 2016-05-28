<?php
namespace library;
use \PDO, \PDOException;
/**
 * Link: 
 * File: mysql.php
 * Namespace: library
 * 
 * Description of mysql
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Pisti              Created
 * 
 */



class Mysql implements interfaces\Database {

################################################################################
# 1. Constants #################################################################
################################################################################

    const   databaseConnectionError         = 'mys00001';


################################################################################
# 2. Public Properties #########################################################
################################################################################

    public $fetchMode   = PDO::FETCH_OBJ;

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    /**
     * Az adatbázis objektumát tartalmazó attribútum.
     * @var
     */
    protected $_dbObject;

    /**
     * Az adatbázis nevét tartalmazó attribútum.
     * @var string
     */
    protected $_pdoDB = "";

    /**
     * Az adatbázis host címét vagy nevét tartalmazó attribútum.
     * @var string
     */
    protected $_pdoHost = "";

    /**
     * Az adatbázis kapcsolathoz szükséges felhasználó nevét tartalmazó attribútum.
     * @var string
     */
    protected $_pdoUsername = "";

    /**
     * Az adatbázis kapcsolathoz szükséges jelszót tartalmazó attribútum.
     * @var string
     */
    protected $_pdoPassword = "";

    /**
     * Az adatbázis kapcsolat típusát tartalmazó attribútum.
     * @var string
     */
    protected $_pdoDBType = "";

    /**
     * Az adatbázis kapcsolat opcióit tartalmató attribútum.
     * @var array
     */
    protected $_pdoOption = array();

################################################################################
# 4. Public Methods ############################################################
################################################################################

    /**
     * Kapcsolatot teremt a paraméterben megadott adatbázis sémával, a megadott username
     * és password alapján.
     *
     * @param string $pin_Schema                                A séma neve
     * @param string $pin_Host                                  A Host neve vagy címe
     * @param string $pin_Username                              A username a kapcsolódáshoz
     * @param string $pin_Password                              A password a kapcsolódáshoz
     * @param array $pin_Option                                 Beállítások a kapcsolódáshoz
     * @return boolean                                          Sikeres volt e a kapcsolat vagy sem
     * @version 1.0
     * @access public
     */
    public function __construct($pin_FetchMode = \PDO::FETCH_OBJ) {
        $this->_pdoDB = \library\File::getIniContent(APPS_D_CONFIG . "db-config.ini")->SCHEMA;
        $this->_pdoHost = \library\File::getIniContent(APPS_D_CONFIG . "db-config.ini")->HOST;
        $this->_pdoUsername = \library\File::getIniContent(APPS_D_CONFIG . "db-config.ini")->USERNAME;
        $this->_pdoPassword = \library\File::getIniContent(APPS_D_CONFIG . "db-config.ini")->PASSWORD;
        $this->_pdoDBType = 'MySQL';
        $this->_pdoOption = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $this->_dbObject = new \stdClass();
        $this->fetchMode = $pin_FetchMode;
        return $this->connect();
    }

    /**
     * @return boolean
     */
    public function connect()
    {
        try {
            $this->_dbObject = new \PDO('mysql:host='.$this->_pdoHost.';dbname='.$this->_pdoDB.'',
                                        $this->_pdoUsername, $this->_pdoPassword, $this->_pdoOption);

            $this->_dbObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_dbObject->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->_dbObject->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->fetchMode);
            return $this->_dbObject;
        }
        catch(\PDOException $pout_Err) {
            Debug::setDebugMessage(array(__METHOD__, self::databaseConnectionError, "{MSG.ERROR.DB_CONNECTION_ERROR}", "error", $pout_Err->getMessage()));
            return false;
        }
    }

    /**
     * Beállítja lefuttatandóvá a paraméterben kapott adatbázis lekérdezést.
     *
     * @param string $pin_Query A query amit le szeretnénk futtatni
     * @version 1.0
     * @access public
     */
    public function query(string $pin_Query)
    {
        try
        {
            $loc_Query = $this->_dbObject->prepare($pin_Query);
            $loc_Query->execute();

            return $loc_Query->fetchAll();
        }
        catch(\Exception $pout_Err) {
            return $pout_Err->getMessage();
        }
    }

    /**
     * Beállítja a paraméterben kapott bind attribútumot.
     *
     * @param string $pin_AttributeName Az attribútum neve
     * @param string $pin_AttributeValue Az attribútum értéke
     * @param array $pin_Option Opciók tömbje
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setAttribute(string $pin_AttributeName, string $pin_AttributeValue, array $pin_Option) : bool
    {
        // TODO: Implement setAttribute() method.
        return false;
    }

    /**
     * Beállít egy limitet a query-hez.
     *
     * @param integer $pin_LimitFrom Alsó limit
     * @param integer $pin_NumberOfRecords Felső limit
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setLimit(\integer $pin_LimitFrom, \integer $pin_NumberOfRecords) : bool
    {
        // TODO: Implement setLimit() method.
        return false;
    }

    /**
     * Beállít egy rendezést a query-nek.
     *
     * @param string $pin_OrderBy Mi szerint akarunk rendezni
     * @param string $pin_ASC Növekvő vagy csökkenő sorrendben (ASC/DESC)
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setOrderByClause(string $pin_OrderBy, string $pin_ASC = "ASC") : bool
    {
        // TODO: Implement setOrderByClause() method.
        return false;
    }

    /**
     * Visszatér egy attribútum objektumával. Az objektum tartalmazza az értékeket, típust, stb.
     *
     * @param string|NULL $pin_Attributes Attribútum neve
     * @return \stdClass                                        Az attribútum objektuma
     * @version 1.0
     * @access public
     */
    public function getAttributes(string $pin_Attributes = NULL) : \stdClass
    {
        // TODO: Implement getAttributes() method.
        $obj_Tmp = new \stdClass();
        return $obj_Tmp;
    }

    /**
     * Visszatér a lekérdezett rekordok számával.
     *
     * @return integer                                          A rekordok száma
     * @version 1.0
     * @access public
     */
    public function getNumberOfRecords() : \integer
    {
        // TODO: Implement getNumberOfRecords() method.
        return 0;
    }

    /**
     * Meghívja a paraméterben kapott sql procedure-t, vagy function-t, majd visszatér az objektumával.
     *
     * @param string $pin_ProcedureName A procedure neve
     * @return \stdClass                                        A visszatérési objektum
     * @version 1.0
     * @access public
     */
    public function callProcedure(string $pin_ProcedureName) : \stdClass
    {
        // TODO: Implement callProcedure() method.
        $obj_Tmp = new \stdClass();
        return $obj_Tmp;
    }


################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################

}

?>