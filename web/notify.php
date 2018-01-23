<?php
// Require the Mandrill api
require_once('api/Mandrill.php');

// Need to have a better config file for passwords.
/**
 * send_notice
 * @param  array  $args An array of possiable vlaues that could be passed into the system.
 *                      $type   Message type used in subject line default is NOTICE
 *                      $body   The body contents of the notification message to be sent
 *                      $subject   The subject line for the notification message to be sent
 * @return Boolian      If Sucessful returns true if unsucessful returns false
 * @todo The $to paramater was going to be bassed but was removed, see about maybe adding this back.
 */
function send_notice($args =array()){
    //extract the arguments and set defaults
    extract($args);

    // $to = (isset($to)) ? $to : "default@example.com";
    $type = (isset($type)) ? $type : "Notice";
    $body = (isset($body)) ? $body : "This is a Notice form the [[ENTER_NAME]] notification system.";
    $subject = (isset($subject)) ? $subject : "This message has been triggered.";

    $message = array(
        'text' => $body,
        'subject' => $type . ": " . $subject,
        'from_email' => 'notification@example.com',
        'from_name' => 'Friendly Name For From Email',
        'to' => array(
                    array(
                        'email' => "user-group-1@example.com",
                        'name' => "User Group 1",
                        'type' => "to"
                    ),
                    array(
                        'email' => "user-group-2@example.com",
                        'name' => "User Group 2",
                        'type' => "to"
                    )
                ),
        'headers' =>  array('Reply-To' => 'reply@example.com'),
        'track_opens' => true,
        'track_clicks' => true,
        'auto_html' => true // Remove this once html is configured above.
    );

    // Call the Mandrill Class
    $mandrill = new Mandrill('[[ENTER_YOUR_MANDRILL_KEY]]');
    $result = $mandrill->messages->send($message); // Send the Email

    // Check the results of send if sent, queued or scheduled
    if ($result[0]['status'] == "sent" || $result[0]['status'] == "queued" || $result[0]['status'] == "scheduled") {
        return true;
    } else {
        return false;
    }

}

// Output to screen if viewing the page
echo "<h1>[[ENTER_NAME]] Notification System</h1>";

// If the secret GET key exist then execute
if(isset($_GET['key'])){
    if($_GET['key'] == 'YOUR_SECRET_KEY_CHOICE'){
        echo "Sending Notification...<br/>";
        $values = array();

        // Check the URL String for values and set the array.
        if(isset($_GET['body'])){
            $values['body'] = $_GET['body'];
        }
        if(isset($_GET['type'])){
            // You can add different cases here for the switch to trigger different message cases
            switch($_GET['type']) {
                case "bat-error":
                    $values['subject'] = "An error has occurred while executing a .bat script";
                break;
                default:
                    $values['subject'] = "This is an automated message";
            }
        }

        // Call the function to send email then echo response on screen.
        if(send_notice($values) == true){
            echo "message send sucessful";
        } else {
            echo "<strong>message send failed</strong>";
        }
    }

}
