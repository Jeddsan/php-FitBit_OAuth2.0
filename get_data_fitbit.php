<?php
//Create a connection to the database
//Declare the variables username and password

$sql_search=mysqli_query($con, "SELECT * FROM fitbit_users fu, user u WHERE fu.fitbit_id=u.fitbit_id AND u.username='$username' AND u.password='$passwordsha512'");
while($row=mysqli_fetch_object($sql_search)){
  $access_token="$row->access_token";
  $userid="$row->fitbit_id";
  $date=date("Y-m-d");
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
var_dump($data);
?>
