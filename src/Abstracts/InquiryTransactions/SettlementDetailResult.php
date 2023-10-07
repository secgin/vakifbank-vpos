<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PagedInfo;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentTransaction;

interface SettlementDetailResult
{
    /**
     * @return PaymentTransaction[]
     */
    public function getTransactions(): array;

    public function getPagedInfo(): PagedInfo;
}