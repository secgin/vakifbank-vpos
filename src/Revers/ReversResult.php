<?php

namespace YG\VakifBankVPos\Revers;

use YG\VakifBankVPos\Abstracts\AbstractResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;

class ReversResult extends AbstractResponse implements \YG\VakifBankVPos\Abstracts\Revers\ReversResult
{
    public static function create(HttpResult $httpResult): ReversResult
    {
        return new ReversResult($httpResult);
    }

    public function getTransactionId(): string
    {
        return $this->result['TransactionId'] ?? '';
    }

    public function isSuccess(): bool
    {
        $resultCode = $this->result['ResultCode'] ?? '';
        return parent::isSuccess() and $resultCode == '0000';
    }
}