<?php

require_once 'MCAPI.class.php';
require_once 'API_KEY.php';

// Create the global mailchimp API object
$CHIMP = new MCAPI($API_KEY);
$CHIMP->useSecure(true);

?>
