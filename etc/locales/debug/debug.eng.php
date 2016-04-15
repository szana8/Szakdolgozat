<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.15.
 * Time: 12:51
 */

// Közvetlen hívás esetén megjelenítjük az Object not found! oldalt.
if(count(get_included_files()) === 1) {
    http_response_code(404);
    echo "<html><head><title>Object not found!</title></head><frameset><frame src=\"./notfound\"></frameset></html>";
    exit();
}

\library\Language::setLang(array(

));