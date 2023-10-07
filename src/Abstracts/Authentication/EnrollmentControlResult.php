<?php

namespace YG\VakifBankVPos\Abstracts\Authentication;

interface EnrollmentControlResult
{
    public function getMessageId(): ?string;

    public function getVersion(): string;

    public function getStatus(): string;

    public function getPaReq(): ?string;

    public function getAcsUrl(): ?string;

    public function getTermUrl(): ?string;

    public function getMd(): ?string;

    public function getActualBrand(): string;

    public function getVerifyEnrollmentRequestId(): ?string;

    public function has3DSecure(): bool;
}