<?php

include 'antibot.php';

// Get required params
$ip = $_SERVER['HTTP_CLIENT_IP'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

echo "Execution for: $ip";

// Prepare client
$antibot = new AntiBot($ip, $user_agent);
$result = $antibot->Execute();
if ($result != false) {
    die("\n Bot detected: $result");
}

?>

<!DOCTYPE html>
<html lang="en">
<h1>
    Verified as Human
</h1>

</html>