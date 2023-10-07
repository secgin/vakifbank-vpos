<?php

namespace YG\VakifBankVPos\InquiryTransactions\SettlementDetail;


class SettlementDetail implements \YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetail
{
    private string $startDate;

    private string $endDate;

    private int $pageIndex;

    private int $pageSize;

    private function __construct(string $startDate, string $endDate, int $pageIndex, int $pageSize)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
    }

    public static function create(string $startDate, string $endDate, int $pageIndex = 1, int $pageSize = 50): self
    {
        return new SettlementDetail($startDate, $endDate, $pageIndex, $pageSize);
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getPageIndex(): int
    {
        return $this->pageIndex;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }
}