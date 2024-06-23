<?php

namespace Texture;
class BookTexture
{

    /**
     * @var array|string[] css classes
     */
    private static array $textures = [
        'book-only-red',
        'book-brown',
        'book-blue',
        'book-brown-green',
        'book-turquoise-white',
        'book-green-white',
        'book-red',
    ];

    private static array $sizes = [
        'book-w15-h60',
        'book-w15-h70',
        'book-w15-h80',
        'book-w20-h70',
        'book-w20-h80',
    ];

    public static function getHTMLClass(): string
    {
        return self::getRandomTextureParam(self::$textures) . ' ' . self::getRandomTextureParam(self::$sizes);
    }

    public static function getRandomTextureParam($array): string
    {
        return $array[mt_rand(0, count($array) - 1)];
    }
}