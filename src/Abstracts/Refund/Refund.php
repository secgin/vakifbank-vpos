<?php

namespace YG\VakifBankVPos\Abstracts\Refund;

interface Refund
{
    public function getCurrencyAmount(): ?string;

    public function getReferenceTransactionId(): ?string;

    public function getClientIp(): ?string;
}