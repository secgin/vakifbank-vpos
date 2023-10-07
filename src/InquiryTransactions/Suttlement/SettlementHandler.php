<?php

namespace YG\VakifBankVPos\InquiryTransactions\Suttlement;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Settlement;
use YG\VakifBankVPos\Abstracts\Response;

class SettlementHandler extends AbstractHandler
{
    public function handle(Settlement $request): Response
    {
        $xml = <<<OOD
<SettlementRequest>
<MerchantCriteria>
<HostMerchantId>{$this->config->get('merchantId')}</HostMerchantId>
<MerchantPassword>{$this->config->get('password')}</MerchantPassword>
</MerchantCriteria>
<DateCriteria>
<StartDate>{$request->getStartDate()}</StartDate>
<EndDate>{$request->getEndDate()}</EndDate>
</DateCriteria>
</SettlementRequest>
OOD;
        $result = $this->httpClient->post(
            $this->config->get('inquiryServiceUrl') . '/Settlement.aspx',
            http_build_query(['prmstr' => $xml]));

        return SettlementResult::create($result);
    }
}