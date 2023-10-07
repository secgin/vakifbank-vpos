<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentSummary;

interface SettlementResult
{
    /**
     * @return PaymentSummary[]
     */
    public function getItems(): array;
}