<?php
namespace library;
/**
 * Link: 
 * File: database.php
 * Namespace: library
 * 
 * Description of database
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Istvan Szana         Created
 * 
 */

interface Database {

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
    public function __construct();

    /**
     *
     * @return boolean
     */
    public function connect();

    /**
     * Beállítja lefuttatandóvá a paraméterben kapott adatbázis lekérdezést.
     *
     * @param string $pin_Query                                 A query amit le szeretnénk futtatni
     * @version 1.0
     * @access public
     */
    public function query(string $pin_Query);

    /**
     * Beállítja a paraméterben kapott bind attribútumot.
     *
     * @param string $pin_AttributeName                         Az attribútum neve
     * @param string $pin_AttributeValue                        Az attribútum értéke
     * @param array $pin_Option                                 Opciók tömbje
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setAttribute(string $pin_AttributeName, string $pin_AttributeValue, array $pin_Option) : boolean;

    /**
     * Beállít egy limitet a query-hez.
     *
     * @param integer $pin_LimitFrom                            Alsó limit
     * @param integer $pin_NumberOfRecords                      Felső limit
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setLimit(integer $pin_LimitFrom, integer $pin_NumberOfRecords) : boolean;

    /**
     * Beállít egy rendezést a query-nek.
     *
     * @param string $pin_OrderBy                               Mi szerint akarunk rendezni
     * @param string $pin_ASC                                   Növekvő vagy csökkenő sorrendben (ASC/DESC)
     * @return boolean                                          Hiba esetén false-al különben true-val térünk vissza
     * @version 1.0
     * @access public
     */
    public function setOrderByClause(string $pin_OrderBy, string$pin_ASC = "ASC") : boolean;

    /**
     * Visszatér egy attribútum objektumával. Az objektum tartalmazza az értékeket, típust, stb.
     *
     * @param string|NULL $pin_Attributes                       Attribútum neve
     * @return \stdClass                                        Az attribútum objektuma
     * @version 1.0
     * @access public
     */
    public function getAttributes(string $pin_Attributes = NULL) : \stdClass;

    /**
     * Visszatér a lekérdezett rekordok számával.
     *
     * @return integer                                          A rekordok száma
     * @version 1.0
     * @access public
     */
    public function getNumberOfRecords() : integer;

    /**
     * Meghívja a paraméterben kapott sql procedure-t, vagy function-t, majd visszatér az objektumával.
     *
     * @param string $pin_ProcedureName                         A procedure neve
     * @return \stdClass                                        A visszatérési objektum
     * @version 1.0
     * @access public
     */
    public function callProcedure(string $pin_ProcedureName) : \stdClass;
   
}
?>