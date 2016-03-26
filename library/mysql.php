<?php

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

namespace library;

class Mysql implements Database {

    /**
     *
     * @param type $pin_Dsn
     * @param type $pin_Username
     * @param type $pin_Password
     * @param type $pin_Option
     */
    public function connect($pin_Dsn, $pin_Username, $pin_Password, $pin_Option)
    {
        // TODO: Implement connect() method.
    }

    /**
     *
     * @param type $pin_Query
     */
    public function query($pin_Query)
    {
        // TODO: Implement query() method.
    }

    /**
     *
     * @param type $pin_AttributeName
     * @param type $pin_AttributeValue
     * @param type $pin_Option
     */
    public function setAttribute($pin_AttributeName, $pin_AttributeValue, $pin_Option)
    {
        // TODO: Implement setAttribute() method.
    }

    /**
     *
     * @param type $pin_LimitFrom
     * @param type $pin_NumberOfRecords
     */
    public function setLimit($pin_LimitFrom, $pin_NumberOfRecords)
    {
        // TODO: Implement setLimit() method.
    }

    /**
     *
     * @param type $pin_OrderBy
     * @param type $pin_ASC
     */
    public function setOrderByClause($pin_OrderBy, $pin_ASC = "ASC")
    {
        // TODO: Implement setOrderByClause() method.
    }

    /**
     *
     * @param type $pin_Attributes
     */
    public function getAttributes($pin_Attributes = NULL)
    {
        // TODO: Implement getAttributes() method.
    }

    /**
     *
     */
    public function getNumberOfRecords()
    {
        // TODO: Implement getNumberOfRecords() method.
    }

    /**
     *
     * @param type $pin_ProcedureName
     */
    public function callProcedure($pin_ProcedureName)
    {
        // TODO: Implement callProcedure() method.
    }
}

?>