<?php 

include("links.php");

$link = explode("!!!", $link);

//username and password of account
$username = trim("djpredator17");
$password = trim("pass123");

//set the directory for the cookie using defined document root var
$dir = "/ctemp";
//build a unique path with every request to store 
//the info per user with custom func. 
$path = NULL;

//login form action url
$url="http://kisscartoon.me/Login"; 
$postinfo = "username=".$username."&password=".$password;

$cookie_file_path = $path."/cookie.txt";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//set the cookie the site has for certain features, this is optional
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
curl_exec($ch);

//page with the content I want to grab
curl_setopt($ch, CURLOPT_URL, "http://kisscartoon.me/Cartoon/Looney-Tunes-Golden-Collection/Volume-6-Disc-4-Special-Wild-Wild-World?id=19166");
//do stuff with the info with DomDocument() etc
$html = curl_exec($ch);
echo $html;
curl_close($ch);

?>