<?php
//Values
$client_id="CLIENT_ID"; //Go to https://dev.fitbit.com/apps
$client_secret="CLIENT_SECRET"; //Got to https://dev.fitbit.com/apps
$redirect_uri="REDIRECT URI"; //You must add this url as well at https://dev.fitbit.com/apps
$expires_in=3600*24*30; //in seconds ex. 30 days

if(isset($_GET["code"])){
  $auth_code="$client_id:$client_secret";
  $auth_code=base64_encode($auth_code);
  $redirect_uri=urldecode($redirect_uri);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.fitbit.com/oauth2/token?client_id=$client_id&grant_type=authorization_code&redirect_uri=$redirect_uri&code=".$_GET['code']);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $headers = array();
  $headers[] = "Authorization: Basic $auth_code";
  $headers[] = "Content-Type: application/x-www-form-urlencoded";

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $server_output = curl_exec ($ch);

  curl_close ($ch);

  $auth = json_decode($server_output, true);
  var_dump($auth);
  $userid=$data['user_id'];
  // Now save the user_id in your database. Save the refresh token as well. For every query, now you need the access_token.
}
echo "<a href='https://www.fitbit.com/oauth2/authorize?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&expires_in=$expires_in&scope=activity%20nutrition%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight'>
Login with FitBit
</a>";
?>
