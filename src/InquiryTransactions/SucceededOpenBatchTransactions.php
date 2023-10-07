<?php

namespace YG\VakifBankVPos\InquiryTransactions;

class SucceededOpenBatchTransactions implements \YG\VakifBankVPos\Abstracts\InquiryTransactions\SucceededOpenBatchTransactions
{
    private string $terminalNo;

    private function __construct(string $terminalNo)
    {
        $this->terminalNo = $terminalNo;
    }

    public static function create(string $terminalNo): self
    {
        return new static($terminalNo);
    }

    public function getTerminalNo(): string
    {
        return $this->terminalNo;
    }
}