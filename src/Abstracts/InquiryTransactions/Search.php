<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions;

interface Search
{
    public function getStartDate(): string;

    public function getEndDate(): string;

    public function getTransactionId(): ?string;

    public function getOrderId(): ?string;
}