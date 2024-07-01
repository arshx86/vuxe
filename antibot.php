<?php

/**
 * https://github.com/arshx86
 */
class AntiBot
{

    private $ip;
    private $user_agent;

    /**
     * Blacklisted countries with english names (Turkey, Finland, Estonia etc.). Supply 'All' to block all countries and only allow certain countries.
     */
    public array $blacklisted_countries = [];

    /**
     * Blacklisted IP addresses. Range is not supported.
     */
    public array $blacklisted_ips = []; // IP addresses

    /**
     * Blacklisted regions. Example: Europe, America, Asia, Africa, Oceania
     * For example, supply 'Europe' to block all European countries.
     */
    public array $blacklisted_regions = []; // Example: America, Europe, Asia, Africa, Oceania


    /**
     * Sets up the AntiBot class.
     * github.com/arshx86
     */
    public function __construct($ip, $user_agent, array $blacklisted_countries = [], array $blacklisted_ips = [], array $blacklisted_regions = [])
    {

        $this->ip = $ip;
        $this->user_agent = $user_agent;

        $this->blacklisted_countries = $blacklisted_countries;
        $this->blacklisted_ips = $blacklisted_ips;
        $this->blacklisted_regions = $blacklisted_regions;
    }


    /**
     * Analyzes the IP and user agent to determine if the user is a bot.
     * Returns false if the user is a bot, otherwise returns the details of the indicator.
     */
    public function Execute(): false|string
    {

        // Check UA
        if (self::hasBotUa($this->user_agent)) {
            return "Bot User Agent";
        }

        // Check if the IP is blacklisted
        if (in_array($this->ip, $this->blacklisted_ips)) {
            return "Blacklisted IP";
        }

        // Get IP details
        $ipDetails = json_decode(file_get_contents("https://api.ipapi.is/?q=" . $this->ip));

        // Check if the IP is blacklisted
        $country = $ipDetails->location->country;
        if (in_array(strtolower($country), array_map('strtolower', $this->blacklisted_countries))) {
            return "Blacklisted Country";
        }

        // Check if cont is blacklisted
        $region = $ipDetails->location->timezone;
        if (in_array(strtolower($region), array_map('strtolower', $this->blacklisted_regions))) {
            return "Blacklisted Region";
        }

        // Check if the IP is a bot
        $botIndicators = [
            "is_bogon",
            "is_crawler",
            "is_datacenter",
            "is_tor",
            "is_proxy",
            "is_vpn",
            "is_abuser"
        ];

        foreach ($botIndicators as $indicator) {
            if ($ipDetails->$indicator) {
                return "Indicator was found: $indicator";
            }
        }

        return false;

    }

    /**
     * Checks if the user agent is a bot.
     */
    public function hasBotUa(string $ua)
    {

        $botUaList = [
            "google",
            "bing",
            "yandex",
            "ahrefs",
            "semrush",
            "mj12",
            "baiduspider",
            "msn",
            "duckduck",
            "teoma",
            "slurp",
            "sogou",
            "exa",
            "face",
            "ia_archiver",
            "twitter",
            "whatsapp",
            "discord",
            "apple",
            "facebookexternalhit",
            "linkedin",
            "pinterest",
            "slack",
            "telegram",
            "vkshare",
            "whatsapp",
            "outbrain",
            "tumblr",
            "flipboard",
            "pinterest",
            "quora",
            "reddit",
            "skypeuripreview",
            "tumblr",
            "twitter",
            "vkshare",
            "whatsapp",
            "wikipedia",
            "wordpress",
            "xing",
            "yahoo",
            "yandex",
            "yandex",
            "facebookexeternalhit",
            "cleantalk",
        ];

        foreach ($botUaList as $botUa) {
            if (stripos($ua, $botUa) !== false) {
                return true;
            }
        }

    }

}
