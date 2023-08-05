<?php

declare(strict_types=1);

namespace Synchro\Ptrify;

final class Ptrify
{
    /**
     * Convert an IP address to the format required for a DNS PTR record.
     *
     * @param  string  $ip An IPv4 or IPv6 address
     * @return string An address in the format needed for DNS PTR records
     */
    public static function ptrify(string $ip): string
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            //Reverse the order of the decimal sections and append the arpa suffix
            return implode('.', array_reverse(explode('.', $ip))).'.in-addr.arpa';
        }
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            //IPv6 addresses need to be fully expanded and have colons removed before reversing - this does both!
            //Need to cast to string to avoid a type issue, but we know this will work because the IP already passed the filter_var check above
            $hex = bin2hex((string) inet_pton($ip));
            //Reverse the address, split it into nibbles, join with dots, and append the arpa suffix
            return implode('.', str_split(strrev($hex))).'.ip6.arpa';
        }
        throw new \InvalidArgumentException('Invalid IP address');
    }
}
