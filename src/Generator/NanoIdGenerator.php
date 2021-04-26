<?php

namespace Snortlin\NanoId\Generator;

class NanoIdGenerator
{
    public const SIZE = 21;
    public const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';

    protected RandomBytesGeneratorInterface $randomBytesGenerator;

    public function __construct(RandomBytesGeneratorInterface $randomBytesGenerator)
    {
        $this->randomBytesGenerator = $randomBytesGenerator;
    }

    /**
     * @see https://github.com/ai/nanoid/blob/master/async/index.browser.js#L43
     * @throws \InvalidArgumentException
     */
    public function nanoId(int $size): string
    {
        $this->checkSize($size);

        $alphabet = self::ALPHABET;

        $id = '';
        $bytes = $this->randomBytesGenerator->generate($size);

        for ($i = 1; $i <= $size; $i++) {
            $id .= $alphabet[$bytes[$i] & 63];
        }

        return $id;
    }

    /**
     * @see https://github.com/ai/nanoid/blob/master/async/index.browser.js#L4
     * @throws \InvalidArgumentException
     */
    public function nanoIdWithCustomAlphabet(int $size, string $alphabet): string
    {
        $this->checkSize($size);
        $this->checkAlphabet($alphabet);

        $id = '';
        $length = strlen($alphabet);
        $mask = (2 << log($length - 1) / M_LN2) - 1;
        $step = (int)ceil(1.6 * $mask * $size / $length);

        while (true) {
            $bytes = $this->randomBytesGenerator->generate($step);

            for ($i = 1; $i <= $step; $i++) {
                $byte = $bytes[$i] & $mask;

                if (isset($alphabet[$byte])) {
                    $id .= $alphabet[$byte];

                    if (strlen($id) === $size) {
                        return $id;
                    }
                }
            }
        }
    }

    /**
     * @see https://github.com/ai/nanoid/blob/main/non-secure/index.js#L19
     * @throws \InvalidArgumentException
     */
    public function nanoIdNonSecure(int $size): string
    {
        return $this->nanoIdNonSecureWithCustomAlphabet($size, self::ALPHABET);
    }

    /**
     * @see https://github.com/ai/nanoid/blob/main/non-secure/index.js#L6
     * @throws \InvalidArgumentException
     */
    public function nanoIdNonSecureWithCustomAlphabet(int $size, string $alphabet): string
    {
        $this->checkSize($size);
        $this->checkAlphabet($alphabet);

        $id = '';
        $length = strlen($alphabet);

        while ($size--) {
            $id .= $alphabet[mt_rand(0, $length - 1) | 0];
        }

        return $id;
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function checkSize(int $size): void
    {
        if ($size <= 0) {
            throw new \InvalidArgumentException('Size must be greater than zero.');
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function checkAlphabet(string $alphabet): void
    {
        $length = strlen($alphabet);

        if ($length <= 0 || $length > 255) {
            throw new \InvalidArgumentException('Alphabet must contain between 1 and 255 symbols.');
        }
    }
}
