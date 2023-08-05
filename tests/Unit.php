<?php

declare(strict_types=1);

use Synchro\Ptrify\Ptrify;

it('generates a PTR record from an IPv4 address', function () {
    //Test IPv4 address from https://www.rfc-editor.org/rfc/rfc5737#section-3
    $ptr4 = Ptrify::ptrify('192.0.2.151');

    expect($ptr4)->toBe('151.2.0.192.in-addr.arpa');
});

it('generates a PTR record from an expanded IPv6 address', function () {
    //Test IPv6 addresses from https://datatracker.ietf.org/doc/html/rfc3849#section-2
    //and https://www.rfc-editor.org/rfc/rfc8501#section-1.2
    $ptr6 = Ptrify::ptrify('2001:0db8:0f00:0000:0012:34ff:fe56:789a');

    expect($ptr6)->toBe('a.9.8.7.6.5.e.f.f.f.4.3.2.1.0.0.0.0.0.0.0.0.f.0.8.b.d.0.1.0.0.2.ip6.arpa');
});

it('generates a PTR record from a compact IPv6 address', function () {
    //Test IPv6 addresses from https://datatracker.ietf.org/doc/html/rfc3849#section-2
    //and https://www.rfc-editor.org/rfc/rfc8501#section-1.2
    $ptr6 = Ptrify::ptrify('2001:db8:f00::12:34ff:fe56:789a');

    expect($ptr6)->toBe('a.9.8.7.6.5.e.f.f.f.4.3.2.1.0.0.0.0.0.0.0.0.f.0.8.b.d.0.1.0.0.2.ip6.arpa');
});

it('rejects an invalid IPv4 address', function () {
    $ptr4 = Ptrify::ptrify('192.0.2.351');
})->throws(\InvalidArgumentException::class);

it('rejects an IPv4 subnet', function () {
    $ptr4 = Ptrify::ptrify('192.0.2.0/24');
})->throws(\InvalidArgumentException::class);

it('rejects an invalid IPv6 address', function () {
    $ptr6 = Ptrify::ptrify('2001:DB8::1234:GDEF');
})->throws(\InvalidArgumentException::class);

it('rejects an IPv6 subnet', function () {
    $ptr6 = Ptrify::ptrify('fec0::/10');
})->throws(\InvalidArgumentException::class);
