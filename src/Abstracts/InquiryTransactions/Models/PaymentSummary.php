<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions\Models;

final class PaymentSummary
{
    public string $transactionType;

    public int $totalCount;

    public float $totalAmount;

    public string $currencyCode;

    private function __construct(string $transactionType, int $totalCount, float $totalAmount, string $currencyCode)
    {
        $this->transactionType = $transactionType;
        $this->totalCount = $totalCount;
        $this->totalAmount = $totalAmount;
        $this->currencyCode = $currencyCode;
    }

    public static function create(string $transactionType, int $totalCount, float $totalAmount,
                                  string $currencyCode): PaymentSummary
    {
        return new PaymentSummary($transactionType, $totalCount, $totalAmount, $currencyCode);
    }
}