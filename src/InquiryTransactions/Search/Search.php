<?php

namespace YG\VakifBankVPos\InquiryTransactions\Search;

class Search implements \YG\VakifBankVPos\Abstracts\InquiryTransactions\Search
{
    private string $startDate;

    private string $endDate;

    private ?string $transactionId;

    private ?string $orderId;

    private function __construct(string  $startDate, string $endDate, ?string $transactionId = null,
                                ?string $orderId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->transactionId = $transactionId;
        $this->orderId = $orderId;
    }

    public static function createByTransactionId(string $startDate, string $endDate, string $transactionId): Search
    {
        return new self($startDate, $endDate, $transactionId);
    }

    public static function createByOrderId(string $startDate, string $endDate, string $orderId): Search
    {
        return new self($startDate, $endDate, null, $orderId);
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }
}