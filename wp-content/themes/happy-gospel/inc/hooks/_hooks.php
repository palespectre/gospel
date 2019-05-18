<?php

require_once dirname(__FILE__).'/reset.php';
require_once dirname(__FILE__).'/setup.php';
require_once dirname(__FILE__).'/hooks-ec.php';
require_once dirname(__FILE__).'/roles.php';
require_once dirname(__FILE__).'/wp_enqueue_scripts.php';

if(HAS_BARBA) require_once dirname(__FILE__).'/barba-js.php';
if(HAS_WPML) require_once dirname(__FILE__).'/wpml.php';