<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions\Models;

final class PagedInfo
{
    public int $pageIndex;

    public int $pageSize;

    public int $totalItemCount;

    private function __construct(int $pageIndex, int $pageSize, int $totalItemCount)
    {
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
        $this->totalItemCount = $totalItemCount;
    }

    public static function create(int $pageIndex, int $pageSize, int $totalItemCount): self
    {
        return new self($pageIndex, $pageSize, $totalItemCount);
    }
}