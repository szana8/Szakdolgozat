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
    'MSG.ERROR.INVALID_FILE_NAME' => 'Invalid file name!'
));