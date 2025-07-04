<?php
declare(strict_types=1);

namespace Snortlin\NanoId;

interface NanoIdFactoryInterface
{
    /**
     * @throws \InvalidArgumentException
     */
    public function nanoId(int $size, ?string $alphabet = null): string;

    /**
     * @throws \InvalidArgumentException
     */
    public function nanoIdNonSecure(int $size, ?string $alphabet = null): string;
}
