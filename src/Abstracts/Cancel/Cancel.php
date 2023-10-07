<?php

namespace YG\VakifBankVPos\Abstracts\Cancel;

interface Cancel
{
    public function getReferenceTransactionId(): ?string;

    public function getClientIp(): ?string;
}