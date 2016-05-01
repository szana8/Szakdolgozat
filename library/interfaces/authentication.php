<?php
namespace library\interfaces;
/**
 * Link:
 * File: authsql.php
 * Namespace: library
 *
 * Description of authentication
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2015.11.28.     Pisti                Created
 *
 */

/**
 * A Userek azonosítására szolgáló interfész. Különböző azonosítási típusok (LDAP, SQL) implementálhatóak
 * belőle.
 * Interface Authentication
 * @package library\interfaces
 */
/**
 * Interface Authentication
 * @package library\interfaces
 */
interface Authentication {


    /**
     * Viszadja hogy a felhasználó be vna e jeletkezve vagy sem.
     * @return bool                         Sikeres volt e az authentikáció vagy sem
     * @access public
     * @version 1.0
     */
    public static function isAuth() : bool;

    /**
     * Authentikálja a paraméterben kapott user-t. Opcionálisan meg lehet adni
     * beállításokat.
     * @param string $pin_Username          A user neve
     * @param string $pin_Password          A user jelszava
     * @param array $pin_Options            Authentikációs beállítások
     * @return bool                         Sikeres volt e az authentikáció vagy sem
     */
    public static function authUser(string $pin_Username, string $pin_Password, array $pin_Options = array()) : bool;

    /**
     * Kijelentkezteti a felhasználót. Lezárja a session-öket.
     * @return bool                         Sikeres volt e a kijelentkezés vagy sem
     */
    public static function logout() : bool;

    /**
     * Ellenőrzi a felhasználó adatait a hitelesítés előtt.
     * @param string $pin_Username          A felhasználó neve
     * @param string $pin_Password          A felhasználó jelszava
     * @return bool                         Sikeres volt e az ellenőrzés vagy sem.
     */
    public static function validate(string $pin_Username, string $pin_Password) : bool;
}

?>