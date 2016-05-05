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
    'Button.Label.Upload' => 'Upload',
    'Button.Label.Cancel' => 'Cancel',
    'Button.Label.Addons' => 'Add-ons',
    'Button.Label.VersionAndLicences' => 'Versions and licences',
    'Button.Label.FindNewAddons' => 'Find new add-ons',
    'Button.Label.ManageAddons' => 'Manage add-ons',
    'Text.UploadInfo' => 'Upload the .zip file for a custom third party add-on here.
                          The .zip has to contains a pom.xml with the following information:',
    'List.Element.GroupID' => 'GroupID',
    'List.Element.ArtifactID' => 'ArtifactID',
    'List.Element.Version' => 'Version',
    'List.Element.Name' => 'Name',
    'List.Element.Description' => 'Description',
    'Text.ManageAddons' => 'Manage Add-ons',
    'Text.InstallUpdate' => 'You may install update and enable/disable add-ons here.',
    'Text.AddonData' => 'All add-on data displayed below is for the lates known product version.',
    'Text.AddonCompatibility' => 'Add-on compatibility whith this version is unverified. Install add-ons at your own risk.',
    'Select.Value.All' => 'All',
    'Select.Value.PhpExtension' => 'PHP Extensions',
    'Select.Value.CssExtension' => 'CSS Extensions',
    'Select.Value.JavaScriptExtensions' => 'JavaScript Extensions',
    'Select.Value.Framework' => 'Framework',
    'Select.Value.Autoload' => 'Autoload',
    'Button.Label.UploadAddon' => 'Upload Add-on',
    'Text.AddonList' => 'Add-on list',
    'Label.Text.UploadFromThisComputer' => 'From my computer'
));