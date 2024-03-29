<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

use alroniks\mspoplati\dto\Payment;

/** @noinspection AutoloadingIssuesInspection */

class mspOplatiCheckPaymentProcessor extends modObjectGetProcessor
{
    public $classKey = msOrder::class;

    public $languageTopics = ['mspoplati:default'];

    private OplatiService $oplatiService;

    public function __construct(modX $modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        /** @var OplatiService $service */
        $service = $this->modx->getService('oplati', OplatiService::class);

        $this->oplatiService = $service;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \League\Uri\Contracts\UriException
     * @throws \JsonException
     */
    public function process()
    {
        $payment = $this->beforeOutput();

        if ($payment->returnUrl && $this->getProperty('return')) {
            $this->modx->sendRedirect($payment->returnUrl);

            return null;
        }

        return $this->cleanup();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \League\Uri\Contracts\UriException
     */
    public function beforeOutput(): Payment
    {
        /** @var msOrder $order */
        $order = $this->object;

        $status = $this->oplatiService->processOrderStatus($order);

        $this->object->set('properties', array_merge($this->object->get('properties'), $status->toArray()));
        $this->object->save(true);

        return $status;
    }
}

return mspOplatiCheckPaymentProcessor::class;
