<?php
/**
 * TegoNuke Mailer: Replaces Native PHP Mail
 *
 * Inspired by Nuke-Evolution and PHPNukeMailer.  Uses PHPNukeMailer for
 * the administration of the mailer functions and Swift Mailer library
 * of classes to perform the actual mail functions.
 *
 * Will be used to replace PHP mail() function throughout RavenNuke(tm) /
 * PHP-Nuke.  This has become necessary as Hosts have started locking down
 * access to the mail() function and requiring SMTP authentication.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2
 *
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @category    "Plumbing"
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
define('_TNML_MNU_BACK2ADM_LAB', 'Site Administration');
define('_TNML_MNU_MAILCFG_LAB', 'TegoNuke Mailer Settings');
define('_TNML_MNU_PNMABOUT_LAB', 'About TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Hover your cursor over these icons for detailed help text');
define('_TNML_HLP_LEGEND_HLP', 'Yes, that is it!');
define('_TNML_PNMACTIVATE_LAB', 'Activate Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Activates or deactivates the mailer.<br /><br />If you find your RavenNuke(tm) / PHP-Nuke system is not sending emails, your host may have locked down the use of the PHP mail() function. You may to use authenticated SMTP, which is where this Mailer comes in.<br /><br /><b>No</b> = Default, native PHP mail() function is used.  This is the default.<br /><br /><b>Yes</b> = Will activate the Mailer and allow you to then choose next your <b>Send Method</b>.<br /><br />(See help pop-up on Send Method for what you can configure next.)');
define('_TNML_SENDMETHOD_LAB', 'Send Method');
define('_TNML_SENDMETHOD_HLP', 'Specify the desired send method.<br /><br />Most of the time, if you are needing to use this Mailer, your host will be asking you to use authenticated SMTP.  In this case, select the SMTP option and additional SMTP configuration settings will appear. Currently, the options available to use are:<br /><br /><b>Mail()</b> = This is the default native PHP mail() function.  (If the PHP mail() function is working for you with the mailer deactivated, you could use the mailer and get the additional features of better error handling and batch send processing.<br /><br /><b>SMTP</b> = Choosing this option will open up additional settings for you to configure.  This may be your only option to use if your host has disabled the native PHP mail() function. (NOTE: if your host requires you to use SMTP, you must also configure the SMTP settings within the Forums Configuration.)<br /><br /><b>SendMail</b> = This would use the sendmail daemon.  It would be rare for any host to require this over authenticated SMTP, but just in case you need it, it is here.');
define('_TNML_SMTPHOST_LAB', 'SMTP Server');
define('_TNML_SMTPHOST_HLP', 'Specify SMTP host name - e.g. smtp.yourdomain.tld or mail.yourdomain.tld.<br /><br />Most hosting packages will come with some form of control panel.  We recommend you use your control panel to create a new email account on your server that will ONLY be used for sending emails (use a different password than that of your main account).  Once this is set up, or even if you have to use your main hosting email account, your control panel should have an option to show you what the required SMTP connection settings are, including the proper host name. If not, ask them for all of these needed SMTP settings.');
define('_TNML_SMTPHELO_LAB', 'SMTP Helo');
define('_TNML_SMTPHELO_HLP', 'Specify the SMTP Helo.<br /><br />This is usually the same as SMTP HOST.  Try making them the same and if it does not work, ask your host for what this should be.');
define('_TNML_SMTPPORT_LAB', 'SMTP Port');
define('_TNML_SMTPPORT_HLP', 'Specify SMTP port.<br /><br />This is usually 25, but your host could require you to use a different port. <b>NOTE:</b> This mailer currently does not support secure (SSL) connections (not to be confused with authenticated connections)!');
define('_TNML_SMTPAUTH_LAB', 'SMTP Authentication');
define('_TNML_SMTPAUTH_HLP', 'Activate SMTP authentication.<br /><br />Most hosts will require you to provide authentication user and password, which should be the email account and password for the new account you just set up, or could be that of your main email account (not recommended).');
define('_TNML_SMTPUSER_LAB', 'SMTP Username');
define('_TNML_SMTPUSER_HLP', 'Specify SMTP username.<br /><br />This one can be the same as your email account user name that you set up, or, depending upon the control panel and SMTP server, it could a bit different.<br /><br />For example, if the user you set up was called <b>user</b>, we have seen the following forms of username: <b>user</b>, <b>user@yourdomain.tld</b>, and <b>user+yourdomain.tld</b>.<br /><br />If you cannot get it to work, you may have to ask your host.');
define('_TNML_SMTPPASS_LAB', 'SMTP Password');
define('_TNML_SMTPPASS_HLP', 'Specify SMTP password.<br /><br />Enter this just as you set up.');
define('_TNML_SENDMAIL_LAB', 'Sendmail Path');
define('_TNML_SENDMAIL_HLP', 'Absolute path to run Sendmail.<br /><br />It would be rare that your host would require you to use this daemon as in our opinion, it can be easily exploited if not set up properly.  But, if you need it, it is here.  If the default path does not work for you, you may have to ask your host for what this needs to be.');
/*
 * Following defines not used right now, for the moment
 *
define('_TNML_QMAIL_LAB', 'Qmail Path');
define('_TNML_QMAIL_HLP', 'Absolute path to run Qmail');
 */
?>