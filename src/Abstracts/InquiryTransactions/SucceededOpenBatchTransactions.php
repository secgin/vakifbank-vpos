<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

interface SucceededOpenBatchTransactions
{
    public function getTerminalNo(): string;
}