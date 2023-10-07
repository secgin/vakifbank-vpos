<?php

namespace YG\VakifBankVPos\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SucceededOpenBatchTransactions;

class SucceededOpenBatchTransactionsHandler extends AbstractHandler
{
    public function handle(SucceededOpenBatchTransactions $request): Response
    {
        $xml = <<<OOD
<SucceededOpenBatchTransactionsRequest>
<MerchantCriteria>
<HostMerchantId>{$this->config->get('merchantId')}</HostMerchantId>
<MerchantPassword>{$this->config->get('password')}</MerchantPassword>
</MerchantCriteria>
<HostTerminalId>{$request->getTerminalNo()}</HostTerminalId>
</SucceededOpenBatchTransactionsRequest>
OOD;

        $result = $this->httpClient->post(
            $this->config->get('inquiryServiceUrl') . '/SucceededOpenBatchTransactions.aspx',
            http_build_query(['prmstr' => $xml]));

        return SucceededOpenBatchTransactionsResult::create($result);
    }
}