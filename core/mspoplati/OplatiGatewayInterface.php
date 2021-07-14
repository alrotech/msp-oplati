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

interface OplatiGatewayInterface
{
    public const OPTION_AREA_CREDENTIALS = 'credentials';
    public const OPTION_CASH_REGISTER_NUMBER = 'cash_register_number';
    public const OPTION_CASH_PASSWORD = 'cash_password';

    public const OPTION_AREA_GATEWAYS = 'gateways';
    public const OPTION_GATEWAY_URL = 'gateway_url';
    public const OPTION_GATEWAY_URL_TEST = 'gateway_url_test';
    public const OPTION_DEVELOPER_MODE = 'developer_mode';

    public const OPTION_AREA_RECEIPT = 'receipt';
    public const OPTION_TITLE_TEXT = 'title_text';
    public const OPTION_HEADER_TEXT = 'receipt_header_text';
    public const OPTION_FOOTER_TEXT = 'receipt_footer_text';
    public const OPTION_PRINT_CASH_REGISTER_NUMBER = 'print_crn';

    public const OPTION_AREA_STATUSES = 'statuses';
    public const OPTION_SUCCESS_STATUS = 'success_status';
    public const OPTION_FAILURE_STATUS = 'failure_status';

    public const OPTION_AREA_PAGES = 'pages';
    public const OPTION_SUCCESS_PAGE = 'success_page';
    public const OPTION_FAILURE_PAGE = 'failure_page';
    public const OPTION_UNPAID_PAGE = 'unpaid_page';

    public function requestPayment(msOrder $order): Payment;

    public function requestStatus(msOrder $order): Payment;
}
