<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\Authentication\AuthenticationResponse as AuthenticationResponseInterface;

class AuthenticationResponse extends AbstractResponse implements AuthenticationResponseInterface
{
    protected ?string $merchantId = null;

    protected ?string $pan = null;

    protected ?string $verifyEnrollmentRequestId = null;

    protected ?string $expiry = null;

    protected ?string $purchAmount = null;

    protected ?string $purchCurrency = null;

    protected ?string $xid = null;

    protected ?string $sessionInfo = null;

    protected ?string $status = null;

    protected ?string $cavv = null;

    protected ?string $eci = null;

    protected ?string $installmentCount = null;

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function getPan(): ?string
    {
        return $this->pan;
    }

    public function getVerifyEnrollmentRequestId(): ?string
    {
        return $this->verifyEnrollmentRequestId;
    }

    public function getExpiry(): ?string
    {
        return $this->expiry;
    }

    public function getPurchAmount(): ?string
    {
        return $this->purchAmount;
    }

    public function getPurchCurrency(): ?string
    {
        return $this->purchCurrency;
    }

    public function getXid(): ?string
    {
        return $this->xid;
    }

    public function getSessionInfo(): ?string
    {
        return $this->sessionInfo;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getCavv(): ?string
    {
        return $this->cavv;
    }

    public function getEci(): ?string
    {
        return $this->eci;
    }

    public function getInstallmentCount(): ?string
    {
        return $this->installmentCount;
    }

    public function successAuth(): bool
    {
        return $this->status === 'Y';
    }
}