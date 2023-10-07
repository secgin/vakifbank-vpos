<?php

namespace YG\VakifBankVPos\Abstracts\Authentication;

interface AuthenticationResult
{
    public function getMerchantId(): ?string;

    public function getPan(): ?string;

    public function getVerifyEnrollmentRequestId(): ?string;

    public function getExpiry(): ?string;

    public function getPurchAmount(): ?string;

    public function getPurchCurrency(): ?string;

    public function getXid(): ?string;

    public function getSessionInfo(): ?string;

    public function getStatus(): ?string;

    public function getCavv(): ?string;

    public function getEci(): ?string;

    public function getInstallmentCount(): ?string;

    public function getErrorMessage(): ?string;

    public function getErrorCode(): ?string;

    public function successAuth(): bool;
}