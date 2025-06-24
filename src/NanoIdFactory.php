<?php

namespace Snortlin\NanoId;

use Snortlin\NanoId\Generator\NanoIdGenerator;
use Snortlin\NanoId\Generator\RandomBytesGenerator;
use Snortlin\NanoId\Generator\RandomBytesGeneratorInterface;

class NanoIdFactory implements NanoIdFactoryInterface
{
    protected NanoIdGenerator $nanoIdGenerator;

    public function __construct(?RandomBytesGeneratorInterface $randomBytesGenerator = null)
    {
        $this->nanoIdGenerator = new NanoIdGenerator($randomBytesGenerator ?? new RandomBytesGenerator());
    }

    /**
     * @inheritDoc
     */
    public function nanoId(int $size, ?string $alphabet = null): string
    {
        return null === $alphabet
            ? $this->nanoIdGenerator->nanoId($size)
            : $this->nanoIdGenerator->nanoIdWithCustomAlphabet($size, $alphabet);
    }

    /**
     * @inheritDoc
     */
    public function nanoIdNonSecure(int $size, ?string $alphabet = null): string
    {
        return null === $alphabet
            ? $this->nanoIdGenerator->nanoIdNonSecure($size)
            : $this->nanoIdGenerator->nanoIdNonSecureWithCustomAlphabet($size, $alphabet);
    }
}
