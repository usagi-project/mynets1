<?php
$config['validate_string_words'] = "/^\w+$/";
$config['validate_string_email'] = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
$config['validate_string_alpha'] = "/^([a-z])+$/i";
$config['validate_string_alpha_numeric'] = "/^([a-z0-9])+$/i";
$config['validate_string_alpha_dash'] = "/^([-a-z0-9_-])+$/i";
$config['validate_string_numeric'] = '/^[\-+]?[0-9]*\.?[0-9]+$/';
$config['validate_string_integer'] = '/^[\-+]?[0-9]+$/';
$config['validate_string_base64'] = '/[^a-zA-Z0-9\/\+=]/';
