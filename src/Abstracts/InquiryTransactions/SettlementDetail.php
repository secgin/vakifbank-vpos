<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

interface SettlementDetail
{
    public function getStartDate(): string;

    public function getEndDate(): string;

    public function getPageIndex(): int;

    public function getPageSize(): int;
}