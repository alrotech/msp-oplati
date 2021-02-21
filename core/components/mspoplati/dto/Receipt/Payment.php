<?php

declare(strict_types = 1);

namespace alroniks\mspoplati\dto;

use Spatie\DataTransferObject\DataTransferObject;

class Payment extends DataTransferObject
{
    // Вид оплаты: 1 - перевод Оплати, 2 - БПК, 3 - наличными, 4 - кредит, 99 - прочие виды
    public int $type;

    // Наименование вида оплаты. Применяется только для type=99 (прочие виды). Например: оплата тарой или в кредит.
    public string $name;


    //Уплаченная сумма sum
}
