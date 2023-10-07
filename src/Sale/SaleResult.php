<?php

namespace YG\VakifBankVPos\Sale;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\Sale\SaleResult as SaleResultInterface;

class SaleResult extends AbstractResponse implements SaleResultInterface
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

    public function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($this->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $result): self
    {
        return new self($result);
    }

    private function loadData(): void
    {
        $data = $this->result;

        $this->merchantId = $data['MerchantId'] ?? null;
        $this->transactionType = $data['TransactionType'] ?? null;
        $this->transactionId = $data['TransactionId'] ?? null;
        $this->orderId = $data['OrderId'] ?? null;
        $this->resultCode = $data['ResultCode'] ?? null;
        $this->resultDetail = $data['ResultDetail'] ?? null;
        $this->authCode = $data['AuthCode'] ?? null;
        $this->hostDate = $data['HostDate'] ?? null;
        $this->rrn = $data['RRN'] ?? null;
        $this->currencyAmount = $data['CurrencyAmount'] ?? null;
        $this->currencyCode = $data['CurrencyCode'] ?? null;
        $this->treeDSecureType = $data['TreeDSecureType'] ?? null;
        $this->gainedPoint = $data['GainedPoint'] ?? null;
        $this->totalPoint = $data['TotalPoint'] ?? null;
        $this->batchNo = $data['BatchNo'] ?? null;
        $this->tlAmount = $data['TLAmount'] ?? null;
    }

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