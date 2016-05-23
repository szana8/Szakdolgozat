<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.15.
 * Time: 9:50
 */

if(count(get_included_files()) === 1) {
    http_response_code(404);
    echo "<html><head><title>Object not found!</title></head><frameset><frame src=\"./notfound\"></frameset></html>";
    exit();
}


\library\Language::setLang(array(
    'APP_D_ROOT' => APPS_D_ROOT,
    '__ROOT_URI__' => __ROOT_URI__,
    '__ROOT_URL__' => __ROOT_URL__,
    'MSG.ERROR.INVALID_FILE_NAME' => 'Invalid file name!',
    'MENU.ITEM.LABEL.PROFILE_OPTIONS' => 'Profile Option',
    'MENU.ITEM.LABEL.PROFILE' => 'Profile',
    'MENU.ITEM.LABEL.MARKETPLACE' => 'Marketplace',
    'MENU.ITEM.LABEL.HOME' => 'Home',
    'MENU.ITEM.LABEL.DASHBOARD' => 'Dashboard',
    'MENU.ITEM.LABEL.LOGOUT' => 'Log Out',
    'MENU.ITEM.LABEL.ADMINISTRATION' => 'Administration',
    'MENU.ITEM.LABEL.USER_MANAGEMENT' => 'User Management',
    'MENU.ITEM.LABEL.ADDONS' => 'Add-ons',
    'MENU.ITEM.LABEL.ISSUES' => 'Issues',
    'MENU.ITEM.LABEL.SYSTEM' => 'System',
    'MENU.ITEM.LABEL.AUDIT_LOG' => 'Audit Log',
    'Form.Select.Option.Select' => 'Please Select One',
    'Button.Label.Cancel' => 'Cancel',
    'Button.Label.Save' => 'Save',
    'Label.Text.Enabled' => 'Enabled',
    'Label.Text.Disabled' => 'Disabled'
));