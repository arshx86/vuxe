<?php

include 'antibot.php';
$vuxe = new Vuxe($_SERVER); // supply $_SERVER, we'll auto extract the ip and useragent

/* to pass an custom ip, you can set it later
$vuxe->ip = ''; 
$vuxe->user_agent = '';
*/

$result = $vuxe->check();
if ($result != false) {
    die('Unable to verify as human, error: ' . $result . ' for ip: ' . $vuxe->ip);
}

// verified...

?>

<!DOCTYPE html>
<html lang="en">
<h1>
    Verified as Human
</h1>

</html>
