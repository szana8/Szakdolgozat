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
    'Button.Label.ServerManagement' => 'Server Management',
    'Button.Label.Basic' => 'Basic Settings',
    'Button.Label.Email' => 'Email Notification',
    'Button.Label.ApplicationProperties' => 'Application Properties',
    'Button.Label.LanguageLocalization' => 'Language and Localization',
    'Label.Text.DatabaseType' => 'Database Type',
    'Label.Text.HostName' => 'Hostname',
    'Label.Text.PORT' => 'Port',
    'Form.Select.Option.PostreSQL' => 'Postgre SQL',
    'Form.Select.Option.MySQL' => 'MySQL',
    'Form.Select.Option.OracleDB' => 'Oracle Database',
    'Form.Select.Option.MSSQL' => 'MSSQL',
    'Label.Text.Username' => 'Username',
    'Label.Text.Password' => 'Password',
    'Label.Text.Schema' => 'Schema',
    'Button.Label.Test' => 'Test Connection',
    'Button.Label.Ldap' => 'LDAP User Directory',
    'Label.Text.Host' => 'Host name or IP address of the database server',
    'Label.Text.Tcp' => 'TCP Port Number for the database server',
    'Label.Text.UsernameInfo' => 'The username to access the database',
    'Label.Text.PasswordInfo' => 'The password to access the database',
    'Label.Text.SchemaInfo' => 'Specify the schema name for your database',
    'Label.Text.ServerSettings' => 'Server Settings',
    'Label.Text.LdapSchema' => 'LDAP Schema',
    'Label.Text.Name' => 'Name',
    'Label.Text.DirectoryType' => 'Directory Type',
    'Label.Text.Hostname' => 'Hostname',
    'Label.Text.Suffix' => 'Suffix',
    'Label.Text.BaseDN' => 'Base DN',
    'Label.Text.DomainController' => 'Domain Controller',
    'Label.Text.LdapHost' => 'Hostname of the server running LDAP',
    'Form.Select.Option.MicrosoftActicveDirectory' => 'Microsoft Active Directory',
    'Form.Select.Option.Ldap' => 'LDAP',
    'Label.Text.Description' => 'Description',
    'Label.Text.FromAddress' => 'From Address',
    'Label.Text.EmailPrefix' => 'Email Prefix',
    'Label.Text.SMTPHost' => 'SMTP Host',
    'Label.Text.Protocol' => 'Protocol',
    'Form.Select.Option.SMTP' => 'SMTP',
    'Form.Select.Option.POP3' => 'POP3',
    'Label.Text.TLS' => 'TLS',
    'Label.Text.Title' => 'Application Title',
    'Label.Text.Title' => 'The name of the installation',
    'Label.Text.Mode' => 'Mode',
    'Radio.Label.Private' => 'Private',
    'Label.Text.ModePrivate' => 'Only administrators can create new users',
    'Radio.Label.Public' => 'Public',
    'Label.Text.ModePublic' => 'Anyone can sign up'
));