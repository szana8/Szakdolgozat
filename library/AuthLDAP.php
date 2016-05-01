<?php
/**
 * Created by PhpStorm.
 * User: Pisti
 * Date: 2016. 04. 30.
 * Time: 21:33
 */

namespace library;

use library\interfaces\Authentication;

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