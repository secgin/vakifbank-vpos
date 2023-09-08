<?php

namespace YG\VakifBankVPos\Abstracts\Authentication;

use YG\VakifBankVPos\Abstracts\Request;

interface EnrollmentControlRequest extends Request
{
    public function getVerifyEnrollmentRequestId(): string;

    public function getPan(): string;

    public function getExpiryDate(): string;

    public function getPurchaseAmount(): string;

    public function getCurrency(): string;

    public function getBrandName(): string;

    public function getSessionInfo(): ?string;

    public function getInstallmentCount(): ?int;

    public function getSuccessUrl(): string;

    public function getFailureUrl(): string;
}