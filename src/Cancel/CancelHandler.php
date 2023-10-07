<?php

namespace YG\VakifBankVPos\Cancel;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\Cancel\Cancel;

class CancelHandler extends AbstractHandler
{
    public function handle(Cancel $request): Response
    {
        $xml = <<<OOD
<VposRequest>
<MerchantId>{$this->config->get('merchantId')}</MerchantId>
<Password>{$this->config->get('password')}</Password>
<TransactionType>Cancel</TransactionType>
<ReferenceTransactionId>{$request->getReferenceTransactionId()}</ReferenceTransactionId>
<ClientIp>{$request->getClientIp()}</ClientIp>
</VposRequest>
OOD;
        $result = $this->httpClient->post($this->config->get('serviceUrl'), http_build_query(['prmstr' => $xml]));

        return CancelResult::create($result);
    }
}