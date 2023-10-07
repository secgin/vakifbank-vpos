<?php

namespace YG\VakifBankVPos\Cancel;

use YG\VakifBankVPos\Abstracts\Cancel\Cancel as CancelRequestInterface;

class Cancel implements CancelRequestInterface
{
    private ?string $referenceTransactionId = null;

    private ?string $clientIp = null;


    public static function create(string $referenceTransactionId, string $clientIp): Cancel
    {
        $request = new self();
        $request->referenceTransactionId = $referenceTransactionId;
        $request->clientIp = $clientIp;
        return $request;
    }

    public function getReferenceTransactionId(): ?string
    {
        return $this->referenceTransactionId;
    }

    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }
}