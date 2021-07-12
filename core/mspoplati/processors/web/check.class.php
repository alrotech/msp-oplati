<?php
/**
 * Copyright (c) Ivan Klimchuk - All Rights Reserved
 * Unauthorized copying, changing, distributing this file, via any medium, is strictly prohibited.
 * Written by Ivan Klimchuk <ivan@klimchuk.com>, 2021
 */

declare(strict_types = 1);

/** @noinspection AutoloadingIssuesInspection */

class mspOplatiCheckPaymentProcessor extends modObjectGetProcessor
{
    public $classKey = msOrder::class;

    public $languageTopics = ['mspoplati:default'];

//    protected $status;

//    public function process()
//    {
//    }

    public function beforeOutput()
    {
//        print_r($this->getProperties());
    }
}

return mspOplatiCheckPaymentProcessor::class;
