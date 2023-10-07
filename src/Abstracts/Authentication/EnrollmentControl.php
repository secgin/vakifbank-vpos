<?php

namespace YG\VakifBankVPos\Abstracts\Authentication;

interface EnrollmentControl
{
    public function getVerifyEnrollmentRequestId(): string;

    public function getPan(): string;

    public function getExpiryDate(): string;

    public function getPurchaseAmount(): string;

    public function getCurrency(): string;

    public function getBrandName(): string;

    public function getSessionInfo(): ?string;

    public function getInstallmentCount(): ?int;
}