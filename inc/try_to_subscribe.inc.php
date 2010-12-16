<?php
/**
This Example shows how to Subscribe a New Member to a List using the MCAPI.php
class and do some basic error checking.
**/
require_once 'MCAPI.class.php';
require_once 'config.inc.php'; //contains apikey

if(isset($_REQUEST['e']))
{
	$email = $_REQUEST['e'];

	$api = new MCAPI($apikey);
	$api->useSecure(true);

	// By default this sends a confirmation email - you will not see new members
	// until the link contained in it is clicked!
	$retval = $api->listSubscribe( $listId, $email );

// 	if ($api->errorCode)
// 	{
// 		echo "Unable to load listSubscribe()!<br>";
// 		echo "\tCode=".$api->errorCode."<br>";
// 		echo "\tMsg=".$api->errorMessage."<br>";
// 	}
// 	else
// 	{
// 		echo "Subscribed - look for the confirmation email!<br>";
// 	}
}
else
{
//	echo "No email supplied!<br>";
}

?>
