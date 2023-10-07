<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlResult as EnrollmentControlResultInterface;
use YG\VakifBankVPos\Abstracts\HttpResult;

final class EnrollmentControlResult extends AbstractResponse implements EnrollmentControlResultInterface
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

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($this->isSuccess())
            $this->loadData();
    }

    private function loadData(): void
    {
        $data = $this->result;

        $this->status = $data['Message']['VERes']['Status'] ?? $data['VERes']['Status'];

        if ($this->status == 'Y')
        {
            $this->messageId = $data['Message']['@attributes']['ID'] ?? null;
            $this->version = $data['Message']['VERes']['Version'] ?? null;
            $this->paReq = $data['Message']['VERes']['PaReq'] ?? null;
            $this->acsUrl = $data['Message']['VERes']['ACSUrl'] ?? null;
            $this->termUrl = $data['Message']['VERes']['TermUrl'] ?? null;
            $this->md = $data['Message']['VERes']['MD'] ?? null;
            $this->actualBrand = $data['Message']['VERes']['ACTUALBRAND'] ?? null;
            $this->verifyEnrollmentRequestId = $data['VerifyEnrollmentRequestId'] ?? null;
        }
        elseif ($this->status == 'N')
        {
            $this->version = $data['VERes']['Version'] ?? null;
            $this->actualBrand = $data['VERes']['ACTUALBRAND'] ?? null;
        }
        elseif ($this->status == 'E')
        {
            $this->setError(
                $data['MessageErrorCode'] ?? $data['ResultDetail']['ErrorCode'] ?? '',
                $data['ErrorMessage'] ?? $data['ResultDetail']['ErrorMessage'] ?? '');
        }
    }

    public static function create(HttpResult $result): self
    {
        return new self($result);
    }

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