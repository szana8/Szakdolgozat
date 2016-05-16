<?php
/**
 * Created by PhpStorm.
 * User: Pisti
 * Date: 2016. 05. 01.
 * Time: 20:25
 */

if(count(get_included_files()) === 1) {
    http_response_code(404);
    echo "<html><head><title>Object not found!</title></head><frameset><frame src=\"./notfound\"></frameset></html>";
    exit();
}


\library\Language::setLang(array(
    'APP.MENU.LOGO' => '<img style="position: relative;margin-top: -10px" src="'.__ROOT_URL__.'images/Atlassian_Logo.png">',
    'APP.MENU.DASHBOARDS' => 'Dashboards',
    'APP.MENU.SYSTEM' => 'System',
    'APP.MENU.SERVER_MANAGEMENT' => 'Server Management',
    'APP.MENU.DATABASE_MANAGEMENT' => 'Database Management',
    'APP.MENU.MANAGE_USER' => 'Manage User',
    'APP.MENU.MANAGE_RESPONSIBILITY' => 'Manage Responsibility',
    'APP.MENU.MANAGE_RESPONSIBILITY_LOOKUP' => 'Responsibility Lookups',
    'APP.MENU.MANAGE_METADATA' => 'Metadata',
    'APP.MENU.PLUGINS' => 'Plugins',
    'APP.MENU.PLUGINS_LIST' => 'Plugins List',
    'APP.MENU.MODULE_LIST' => 'Module List',
    'APP.MENU.INSTALL_PLUGIN' => 'Install Plugin',
    'APP.MENU.INSTALL_MODULE' => 'Install Module'
));