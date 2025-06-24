<?php

namespace Snortlin\NanoId;

class NanoId implements NanoIdInterface
{
    private static ?NanoIdFactoryInterface $factory = null;

    public static function getFactory(): NanoIdFactoryInterface
    {
        if (self::$factory === null) {
            self::$factory = new NanoIdFactory();
        }

        return self::$factory;
    }

    /**
     * @inheritDoc
     */
    public static function nanoId(int $size = NanoIdInterface::SIZE_DEFAULT, ?string $alphabet = null): string
    {
        return self::getFactory()->nanoId($size, $alphabet);
    }

    /**
     * @inheritDoc
     */
    public static function nanoIdNonSecure(int $size = NanoIdInterface::SIZE_DEFAULT, ?string $alphabet = null): string
    {
        return self::getFactory()->nanoIdNonSecure($size, $alphabet);
    }
}
