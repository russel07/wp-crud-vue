<?php
/**
 * Plugin Name
 *
 * @package RusCRUD
 * @author Md. Russel Hussain
 * @copyright 2021 rus.org
 * @license GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: WP VUE
 * Plugin URI: https://russel.authlab/plugins
 * Description: Custom CRUD features for admin
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Md. Russel Hussain
 * Author URI: https://russel.authlab
 * Author URI: https://author.example.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://example.com/my-plugin/
 * Text Domain: my-basics-plugin
 * Domain Path: /languages
 */


const PLUGIN_FILE_URL = __FILE__;
const PRODUCT_TABLE = 'products';

require_once 'vendor/autoload.php';
use Russel\RusCrud\Plugin;

$plugin = new Plugin();
$plugin->init();





