<?php

namespace YG\VakifBankVPos\Abstracts;

interface Request
{
    public function setMerchantIdAndPassword(string $merchantId, string $merchantPassword): void;

    public function getMerchantId(): string;

    public function getMerchantPassword(): string;
}