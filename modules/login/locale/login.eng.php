<?php
/**
 * Created by PhpStorm.
 * User: HUSzanaI
 * Date: 2016.04.15.
 * Time: 9:54
 */

// Közvetlen hívás esetén megjelenítjük az Object not found! oldalt.
if(count(get_included_files()) === 1) {
    http_response_code(404);
    echo "<html><head><title>Object not found!</title></head><frameset><frame src=\"./notfound\"></frameset></html>";
    exit();
}

\library\Language::setLang(array(
    'Label.Text.Welcome' => 'Welcome',
    'Label.Text.Username' => 'Username',
    'Field.EmptyText.Username' => 'Username',
    'Label.Text.Password' => 'Password',
    'Field.EmptyText.Password' => 'Password',
    'Label.Text.RememberMe' => 'Remember Me',
    'Button.Attr.Text.PleaseWait' => 'Please wait...',
    'Button.Text.Login' => 'Log In',
    'Message.DoNotHaveLoginHeader' => '<b>Don\'t have a login?</b>',
    'Message.DoNotHaveLoginMessage' => 'Not a member? Please contact your administrator to request an account or follow the <a href="#">setup wizard</a>.'
));