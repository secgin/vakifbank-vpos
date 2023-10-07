<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PagedInfo;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentTransaction;

interface SearchResult
{
    public function getTransaction(): PaymentTransaction;
}