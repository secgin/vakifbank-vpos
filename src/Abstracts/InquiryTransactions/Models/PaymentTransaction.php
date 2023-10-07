<?php

namespace YG\VakifBankVPos\Abstracts\InquiryTransactions\Models;

final class PaymentTransaction
{
    public ?string $paymentTransactionId = null;

    public ?string $transactionType = null;

    public ?string $transactionId = null;

    public ?string $referenceTransactionId = null;

    public ?string $orderId = null;

    public float $amount = 0;

    public ?string $amountCode = null;

    public ?float $totalRefundAmount = null;

    public bool $isCanceled = false;

    public bool $isRefunded = false;

    public bool $isReversed = false;

    public ?string $resultCode = null;

    public ?string $resultMessage = null;

    public ?string $cardHolderName = null;

    public ?string $requestInsertTime = null;
}