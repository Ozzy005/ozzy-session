<?php

define('SESSION_LIFETIME', 1440); //EM SEGUNDOS
define('REGENERATE_SESSION', 60); //EM SEGUNDOS

ini_set('session.cache_expire', 60);
ini_set('session.cache_limiter', 'nocache');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_lifetime', 0);
ini_set('session.cookie_secure', 0);
ini_set('session.gc_divisor', 1000);
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.gc_probability', 0);
ini_set('session.lazy_write', 1);
ini_set('session.name', 'ozzy-session');
ini_set('session.referer_check', '');
ini_set('session.serialize_handler', 'php_serialize');
ini_set('session.sid_bits_per_character', 5);
ini_set('session.sid_length', 32);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_trans_sid', 0);
