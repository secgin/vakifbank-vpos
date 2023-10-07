<?php

namespace YG\VakifBankVPos\Abstracts\Revers;

interface Revers
{
    public function getTerminalNo(): string;

    public function getReferenceTransactionId(): string;

    public function getClientIp(): string;
}