<?php

namespace YG\VakifBankVPos\Revers;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\Revers\Revers;

class ReversHandler extends AbstractHandler
{
    public function handle(Revers $request): Response
    {
        $xml = <<<EOD
<VposRequest>
<MerchantId>{$this->config->get('merchantId')}</MerchantId>
<Password>{$this->config->get('password')}</Password>
<TransactionType>Reversal</TransactionType>
<ReferenceTransactionId>{$request->getReferenceTransactionId()}</ReferenceTransactionId>
<TerminalNo>{$request->getTerminalNo()}</TerminalNo>
<ClientIp>{$request->getClientIp()}</ClientIp>
</VposRequest>
EOD;

        $result = $this->httpClient->post($this->config->get('serviceUrl'), http_build_query(['prmstr' => $xml]));

        return ReversResult::create($result);
    }
}