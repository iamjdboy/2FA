<title>Home</title>
<link rel="shortcut icon" href="images/duo.png">

<?php
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];


/**
* RADIUS client example using PAP password.
*/
function redirect(){
  header('location: http://192.168.4.55/login_page/landingpage.html');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/autoload.php';

$radius = new \Dapphp\Radius\Radius();
$timeout = 60;
$radius->setServer('192.168.40.39')        // IP or hostname of RADIUS server
->setSecret('duoradius##')       // RADIUS shared secret
->setNasIpAddress('192.168.4.55')  // IP or hostname of NAS (device authenticating user)
->setAttribute(32, 'Login')       // NAS identifier
->setDebug(0);                   // Enable debug output to screen/console
// Send access request for a user with username = 'username' and password = 'password!'
$response = $radius->accessRequest($username, $password);

if ($response === false) {
// false returned on failure
echo sprintf("Access-Request failed incorrect credentials with error %d (%s).\n",
$radius->getErrorCode(),
$radius->getErrorMessage()
);
} else {
// access request was accepted - client authenticated successfully
$timeout;
$name = $username;
echo '<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background-color: #E1E1E1 ">
  <div style="margin-top: 250px;" class="container">
    <div class="row">
      <div class="col-lg-4">
      </div>

      <div text-align: center; class="col-lg-4">
        Welcome '.$name.'!
      </div>

      <div class="col-lg-4">
      </div>
    </div>
  </div>

</body>
</html>';
//echo"Welcome " . $username . "!";
}
/*
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if ($username == '123' && $password == '123'){
  echo(
    "Username accepted" . $username
  );
}
else {
  echo(
    "Username" . $username
  );
}
*/
?>
