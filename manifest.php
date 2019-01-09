<?php if (!defined('FW')) die('Forbidden');

$manifest = array();

$manifest['name'] = __('Global Modules', '{domain}');
$manifest['uri'] = 'https://gitlab.com/basemaster/global-modules';
$manifest['description'] = __('This extension lets you add common base components and view them in separate pages.', '{domain}');
$manifest['version'] = 'dev-1.0';
$manifest['author'] = 'Tharindu W';
$manifest['gitlab_repo'] = 'https://gitlab.com/basemaster/global-modules\'.git';


/**
 * @type bool Display on the Extensions page or it's a hidden extension
 */
$manifest['display'] = true;
/**
 * @type bool If extension can exist alone
 * false - There is no sense for it to exist alone, it exists only when is required by some other extension.
 * true  - Can exist alone without bothering about other extensions.
 */
$manifest['standalone'] = true;
/**
 * @type string Thumbnail used on the Extensions page
 * All framework extensions has thumbnails set in the available extensions list
 * but if your extension is not in that list and id located in the theme, you can set the thumbnail via this parameter
 */
$manifest['thumbnail'] = plugin_dir_url(__FILE__) . 'static/img/global-module.jpg';

