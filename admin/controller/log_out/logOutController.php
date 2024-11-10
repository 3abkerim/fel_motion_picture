<?php
require_once('../../../config.php');

session_start();

session_destroy();

$indexLocation = sprintf('Location: %s', ADMIN_PUBLIC_URL);

header($indexLocation);