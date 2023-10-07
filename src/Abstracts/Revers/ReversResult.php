<?php

namespace YG\VakifBankVPos\Abstracts\Revers;

interface ReversResult
{
    public function getTransactionId(): string;
}