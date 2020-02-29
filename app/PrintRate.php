<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintRate extends Model
{
    protected $fillable = [
        'size',
        'quality',
        'rate'
    ];

    const LETTER = 1;
    const LONG = 2;
    const A4 = 3;

    const SIZES = [
        self::LETTER => 'Letter',
        self::LONG => 'Long',
        self::A4 => 'A4'
    ];

    const DRAFT = 1;
    const STANDARD = 2;
    const HALF_PAGE_COLOR = 3;
    const FULL_PAGE_COLOR = 4;

    const QUALITIES = [
        self::DRAFT => 'Draft',
        self::STANDARD => 'Standard',
        self::HALF_PAGE_COLOR => 'Half Page Color',
        self::FULL_PAGE_COLOR => 'Full Page Color',
    ];

}
