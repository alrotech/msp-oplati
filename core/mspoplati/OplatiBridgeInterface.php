<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

namespace alroniks\mspoplati;

use alroniks\mspoplati\dto\Payment;
use msOrder;

interface OplatiBridgeInterface
{
    public function requestPayment(msOrder $order): Payment;

    public function requestStatus(msOrder $order): Payment;
}
