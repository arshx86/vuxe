<?php

include 'antibot.php';

// Get required params
$ip = get_ip();
$user_agent = $_SERVER['HTTP_USER_AGENT'];

echo "Execution for: $ip";

// Prepare client
$antibot = new AntiBot($ip, $user_agent);
$antibot->blacklisted_regions = ['turkey', "finland"];
$result = $antibot->Execute();
if ($result != false) {
    die("\n Bot detected: $result");
}


function get_ip()
{
    // Get IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // if , exists, it's probably proxied IP return IP before ,
    if (strpos($ip, ',') !== false) {
        $ip = explode(',', $ip)[0];
    }

    return $ip;

}

?>

<!DOCTYPE html>
<html lang="en">
<h1>
    Verified as Human
</h1>

</html>