# vuxe
Vuxe is a PHP class designed to detect if a visitor is using a VPN, proxy, or accessing from a country you have blocked.

# Features
- Block VPNs, TORs, Proxies, Abusers, Datacenters
- Blacklist Countries, Regions
- Whitelist - Blacklist IP addresses
- Filter all the bots.

## Why?
When you want your site reachable by real people only.
A rule sets exists you to desire which actors to block.
You can block Custom IPs, Regions and different IP types.

- VPNs, Proxies and Datacenters
- Bogon IPs 
- Crawlers - search engine bots
- Specific country/region

## Setting up the client
See [demo.php](https://github.com/arshx86/vuxe/blob/main/demo.php)

```php

include 'vuxe.php';
$antibot = new Vuxe($_SERVER); // necessary info will be extracted auto

$antibot->block_tor = true;
$antibot->block_vpn = true;
$antibot->block_bogon = true;
$antibot->block_abuse = true;

$antibot->blacklisted_countries = ["finland", "germany", "estonia", "turkey"];
$antibot->blacklisted_regions = ["europe"];
$antibot->blacklisted_ips = ["45.18.251.25", "28.25.111.58"];

// Execute to check if everything is okay
$result = $antibot->check(); // false|string

// FALSE if check passed, STRING with description if check not passed
if ($result != false) {
    die("\n Access blocked. - reason: $result");
}

```

### Examples
- Blocking Turkey IPs
![image](https://github.com/arshx86/AntiBot-php/assets/85416153/9963a19d-955a-4b99-bba1-89c69318799c)

- Blocking VPNs 
![image](https://github.com/arshx86/AntiBot-php/assets/85416153/017190c6-e487-4918-a4c0-d88735837174)

- Blocked bot user agents (you can extend the list)
![image](https://github.com/arshx86/AntiBot-php/assets/85416153/d2ecc566-b568-4bb8-8951-9ef3bad36550)


