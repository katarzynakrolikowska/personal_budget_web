<?php
define('ACTION_OK', 1);
define('INVALID_DATA', 2);
define('SERVER_ERROR', 3);
define('FORM_DATA_MISSING', 4);
define('PASSWORDS_DO_NOT_MATCH', 5);
define('LOGIN_ALREADY_EXISTS', 6);

define('MIN_LENGTH_USERNAME', 3);
define('MAX_LENGTH_USERNAME', 50);

define('MIN_LENGTH_LOGIN', 3);
define('MAX_LENGTH_LOGIN', 50);

define('MIN_LENGTH_PASSWORD', 8);
define('MAX_LENGTH_PASSWORD', 20);

define('START_DATE', '1900-01-01');


define('FORM_REGISTRATION_FIELDS', array('username', 'login', 'password1', 'password2'));
define('LOGIN_FORM_FIELDS', array('login', 'password'));
define('INCOME_FORM_FIELDS', array('amount', 'date', 'category'));
define('EXPENSE_FORM_FIELDS', array('amount', 'date', 'paymentMethod','category'));
define('BALANCE_MODAL_FORM_FIELDS', array('startDate', 'endDate'));