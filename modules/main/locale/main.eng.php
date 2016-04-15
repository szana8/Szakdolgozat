<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.15.
 * Time: 13:02
 */

// Közvetlen hívás esetén megjelenítjük az Object not found! oldalt.
if(count(get_included_files()) === 1) {
    http_response_code(404);
    echo "<html><head><title>Object not found!</title></head><frameset><frame src=\"./notfound\"></frameset></html>";
    exit();
}

\library\Language::setLang(array(
    'Button.Label.AddGadget' => 'Add Gadget',
    'Button.Label.EditLayout' => 'Edit Layout',
    'Button.Label.Tools' => 'Tools',
    'Button.Label.CopyDashboard' => 'Copy Dashboard',
    'Button.Label.EditDashboard' => 'Edit Dashboard',
    'Button.Label.DeleteDashboard' => 'Delete Dashboard',
    'Button.Label.FindDashboard' => 'Find Dashboard',
    'Button.Label.CreateDashboard' => 'Create Dashboard',
    'Button.Label.Edit' => 'Edit',
    'Button.Label.Minimize' => 'Minimize',
    'Button.Label.Delete' => 'Delete'
));