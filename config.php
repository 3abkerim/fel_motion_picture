<?php
// config.php
const BASE_PATH = '/Applications/MAMP/htdocs/fml';
const SRC_PATH = BASE_PATH . '/src';
const CLASSES_PATH = SRC_PATH . '/classes';
const PUBLIC_PATH = BASE_PATH . '/public';
const VUE_PATH = BASE_PATH . '/vue';
const ASSETS_PATH = PUBLIC_PATH . '/assets';
const IMAGES_PATH = ASSETS_PATH . '/images';


// config.php Admin
const ADMIN_BASE_PATH = '/Applications/MAMP/htdocs/fml/admin';
const ADMIN_VUE_PATH = ADMIN_BASE_PATH . '/vue';
//const ADMIN_ASSETS_PATH = ADMIN_PUBLIC_PATH . '/assets';

//const ADMIN_CONTROLLERS_PATH = ADMIN_BASE_PATH . '/controller';




// URL paths for client-side access
const BASE_URL = '/fml';
const ADMIN_BASE_URL = BASE_URL . '/admin';

const PUBLIC_URL = BASE_URL . '/public';


const ASSETS_URL = PUBLIC_URL . '/assets';
const IMAGES_URL = ASSETS_URL . '/images';

// ADMIN
const ADMIN_PUBLIC_URL = ADMIN_BASE_URL . '/public';
const ADMIN_INDEX_URL = ADMIN_PUBLIC_URL . '/index.php';

const ADMIN_ASSETS_URL = ADMIN_PUBLIC_URL . '/assets';
const ADMIN_CONTROLLERS_URL = ADMIN_BASE_URL . '/controller';
?>