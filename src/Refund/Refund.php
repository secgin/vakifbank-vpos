<?php

namespace YG\VakifBankVPos\Refund;

use YG\VakifBankVPos\Abstracts\Refund\Refund as RefundRequestInterface;

class Refund implements RefundRequestInterface
{
    private ?string $currencyAmount = null;

    private ?string $referenceTransactionId = null;

    private ?string $clientIp = null;

    public static function create(string $currencyAmount, string $referenceTransactionId, string $clientIp): RefundRequestInterface
    {
        $refundRequest = new self();
        $refundRequest->currencyAmount = $currencyAmount;
        $refundRequest->referenceTransactionId = $referenceTransactionId;
        $refundRequest->clientIp = $clientIp;
        return $refundRequest;
    }

    public function getCurrencyAmount(): ?string
    {
        return $this->currencyAmount;
    }

    public function getReferenceTransactionId(): ?string
    {
        return $this->referenceTransactionId;
    }

    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }
}