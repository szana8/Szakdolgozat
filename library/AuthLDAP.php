<?php
/**
 * Link:
 * File: Xml.php
 * Namespace: library
 *
 * Description of AuthLDAP: Az LDAP-os azonosításért felelős osztály.
 *
 *
 *  Version     Date            Author               Changelog
 *   1.0.0      2016. 05. 05.     Pisti                Created
 *
 */

namespace library;
use library\interfaces\Authentication;

if(count(get_included_files()) === 1) {
    echo "<html><head><title>Object not found!</title></head>You can not call this"
        . " file directly!</html>";
    exit();
}

class AuthLDAP implements Authentication {

    /**
     * Viszadja hogy a felhasználó be vna e jeletkezve vagy sem.
     * @return bool                         Sikeres volt e az authentikáció vagy sem
     * @access public
     * @version 1.0
     */
    public static function isAuth() : bool
    {
        // TODO: Implement isAuth() method.
        return true;
    }

    /**
     * Authentikálja a paraméterben kapott user-t. Opcionálisan meg lehet adni
     * beállításokat.
     * @param string $pin_Username A user neve
     * @param string $pin_Password A user jelszava
     * @param array $pin_Options Authentikációs beállítások
     * @return bool                         Sikeres volt e az authentikáció vagy sem
     */
    public static function authUser(string $pin_Username, string $pin_Password, array $pin_Options = array()) : bool
    {
        // TODO: Implement authUser() method.
        return true;
    }

    /**
     * Kijelentkezteti a felhasználót. Lezárja a session-öket.
     * @return bool                         Sikeres volt e a kijelentkezés vagy sem
     */
    public static function logout() : bool
    {
        // TODO: Implement logout() method.
        return true;
    }

    /**
     * Ellenőrzi a felhasználó adatait a hitelesítés előtt.
     * @param string $pin_Username A felhasználó neve
     * @param string $pin_Password A felhasználó jelszava
     * @return bool                         Sikeres volt e az ellenőrzés vagy sem.
     */
    public static function validate(string $pin_Username, string $pin_Password) : bool
    {
        // TODO: Implement validate() method.
        return true;
    }
}