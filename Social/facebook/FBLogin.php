<?php
session_start();
require 'facebook.php';

$app_id = '464876313604379';
$app_secret = '9b7badda6e1e6e8d728f43a8b6f8939c';
$my_url = 'http://idigitalise.com/apps/FBLogin.php';
$code = $_REQUEST["code"];
//$scope= 'email,user_about_me,user_birthday';
if (empty($code)) {
  $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
  $dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
      . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
      . $_SESSION['state'] . "&scope=user_birthday,user_location,publish_stream,email";
  echo("<script> top.location.href='" . $dialog_url . "'</script>");
}
//print_r($_SESSION);
if ($_SESSION['state']) {
  if(!isset($_SESSION['usergraph']))
  {
	$token_url = "https://graph.facebook.com/oauth/access_token?"
      . "client_id=" . $app_id . "&scope=" . $scope . "&redirect_uri=" . urlencode($my_url)
      . "&client_secret=" . $app_secret . "&code=" . $code;
  }
  else {
  $token_url = "https://graph.facebook.com/oauth/access_token?"
      . "client_id=" . $app_id ."&redirect_uri=" . urlencode($my_url)
      . "&client_secret=" . $app_secret . "&code=" . $code;
  }
  $response = file_get_contents($token_url);
  
  $params = null;
  parse_str($response, $params);
  //$_SESSION['access_token'] = $params['access_token'];
  $graph_url = "https://graph.facebook.com/me?access_token="
      . $params['access_token'];
  $user = json_decode(file_get_contents($graph_url));
 
  echo("<br>Hello " . $user->name);
  echo("<br>Email " . $user->email);
  echo("<br>Gender " . $user->gender);
  echo("<br>Birthday " . $user->birthday);
  die;
  $fb_user_id = $user->id;
  $_SESSION['auth'] = $params['access_token'];
  $_SESSION['usergraph'] = $user;
  //echo("<script> top.location.href='FbHome.php'</script>");

} else {
  echo("The state does not match. You may be a victim of CSRF.");
}
?>
