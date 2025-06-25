<?php
declare(strict_types=1);

namespace Snortlin\NanoId;

use Snortlin\NanoId\Generator\NanoIdGenerator;

interface NanoIdInterface
{
    public const ALPHABET_DEFAULT = NanoIdGenerator::ALPHABET;

    public const ALPHABET_NUMBERS = '0123456789';

    public const ALPHABET_NUMBERS_READABLE = '346789';

    public const ALPHABET_LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';

    public const ALPHABET_LOWERCASE_READABLE = 'abcdefghijkmnpqrtwxyz';

    public const ALPHABET_UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public const ALPHABET_UPPERCASE_READABLE = 'ABCDEFGHIJKMNPQRTWXYZ';

    public const ALPHABET_ALPHA_NUMERIC = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /** Numbers and English alphabet without unreadable letters: 1, l, I, 0, O, o, u, v, 5, S, s, 2, Z */
    public const ALPHABET_ALPHA_NUMERIC_READABLE = '346789abcdefghijkmnpqrtwxyzABCDEFGHJKLMNPQRTUVWXY';

    /** Same as ALPHABET_ALPHA_NUMERIC_READABLE but with removed vowels and following letters: 3, 4, x, X, V. */
    public const ALPHABET_ALPHA_NUMERIC_READABLE_SAFE = '6789bcdfghjkmnpqrtwzBCDFGHJKLMNPQRTW';

    public const ALPHABET_UUID = '0123456789abcdef';

    public const SIZE_DEFAULT = 21;

    /**
     * Generates a tiny, secure, URL-friendly, unique string with custom size and optionally with custom alphabet.
     *
     * If a custom alphabet is specified, it must contain 256 symbols or less. Otherwise, the security of the internal
     * generator algorithm is not guaranteed.
     *
     * @throws \InvalidArgumentException
     */
    public static function nanoId(int $size = NanoIdGenerator::SIZE, ?string $alphabet = null): string;

    /**
     * Generates a tiny, secure, URL-friendly, unique string with custom size and optionally with custom alphabet using the faster non-secure generator.
     *
     * If a custom alphabet is specified, it must contain 256 symbols or less. Otherwise, the security of the internal
     * generator algorithm is not guaranteed.
     *
     * @throws \InvalidArgumentException
     */
    public static function nanoIdNonSecure(int $size = NanoIdGenerator::SIZE, ?string $alphabet = null): string;
}
