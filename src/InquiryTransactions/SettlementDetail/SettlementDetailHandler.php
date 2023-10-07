<?php

namespace YG\VakifBankVPos\InquiryTransactions\SettlementDetail;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetail;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetailResult as SettlementDetailResultInterface;

class SettlementDetailHandler extends AbstractHandler
{
    public function handle(SettlementDetail $request): SettlementDetailResultInterface
    {
        $xml = <<<OOD
<SettlementDetailRequest>
<MerchantCriteria>
<HostMerchantId>{$this->config->get('merchantId')}</HostMerchantId>
<MerchantPassword>{$this->config->get('password')}</MerchantPassword>
</MerchantCriteria>
<DateCriteria>
<StartDate>{$request->getStartDate()}</StartDate>
<EndDate>{$request->getEndDate()}</EndDate>
</DateCriteria>
<PagedRequestInfo>
<PageIndex>{$request->getPageIndex()}</PageIndex>
<PageSize>{$request->getPageSize()}</PageSize>
</PagedRequestInfo>
</SettlementDetailRequest>
OOD;

        $result = $this->httpClient->post(
            $this->config->get('inquiryServiceUrl') . '/SettlementDetail.aspx',
            http_build_query(['prmstr' => $xml]));

        return SettlementDetailResult::create($result);
    }
}