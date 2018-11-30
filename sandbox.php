<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paypal Integration Test</title>
</head>
<body>
    <form class="paypal" action="payments.php" method="post" id="paypal_form">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="Customer's First Name" />
        <input type="hidden" name="last_name" value="Customer's Last Name" />
        <input type="hidden" name="payer_email" value="customer@example.com" />
        <input type="hidden" name="item_number" value="123456" / >
        <input type="submit" name="submit" value="Submit Payment"/>
    </form>

</body>
</html>
<?php
// Copy
// The business name, price, submit type, notify URL and other sensitive values will be sent during the next step.
//
// A full list of the values to send can be found at the PayPal website under the title "A Sample IPN Message and Response".
//
// STEP 3 – THE REQUEST
//
// The payment.php page will be used to handle the outgoing request to PayPal and also to handle the incoming response after the payment has been processed.
//
// To make a request for payment we need to first build up the parameters and pass these to PayPal via the query string.
//
// We need to pass the following values:
//
// business - the email address of your PayPal account
// item_name - the name of the item being purchased
// amount - the price of the item
// return - the address to return to after a successful payment
// cancel_return - the address to return to after a cancelled payment
// notify_url - the address of the payments.php page on your website
// custom - any other data to be sent and returned with the PayPal request


//
//
// bpn








// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => 'oweipadei333coding',
    'name' => 'jewelry'
];

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'email' => 'user@example.com',
    'return_url' => 'http://example.com/payment-successful.html',
    'cancel_url' => 'http://example.com/payment-cancelled.html',
    'notify_url' => 'http://example.com/payments.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$itemName = 'Test Item';
$itemAmount = 5.00;

// Include Functions
require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

    // Grab the post data so that we can set up the query string for PayPal.
    // Ideally we'd use a whitelist here to check nothing is being injected into
    // our post data.
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = stripslashes($value);
    }

    // Set the PayPal account.
    $data['business'] = $paypalConfig['email'];

    // Set the PayPal return addresses.
    $data['return'] = stripslashes($paypalConfig['return_url']);
    $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
    $data['notify_url'] = stripslashes($paypalConfig['notify_url']);

    // Set the details about the product being purchased, including the amount
    // and currency so that these aren't overridden by the form data.
    $data['item_name'] = $itemName;
    $data['amount'] = $itemAmount;
    $data['currency_code'] = 'GBP';

    // Add any custom fields for the query string.
    //$data['custom'] = USERID;

    // Build the query string from the data.
    $queryString = http_build_query($data);

    // Redirect to paypal IPN
    header('location:' . $paypalUrl . '?' . $queryString);
    exit();

} else {
    // Handle the PayPal response.
}
// Copy
// To construct the query string we assign the post data to an array that we then push some additional values to that we don't want to be altered by the post data.
// This way we can ensure that a user cannot manipulate the amount being paid or any other details that may be vulnerable.
// We then use http_build_query to convert the array to a query string and pass this to PayPal via the header.
//
// STEP 4 - THE RESPONSE
//
// We now want to handle the response from PayPal, this is the callback PayPal makes to our notify URL we configured earlier.
// We reassign the post response to a local variable and then verify the transaction is authentic and check we've not already processed this transaction before adding the payment to our database.
//
// To do all this we want to add the following code to the else statement of our payments.php script.

// Handle the PayPal response.

// Create a connection to the database.
$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

// Assign posted variables to local data array.
$data = [
    'item_name' => $_POST['item_name'],
    'item_number' => $_POST['item_number'],
    'payment_status' => $_POST['payment_status'],
    'payment_amount' => $_POST['mc_gross'],
    'payment_currency' => $_POST['mc_currency'],
    'txn_id' => $_POST['txn_id'],
    'receiver_email' => $_POST['receiver_email'],
    'payer_email' => $_POST['payer_email'],
    'custom' => $_POST['custom'],
];

// We need to verify the transaction comes from PayPal and check we've not
// already processed the transaction before adding the payment to our
// database.
if (verifyTransaction($_POST) && checkTxnid($data['txn_id'])) {
    if (addPayment($data) !== false) {
        // Payment successfully added.
    }
}

// Copy
// To verify the authenticity of the response we call the function verifyTransaction.
// This will take the post data received from PayPal and validate this by making a curl request to PayPal with the transaction data received.
// If we get back the response VERIFIED then we know that everything is OK and can proceed to add the payment to our database.
//
// The verifyTransaction function looks like this (it can be found in our functions.php file).

function verifyTransaction($data) {
    global $paypalUrl;

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    $ch = curl_init($paypalUrl);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    $res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }

    curl_close($ch);

    return $res === 'VERIFIED';
}

// Copy
// Once the transaction has been verified and before we add it to our database it is a good idea to check that we've not already processed it.
// That's what our call to checkTxnid is going to do. This simply checks that the txn_id value from PayPal does not already exist in our database.

function checkTxnid($txnid) {
    global $db;

    $txnid = $db->real_escape_string($txnid);
    $results = $db->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

    return ! $results->num_rows;
}

// Copy
// This is also a good opportunity for you to add any additional checks you might want to put in place before accepting the payment on your site.
// For example, you might want to check the amount paid tallies with the amount you were charging.
//
// STEP 5 - ADD THE PAYMENT
//
// With the response from PayPal verified and any additional checks we want to make at our end complete it's time to add the payment to our database.
//
// To store payment details in our database a payments table must be created. The following MySQL will create the payments table used in this example code.
//
// CREATE TABLE IF NOT EXISTS `payments` (
//     `id` int(6) NOT NULL AUTO_INCREMENT,
//     `txnid` varchar(20) NOT NULL,
//     `payment_amount` decimal(7,2) NOT NULL,
//     `payment_status` varchar(25) NOT NULL,
//     `itemid` varchar(25) NOT NULL,
//     `createdtime` datetime NOT NULL,
//     PRIMARY KEY (`id`)
//     ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
// Copy
// Then in our code we're calling addPayment to insert a payment into the database. This function looks like this:-
//

function addPayment($data) {
    global $db;

    if (is_array($data)) {
        $stmt = $db->prepare('INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'sdsss',
            $data['txn_id'],
            $data['payment_amount'],
            $data['payment_status'],
            $data['item_number'],
            date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();

        return $db->insert_id;
    }

    return false;
}
