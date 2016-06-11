<?php
//Create a connection to the database
//Declare the variables username and password

$client_id="CLIENT_ID"; //Go to https://dev.fitbit.com/apps
$client_secret="CLIENT_SECRET"; //Go to https://dev.fitbit.com/apps
$date=date("Y-m-d",strtotime(htmlspecialchars($_GET["timestamp"]))); //Set your date via GET
while(true){
  $sql_search=mysqli_query($con, "SELECT * FROM fitbit_users fu, user u WHERE fu.fitbit_id=u.fitbit_id AND u.username='$username' AND u.password='$passwordsha512'");
  while($row=mysqli_fetch_object($sql_search)){
    $access_token="$row->access_token";
    $refresh_token="$row->refresh_token";
    $userid="$row->fitbit_id";
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.fitbit.com/1/user/$userid/activities/date/$date.json");
  curl_setopt($ch, CURLOPT_POST, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $headers = array();
  $headers[] = "Authorization: Bearer $access_token";
  $headers[] = "Content-Type: application/x-www-form-urlencoded";

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $server_output = curl_exec ($ch);

  curl_close ($ch);

  $data = json_decode($server_output, true);
  if($data["errors"][0]["errorType"]=="expired_token"){
      $auth_code="$client_id:$client_secret";
      $auth_code=base64_encode($auth_code);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"https://api.fitbit.com/oauth2/token?grant_type=refresh_token&refresh_token=$refresh_token");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $headers = array();
      $headers[] = "Authorization: Basic $auth_code";
      $headers[] = "Content-Type: application/x-www-form-urlencoded";

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $server_output = curl_exec ($ch);

      curl_close ($ch);
      $refresh = json_decode($server_output, true);
      $access_token=$refresh["access_token"];
      $refresh_token=$refresh["refresh_token"];
      $sql=mysqli_query($con,"UPDATE fitbit_users SET access_token='$access_token', refresh_token='$refresh_token' WHERE fitbit_id='$userid'");
  }else{
    break;
  }
}
//Get your data via the data Array
?>
