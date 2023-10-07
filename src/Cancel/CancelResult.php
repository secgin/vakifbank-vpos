<?php

namespace YG\VakifBankVPos\Cancel;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\Cancel\CancelResult as CancelResponseInterface;
use YG\VakifBankVPos\Abstracts\HttpResult;

class CancelResult extends AbstractResponse implements CancelResponseInterface
{
    private ?string $merchantId = null;

    private ?string $transactionType = null;

    private ?string $transactionId = null;

    private ?string $referenceTransactionId = null;

    private ?string $resultCode = null;

    private ?string $resultDetail = null;

    private ?string $authCode = null;

    private ?string $hostDate = null;

    private ?string $rrn = null;

    private ?string $terminalNo = null;

    private ?float $gainedPoint = null;

    private ?float $totalPoint = null;

    private ?float $currencyAmount = null;

    private ?string $currencyCode = null;

    private ?string $treeDSecureType = null;

    private ?string $transactionDeviceSource = null;

    private ?string $batchNo = null;

    private ?float $tlAmount = null;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $result): CancelResponseInterface
    {
        return new self($result);
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
        $this->treeDSecureType = $data['TreeDSecureType'] ?? null;
        $this->transactionDeviceSource = $data['TransactionDeviceSource'] ?? null;
        $this->batchNo = $data['BatchNo'] ?? null;
        $this->tlAmount = $data['TLAmount'] ?? null;

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

    public function getGainedPoint(): ?float
    {
        return $this->gainedPoint;
    }

    public function getTotalPoint(): ?float
    {
        return $this->totalPoint;
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

    public function getTransactionDeviceSource(): ?string
    {
        return $this->transactionDeviceSource;
    }

    public function getBatchNo(): ?string
    {
        return $this->batchNo;
    }

    public function getTlAmount(): ?float
    {
        return $this->tlAmount;
    }

    public function isSuccess(): bool
    {
        return parent::isSuccess() and $this->resultCode == '0000';
    }
}