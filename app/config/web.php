<?php
/**
 * File level comments for FFangle web.php
 * @package    FFangle
 * @todo       Optimize: verify documentation
 */

/* ------------------------------------------------------------------------------------------------- */
// THEMES
/* ------------------------------------------------------------------------------------------------- */

/**
 * @package    FFangle
 */
define('THEMES_DIR', 'themes');

/**
 * @package    FFangle
 */
define('DEFAULT_THEME_NAME', 'default');

/**
 * @package    FFangle
 */
define('DEFAULT_THEME_DIR', THEMES_DIR . DS . DEFAULT_THEME_NAME);


/* ------------------------------------------------------------------------------------------------- */
// IMAGES
/* ------------------------------------------------------------------------------------------------- */

/**
 * currently unused
 * @package    FFangle
 * @todo        Optimize: use DEFAULT_IMAGES_DIR or remove it
 */
define('DEFAULT_IMAGES_DIR', 'images');


/* ------------------------------------------------------------------------------------------------- */
// CSS
/* ------------------------------------------------------------------------------------------------- */

/**
 * @package    FFangle
 */
define('DEFAULT_CSS_DIR', DEFAULT_THEME_DIR . 'css');

/**
 * @package    FFangle
 */
define('DEFAULT_THEME_CSS', DEFAULT_CSS_DIR . DS . 'app.css');


/* ------------------------------------------------------------------------------------------------- */
// JAVASCRIPT
/* ------------------------------------------------------------------------------------------------- */

/**
 * @package    FFangle
 * @todo       Optimize: theme-ify this
 */
define('DEFAULT_JAVASCRIPT_DIR', '/js');

/**
 * @package    FFangle
 */
define('DEFAULT_THEME_JS', DEFAULT_JAVASCRIPT_DIR . DS . 'application.js');

