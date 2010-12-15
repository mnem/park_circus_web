<?php
/**
This Example shows how to Subscribe a New Member to a List using the MCAPI.php
class and do some basic error checking.
**/
require_once 'MCAPI.class.php';
require_once 'config.inc.php'; //contains apikey

$api = new MCAPI($apikey);
$api->useSecure(true);

$email = $_REQUEST['e'];
echo "$listId: " + $listId + "\n";
// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!
$retval = $api->listSubscribe( $listId, $my_email );

if ($api->errorCode){
	echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} else {
    echo "Subscribed - look for the confirmation email!\n";
}

?>
