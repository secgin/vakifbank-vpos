<?php

namespace YG\VakifBankVPos\Revers;

class Revers implements \YG\VakifBankVPos\Abstracts\Revers\Revers
{
    private string $terminalNo;

    private string $referenceTransactionId;

    private string $clientIp;

    private function __construct(string $terminalNo, string $referenceTransactionId, string $clientIp)
    {
        $this->terminalNo = $terminalNo;
        $this->referenceTransactionId = $referenceTransactionId;
        $this->clientIp = $clientIp;
    }

    public static function create(string $terminalNo, string $referenceTransactionId, string $clientIp): Revers
    {
        return new static($terminalNo, $referenceTransactionId, $clientIp);
    }

    public function getTerminalNo(): string
    {
        return $this->terminalNo;
    }

    public function getReferenceTransactionId(): string
    {
        return $this->referenceTransactionId;
    }

    public function getClientIp(): string
    {
        return $this->clientIp;
    }
}