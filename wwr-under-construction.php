<?php
/**
 * Plugin Name: WWReliable WP Under Construction
 * Plugin URI:
 * Description: A WWReliable Plugin to show a Under Construction page
 * Version: 1.0.4
 * Requires at least: 6.1
 * Requires PHP: 8.0
 * Author: Wessels Webdevelopment
 * Author URI: https://wessels-webdevelopment.nl
 * Licence: GPLv2 or later
 *
 * Text Domain: wwr-under-construction
 * Domain Path: languages
 *
 * Copyright 2013-2022 Wesssels Webdevelopment
 */
defined( 'ABSPATH' ) || exit;

require_once __DIR__ .'/vendor/autoload.php';

use WWReliable\UnderConstruction\Init;
new Init();