<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

interface Settlement
{
    public function getStartDate(): string;

    public function getEndDate(): string;
}