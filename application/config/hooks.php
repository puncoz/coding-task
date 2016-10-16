<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| Hooks for DevelBar [CI Developers Bar]
|
*/
$hook['display_override'][] = [
    'class'       => 'Develbar',
    'function'    => 'debug',
    'filename'    => 'Develbar.php',
    'filepath'    => 'third_party/DevelBar/hooks',
];
