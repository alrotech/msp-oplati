<?php

declare(strict_types = 1);

namespace alroniks\mspoplati\dto\Receipt;

use Spatie\DataTransferObject\DataTransferObject;

class Item extends DataTransferObject
{
    public int $type; // 1 or 2?

    public string $name;

    public string $barcode;

    public int $quantity;

    public $unit;

    public $price;

    public $cost;

    public $taxes;

    public $modifiers;

}
