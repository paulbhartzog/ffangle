<?php
/**
 * File level comments for FFangle error_level.php
 * @todo       Optimize: verify documentation
*/

/**
 * error_level_tostring
 * @package    FFangle
 * @param      integer value
 * @param      separator
 */
function error_level_tostring($intval, $separator)
{
    $errorlevels = array(
        2047 => 'E_ALL',
        1024 => 'E_USER_NOTICE',
        512 => 'E_USER_WARNING',
        256 => 'E_USER_ERROR',
        128 => 'E_COMPILE_WARNING',
        64 => 'E_COMPILE_ERROR',
        32 => 'E_CORE_WARNING',
        16 => 'E_CORE_ERROR',
        8 => 'E_NOTICE',
        4 => 'E_PARSE',
        2 => 'E_WARNING',
        1 => 'E_ERROR');
    $result = '';
    foreach($errorlevels as $number => $name)
    {
        if (($intval & $number) == $number) {
            $result .= ($result != '' ? $separator : '').$name; }
    }
    return $result;
}

// usage
// echo error_level_tostring(error_reporting(), ',');

