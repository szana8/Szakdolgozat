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
        $loc_List = $loc_DB->query('SELECT menu_id
                                           ,menu_name
                                           ,menu_type
                                           ,menu_parent_id
                                           ,sequence
                                      FROM apps.fnd_menus
                                     ORDER BY menu_type ASC, 
                                              menu_parent_id ASC, 
                                              sequence ASC');
        return $this->createMenuHierarchy($loc_List);
    }


    public function createMenuHierarchy($pin_Array) {
        $loc_Tree = array();
        foreach ($pin_Array as $loc_Key => $loc_Item) {
            if($loc_Item['menu_type'] == 1) {
                $loc_Tree['parent'][$loc_Item['menu_id']] = array('name' => $loc_Item['menu_name'], 'id' => $loc_Item['menu_id']);
            }
            else {
                $loc_Tree['parent'][$loc_Item['menu_parent_id']]['children'][$loc_Item['sequence']] = $loc_Item['menu_name'];
            }
        }
        return $loc_Tree['parent'];
    }


}