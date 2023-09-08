<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlResponse as EnrollmentControlResponseInterface;

class EnrollmentControlResponse extends AbstractResponse implements EnrollmentControlResponseInterface
{
    protected ?string $messageId = null;

    protected ?string $version = null;

    protected string $status = '';

    protected ?string $paReq = null;

    protected ?string $acsUrl = null;

    protected ?string $termUrl = null;

    protected ?string $md = null;

    protected ?string $actualBrand = null;

    protected ?string $verifyEnrollmentRequestId;

    # region EnrollmentControlResponseInterface methods
    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPaReq(): ?string
    {
        return $this->paReq;
    }

    public function getAcsUrl(): ?string
    {
        return $this->acsUrl;
    }

    public function getTermUrl(): ?string
    {
        return $this->termUrl;
    }

    public function getMd(): ?string
    {
        return $this->md;
    }

    public function getActualBrand(): string
    {
        return $this->actualBrand;
    }

    public function getVerifyEnrollmentRequestId(): ?string
    {
        return $this->verifyEnrollmentRequestId;
    }

    public function has3DSecure(): bool
    {
        return $this->status == 'Y';
    }
    # endregion
}