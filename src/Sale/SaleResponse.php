<?php

namespace YG\VakifBankVPos\Sale;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\Sale\SaleResponse as SaleResponseInterface;

class SaleResponse extends AbstractResponse implements SaleResponseInterface
{
    protected ?string $merchantId;

    protected ?string $transactionType;

    protected ?string $transactionId;

    protected ?string $orderId;

    protected ?string $resultCode;

    protected ?string $resultDetail;

    protected ?string $authCode;

    protected ?string $hostDate;

    protected ?string $rrn;

    protected ?float $currencyAmount;

    protected ?string $currencyCode;

    protected ?string $treeDSecureType;

    protected ?float $gainedPoint;

    protected ?float $totalPoint;

    protected ?string $batchNo;

    protected ?float $tlAmount;

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function getTransactionType(): ?string
    {
        return $this->transactionType;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getResultCode(): ?string
    {
        return $this->resultCode;
    }

    public function getResultDetail(): ?string
    {
        return $this->resultDetail;
    }

    public function getAuthCode(): ?string
    {
        return $this->authCode;
    }

    public function getHostDate(): ?string
    {
        return $this->hostDate;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getCurrencyAmount(): ?float
    {
        return $this->currencyAmount;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function getTreeDSecureType(): ?string
    {
        return $this->treeDSecureType;
    }

    public function getGainedPoint(): ?float
    {
        return $this->gainedPoint;
    }

    public function getTotalPoint(): ?float
    {
        return $this->totalPoint;
    }

    public function getBatchNo(): ?string
    {
        return $this->batchNo;
    }

    public function getTlAmount(): ?float
    {
        return $this->tlAmount;
    }

    public function isSuccessPayment(): bool
    {
        return $this->resultCode === '0000';
    }
}