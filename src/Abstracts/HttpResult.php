<?php

namespace YG\VakifBankVPos\Abstracts;

interface HttpResult
{
    public function isSuccess(): bool;

    public function getErrorCode(): ?string;

    public function getErrorMessage(): ?string;

    public function getRawResult(): ?string;
}