<?php

namespace YG\VakifBankVPos\InquiryTransactions\Suttlement;

class Settlement implements \YG\VakifBankVPos\Abstracts\InquiryTransactions\Settlement
{
    private string $startDate;

    private string $endDate;

    private function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function create(string $startDate, string $endDate): self
    {
        return new self($startDate, $endDate);
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }
}