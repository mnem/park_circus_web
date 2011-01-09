<?php

/****************************************************************************
Licensed under the MIT license:

    http://www.opensource.org/licenses/mit-license.php

(c) Copyright 2010 David Wagner.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
****************************************************************************/

require_once 'GlobalConfiguration.php';

/**************************************
	Basic list variables
*/
// Park Circus
$LIST_ID = '4b1d551684';
$DOWNLOAD_LIST_ID = '';
$CAMPAIGN_ID = 'db5566f17d';

// Noise & Heat
// $LIST_ID = 'd5ab9a68b7';
// $DOWNLOAD_LIST_ID = '1e7247edb0';
// $CAMPAIGN_ID = 'df790ef2b8';

$DEBUG=false;

/**************************************
	Join the email address to the list and send the
	welcome email.
*/

function joinList($listId, $email, $sendWelcome)
{
	global $CHIMP;
	global $DEBUG;

	$mergeVars = array ();
	$emailType='html';
	$doubleOptin=false;
	$updateExisting=false;
	$replaceInterests=true;

	// Join the main list
	$retval = $CHIMP->listSubscribe($listId,
									$email,
									$mergeVars,
									$emailType,
									$doubleOptin,
									$updateExisting,
									$replaceInterests,
									$sendWelcome);

	if($DEBUG)
	{
		if ($CHIMP->errorCode)
		{
			echo "Unable to execute listSubscribe()!<br>";
			echo "\tCode=".$CHIMP->errorCode."<br>";
			echo "\tMsg=".$CHIMP->errorMessage."<br>";
		}
		else
		{
			echo "Subscribed - look for the confirmation email!<br>";
		}
	}
}

function sendTransactionalCampaign($campaignId)
{
	global $CHIMP;
	global $DEBUG;

	// Join the main list
	$retval = $CHIMP->campaignSendNow($campaignId);

	if($DEBUG)
	{
		if ($CHIMP->errorCode)
		{
			echo "Unable to execute campaignSendNow()!<br>";
			echo "\tCode=".$CHIMP->errorCode."<br>";
			echo "\tMsg=".$CHIMP->errorMessage."<br>";
		}
		else
		{
			echo "Campaign sent - look for the email!<br>";
		}
	}
}


if(isset($_REQUEST['e']))
{
	// Join the main mailing list
	joinList($LIST_ID, $_REQUEST['e'], false);

	// Join the transactional mailing list
	//joinList($DOWNLOAD_LIST_ID, $_REQUEST['e'], false);

	// Send the download campaign email
	sendTransactionalCampaign($CAMPAIGN_ID);
}
elseif($DEBUG)
{
	echo "No email supplied!<br>";
}

?>
