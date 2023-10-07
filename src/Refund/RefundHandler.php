<?php

namespace YG\VakifBankVPos\Refund;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Response;

class RefundHandler extends AbstractHandler
{
    public function handle(Refund $request): Response
    {
        $xml = <<<EOD
<VposRequest>
<MerchantId>{$this->config->get('merchantId')}</MerchantId>
<Password>{$this->config->get('password')}</Password>
<TransactionType>Refund</TransactionType>
<CurrencyAmount>{$request->getCurrencyAmount()}</CurrencyAmount>
<ReferenceTransactionId>{$request->getReferenceTransactionId()}</ReferenceTransactionId>
<ClientIp>{$request->getClientIp()}</ClientIp>
</VposRequest>
EOD;

        $result = $this->httpClient->post($this->config->get('serviceUrl'), http_build_query(['prmstr' => $xml]));

        return RefundResult::create($result);
    }
}