<?php
/**
 * File level comments for FFangle magic_quotes.php
 * @todo       Optimize: verify documentation
*/

/**
 * stripSlashesDeep
 * @package    FFangle
 * @param      string to strip slashes from
 */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

/**
 * removeMagicQuotes
 * @package    FFangle
 */
function removeMagicQuotes() {
	if (get_magic_quotes_gpc() ) {
	    $_GET    = stripSlashesDeep($_GET   );
	    $_POST   = stripSlashesDeep($_POST  );
	    $_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

