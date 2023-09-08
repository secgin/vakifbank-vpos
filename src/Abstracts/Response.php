<?php

namespace YG\VakifBankVPos\Abstracts;

interface Response
{
    public function isSuccess(): bool;

    public function getErrorCode(): ?string;

    public function getErrorMessage(): ?string;
}