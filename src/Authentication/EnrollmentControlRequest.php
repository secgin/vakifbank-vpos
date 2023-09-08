<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractRequest;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlRequest as EnrollmentControlRequestInterface;

class EnrollmentControlRequest extends AbstractRequest implements EnrollmentControlRequestInterface
{
    private string $verifyEnrollmentRequestId;

    private string $pan;

    private string $expiryDate;

    private string $purchaseAmount;

    private string $currency;

    private string $brandName;

    private ?string $sessionInfo = null;

    private ?int $installmentCount = null;

    private string $successUrl;

    private string $failureUrl;

    private function __construct()
    {
    }

    public static function create(string $verifyEnrollmentRequestId, string $pan, string $expiryDate,
                                  string $purchaseAmount, string $currency, string $brandName,
                                  string $successUrl, string $failureUrl): self
    {
        $instance = new self();
        $instance->verifyEnrollmentRequestId = $verifyEnrollmentRequestId;
        $instance->pan = $pan;
        $instance->expiryDate = $expiryDate;
        $instance->purchaseAmount = $purchaseAmount;
        $instance->currency = $currency;
        $instance->brandName = $brandName;
        $instance->successUrl = $successUrl;
        $instance->failureUrl = $failureUrl;
        return $instance;
    }

    public function setSessionInfo(string $sessionInfo): self
    {
        $this->sessionInfo = $sessionInfo;
        return $this;
    }

    public function setInstallmentCount(int $installmentCount): self
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    public function getVerifyEnrollmentRequestId(): string
    {
        return $this->verifyEnrollmentRequestId;
    }

    public function getPan(): string
    {
        return $this->pan;
    }

    public function getExpiryDate(): string
    {
        return $this->expiryDate;
    }

    public function getPurchaseAmount(): string
    {
        return $this->purchaseAmount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getBrandName(): string
    {
        return $this->brandName;
    }

    public function getSessionInfo(): ?string
    {
        return $this->sessionInfo;
    }

    public function getInstallmentCount(): ?int
    {
        return $this->installmentCount;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }
}