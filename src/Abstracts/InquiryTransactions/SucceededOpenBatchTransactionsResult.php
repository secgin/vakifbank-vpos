<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentSummary;

interface SucceededOpenBatchTransactionsResult
{
    /**
     * @return PaymentSummary[]
     */
    public function getTransactions(): array;
}