<?php

namespace YG\VakifBankVPos\Refund;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\Refund\RefundResult as RefundResultInterface;

class RefundResult extends AbstractResponse implements RefundResultInterface
{
    private ?string $merchantId;

    private ?string $transactionType;

    private ?string $transactionId;

    private ?string $referenceTransactionId;

    private ?string $resultCode;

    private ?string $resultDetail;

    private ?string $authCode;

    private ?string $hostDate;

    private ?string $rrn;

    private ?string $terminalNo;

    private ?string $gainedPoint;

    private ?string $totalPoint;

    private ?string $currencyAmount;

    private ?string $currencyCode;

    private ?string $transactionDeviceSource;

    private ?string $batchNo;

    private ?string $TLAmount;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $httpResult): RefundResultInterface
    {
        return new static($httpResult);
    }

    private function loadData(): void
    {
        if (!$this->result)
            return;

        $data = $this->result;
        $this->merchantId = $data['MerchantId'] ?? null;
        $this->transactionType = $data['TransactionType'] ?? null;
        $this->transactionId = $data['TransactionId'] ?? null;
        $this->referenceTransactionId = $data['ReferenceTransactionId'] ?? null;
        $this->resultCode = $data['ResultCode'] ?? null;
        $this->resultDetail = $data['ResultDetail'] ?? null;
        $this->authCode = $data['AuthCode'] ?? null;
        $this->hostDate = $data['HostDate'] ?? null;
        $this->rrn = $data['RRN'] ?? null;
        $this->terminalNo = $data['TerminalNo'] ?? null;
        $this->gainedPoint = $data['GainedPoint'] ?? null;
        $this->totalPoint = $data['TotalPoint'] ?? null;
        $this->currencyAmount = $data['CurrencyAmount'] ?? null;
        $this->currencyCode = $data['CurrencyCode'] ?? null;
        $this->transactionDeviceSource = $data['TransactionDeviceSource'] ?? null;
        $this->batchNo = $data['BatchNo'] ?? null;
        $this->TLAmount = $data['TLAmount'] ?? null;

        $this->errorMessage = $this->resultDetail;
        $this->errorCode = $this->resultCode;
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

    public function getReferenceTransactionId(): ?string
    {
        return $this->referenceTransactionId;
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

    public function getTerminalNo(): ?string
    {
        return $this->terminalNo;
    }

    public function getGainedPoint(): ?string
    {
        return $this->gainedPoint;
    }

    public function getTotalPoint(): ?string
    {
        return $this->totalPoint;
    }

    public function getCurrencyAmount(): ?string
    {
        return $this->currencyAmount;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function getTransactionDeviceSource(): ?string
    {
        return $this->transactionDeviceSource;
    }

    public function getBatchNo(): ?string
    {
        return $this->batchNo;
    }

    public function getTLAmount(): ?string
    {
        return $this->TLAmount;
    }

    public function isSuccess(): bool
    {
        return parent::isSuccess() and $this->resultCode == '0000';
    }
}