<?php
declare(strict_types=1);

namespace Snortlin\NanoId\Generator;

class RandomBytesGenerator implements RandomBytesGeneratorInterface
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function generate(int $length): array
    {
        return unpack('C*', \random_bytes($length));
    }
}
