# AntiBot-php
Essential PHP class to filter various bad actors for your site.

# Features
- Block VPNs, TORs, Proxies, Abusers, Datacenters
- Blacklist Countries, Regions
- Whitelist - Blacklist IP addresses
- Filter all the bots.

## How?
All crawlers, datacenters, VPNs has a bad IP history.
This tool will check if IP address marked as VPN, Proxy, Datacenter, proxy etc.
Not only blocking VPNs, but also Crawlers, Bogons etc.

## Why?
When you want your site reachable by real people only.
A rule sets exists you to desire which actors to block.

- VPNs, Proxies and Datacenters
- Bogon IPs 
- Crawlers - search engine bots
- Specific country or a specific region

## Setting up the client
```php
include 'antibot.php';

$ip = $_SERVER['HTTP_CLIENT_IP'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

$antibot = new AntiBot($ip, $user_agent);

/*
Additional paramaters (default all true)
*/
$antibot->block_tor = true;
$antibot->block_vpn = true;
$antibot->block_bogon = true;
$antibot->block_abuse = true;

/*
Blocklisting IPs and Countries
*/

// * Example: Blocking countries:
$antibot->blacklisted_countries = ["finland", "germany", "estonia", "turkey"];

// * Example 2: Blocking region (block whole EU)
$antibot->blacklisted_regions = ["europe"];

// * Example 3: Blocking IP addresses
$antibot->blacklisted_ips = ["45.18.251.25", "28.25.111.58"];

/*
Whitelisting
When you want site reachable by specific IP address only!
This will override block rules
*/
$antibot->whitelisted_ips = ["61.58.68.235"]; 

// Now execute the checks
$result = $antibot->Execute(); // false|string

// FALSE if check passed, STRING with description if check not passed
if ($result != false) {
  // Blocked. $result will contain the reason.
    die("\n Bot detected - reason: $result");
}

```

### Examples
- Blocking Turkey IPs
![image](https://github.com/arshx86/AntiBot-php/assets/85416153/9963a19d-955a-4b99-bba1-89c69318799c)

- Blocking VPNs (ExpressVPN, NordVPN, Mullvad are easily detected, there's so less vpns can bypass this)
![image](https://github.com/arshx86/AntiBot-php/assets/85416153/017190c6-e487-4918-a4c0-d88735837174)

- Blocked bot user agents (you can extend the list)
  ![image](https://github.com/arshx86/AntiBot-php/assets/85416153/d2ecc566-b568-4bb8-8951-9ef3bad36550)


