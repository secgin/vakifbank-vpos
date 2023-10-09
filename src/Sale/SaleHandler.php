<?php

namespace YG\VakifBankVPos\Sale;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\Sale\Sale;

class SaleHandler extends AbstractHandler
{
    public function handle(Sale $request): Response
    {
        $xml = <<<OOD
<TransactionType>Sale</TransactionType>
<MerchantId>{$this->config->get('merchantId')}</MerchantId>
<Password>{$this->config->get('password')}</Password>
<TerminalNo>{$request->getTerminalNo()}</TerminalNo>
<Pan>{$request->getPan()}</Pan>
<Expiry>20{$request->getExpiry()}</Expiry>
<CurrencyAmount>{$request->getCurrencyAmount()}</CurrencyAmount>
<CurrencyCode>{$request->getCurrencyCode()}</CurrencyCode>
<ECI>{$request->getEci()}</ECI>
<CAVV>{$request->getCavv()}</CAVV>
<MpiTransactionId>{$request->getMpiTransactionId()}</MpiTransactionId>
<ClientIp>{$request->getClientIp()}</ClientIp>
<TransactionDeviceSource>{$request->getTransactionDeviceSource()}</TransactionDeviceSource>
OOD;

        if ($request->getOrderId() != null)
            $xml .= '<OrderId>' . $request->getOrderId() . '</OrderId>';

        if ($request->getOrderDescription() != null)
            $xml .= '<OrderDescription>' . $request->getOrderDescription() . '</OrderDescription>';

        $xml = '<VposRequest>' . $xml . '</VposRequest>';

        $result = $this->httpClient->post($this->config->get('serviceUrl'), http_build_query(['prmstr' => $xml]));

        return SaleResult::create($result);
    }
}