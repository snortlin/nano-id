# Nano ID

<img src="https://ai.github.io/nanoid/logo.svg" align="right"
alt="Nano ID logo by Anton Lovchikov" width="180" height="94">

A tiny, secure, URL-friendly, unique string ID generator for PHP.

This package is PHP implementation of [ai's](https://github.com/ai) [nanoid](https://github.com/ai/nanoid).
Read its documentation for more information.

* **Fast.** It is faster than UUID.
* **Safe.** It uses cryptographically strong random APIs. Can be used in clusters.
* **Compact.** It uses a larger alphabet than UUID (`A-Za-z0-9_-`). So ID size was reduced from 36 to 21 symbols.
* **Customizable.** Size, alphabet and Random Bytes Generator may be overridden.

## Installation

The preferred method of installation is via [Composer](https://getcomposer.org/):

```bash
composer require snortlin/nano-id
```

## Usage

### Base usage

```php
use Snortlin\NanoId\NanoId;

$nanoId = NanoId::nanoId(); // "unQ87dO06B5B-Ybq2Aum5"

// Custom size, default = 21
$nanoId = NanoId::nanoId(16); // "6PUg-8nn5IQrvKNw"

// Custom size and alphabet
$nanoId = NanoId::nanoId(16, '0123456789abcdef'); // "58b141975c2b72f3"
```


### Custom alphabet

```php
use Snortlin\NanoId\NanoId;

// Default size (21), numbers (0123456789)
$nanoId = NanoId::nanoId(NanoId::SIZE_DEFAULT, NanoId::ALPHABET_NUMBERS); // "782295634533276321176"

// Custom size, numbers and English alphabet without unreadable letters: 1, l, I, 0, O, o, u, v, 5, S, s, 2, Z
$nanoId = NanoId::nanoId(12, NanoId::ALPHABET_ALPHA_NUMERIC_READABLE); // "AcFQM9X3pCi8"

```

### Faster and Non-Secure

By default, Nano ID uses random bytes generation for security and low collision probability.
If you are not so concerned with security and more concerned with performance,
you can use the faster non-secure generator.

```php
use Snortlin\NanoId\NanoId;

$nanoId = NanoId::nanoIdNonSecure();

// Custom size, default = 21
$nanoId = NanoId::nanoIdNonSecure(16);

// Custom size and alphabet
$nanoId = NanoId::nanoIdNonSecure(16, '0123456789abcdef');
```

## Tools

* [ID size calculator](https://github.com/CyberAP/nanoid-dictionary) shows collision probability when adjusting the ID alphabet or size.

## Credits

- Andrey Sitnik [ai](https://github.com/ai) for [Nano ID](https://github.com/ai/nanoid).
- Stanislav Lashmanov [CyberAP](https://github.com/CyberAP) for [Predefined character sets to use with Nano ID](https://github.com/CyberAP/nanoid-dictionary).
