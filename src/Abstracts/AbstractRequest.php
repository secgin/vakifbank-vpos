<?php

namespace YG\VakifBankVPos\Abstracts;

abstract class AbstractRequest implements Request
{
    private string $merchantId;

    private string $merchantPassword;

    public function setMerchantIdAndPassword(string $merchantId, string $merchantPassword): void
    {
        $this->merchantId = $merchantId;
        $this->merchantPassword = $merchantPassword;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getMerchantPassword(): string
    {
        return $this->merchantPassword;
    }
}