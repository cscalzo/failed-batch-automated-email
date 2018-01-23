# Notification Email on Bach File Error

### What does this do?
This script was written to notify user groups if an automated task failed to execute. It was imperative that these user groups know if this process failed to run.

There are two parts to this script the first checks for a response code from the Windows batch file. Then if an error code is returned, it visits a webpage triggering the second part of the code. The second part is a PHP page that sends an email notification message to the user groups as needed.

When I had initially put this together, I was utilizing the Mandrill API form the zip release. I may revisit this and update it so that it pulls the library via Composer instead. With that said I have excluded the inclusion of the API  under web directory. To run this you will need that API library and a license key for Mandrill.
<https://mandrillapp.com/api/docs/index.php.html>

### How this works
The documents contained within the web directory would be uploaded to a web server.

The document located in the bat-scripts directory contains an example of how to check for an error response and call to the webpage to trigger the message notification.

The URLs that you would be referencing in the .bat documents would be the URL of where you uploaded the notify.php script.