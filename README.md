# AntiBot-php
Simple PHP class to filter Bots/VPNs for your site

# Features
- Block certain countries or a whole cont
- Block specific IP addresses
- Block VPNs, Datacenters and whole bots.

## How does it filters bots?
Unless you use high quality VPN, you'll be marked as 'vpn' or 'datancenter' always. 
This tool checks if a IP address has **VPN** or **Datacenter** indicator.
It's not only blocks VPNs and Datacenters, also blocks 
  - Crawlers
  - Abuse IPs
  - Tor network
  - Proxy, VPN, Datacenter

It also checks if user agent is owned by a bot.

## Use Cases
When you want your site reachable by real people only.
This will block all people using VPN, Proxy, even the crawlers. 

## Setup
```php

include 'antibot.php';
$ip = $_SERVER['HTTP_CLIENT_IP'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

echo "Execution for: $ip";

// Prepare client
$antibot = new AntiBot($ip, $user_agent);

// setup the client with additional params if you wish...

$result = $antibot->Execute(); // false|string - string if detected as bot, false if no issues
if ($result != false) {
    die("\n Bot detected - reason: $result");
}

// verified they are human... continue

```

### Additional Paramaters
- Block some countries
```php
$antibot->blacklisted_countries = ['turkey', "finland"];
```

- Block an IP addresses
```php
$antibot->blacklisted_ips = ['10.106.29.11', '56.12.51.120' ...]
```

- Block an region completely
```php
$antibot->blacklisted_regions = ['europe', 'asia', 'ocenia', 'asia', 'africa' ...] // this would only allow USA to access your site
```
