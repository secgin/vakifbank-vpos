<?php

namespace YG\VakifBankVPos\InquiryTransactions\Search;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Search;
use YG\VakifBankVPos\Abstracts\Response;

class SearchHandler extends AbstractHandler
{
    public function handle(Search $request): Response
    {
        $xml = <<<OOD
<SearchRequest>
<MerchantCriteria>
<HostMerchantId>{$this->config->get('merchantId')}</HostMerchantId>
<MerchantPassword>{$this->config->get('password')}</MerchantPassword>
</MerchantCriteria>
<DateCriteria>
<StartDate>{$request->getStartDate()}</StartDate>
<EndDate>{$request->getEndDate()}</EndDate>
</DateCriteria>
<TransactionCriteria>
<TransactionId>{$request->getTransactionId()}</TransactionId>
<OrderId>{$request->getOrderId()}</OrderId>
<AuthCode></AuthCode>
</TransactionCriteria>
</SearchRequest>
OOD;

        $result = $this->httpClient->post($this->config->get('inquiryServiceUrl') . '/Search.aspx', http_build_query(['prmstr' => $xml]));

        return SearchResult::create($result);
    }
}