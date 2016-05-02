<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.15.
 * Time: 14:14
 */

namespace library;


class Menu {

    /**
     * Itt meg kell nézni először hogy a user be van e jelentkezve. Ha be van lekérjük a hozzá tartozó menüt, majd objektumként
     * visszadjuk, minden menu elem egy objektum az obj-ban, ami tartalmazza az menu nevét, a parent elemet, disable vagy sem
     * aktív e vagy sem, ikon-ját ha van, tooltip-et ha van, link a module-hoz stb.
     *
     *
     * @return string
     */
    public function createMenu() {
        $loc_DB = new \library\Mysql(\PDO::FETCH_ASSOC);
        $loc_List = $loc_DB->query('SELECT fm.menu_id
                                          ,menu_name
                                          ,menu_type
                                          ,menu_parent_id
                                          ,sequence
                                          ,fa.basepath
                                      FROM apps.fnd_menus fm
                                 LEFT JOIN apps.fnd_application fa 
                                        ON fm.menu_id = fa.menu_id AND fa.enabled = "Y"
                                     WHERE fm.enabled = "Y"
                                     ORDER BY menu_type ASC, 
                                              menu_parent_id ASC, 
                                              sequence ASC');
        return $loc_List;
    }



}