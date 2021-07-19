<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

namespace alroniks\mspoplati\dto;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Payment extends FlexibleDataTransferObject
{
    public int $paymentId;

    public int $status;

    public ?string $humanStatus;

    public string $orderNumber;

    public ?string $dynamicQR;
}
