<?php
declare(strict_types=1);

namespace Snortlin\NanoId\Generator;

interface RandomBytesGeneratorInterface
{
    /**
     * Generates random bytes array.
     */
    public function generate(int $length): array;
}
