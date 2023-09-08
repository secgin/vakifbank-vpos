<?php

namespace YG\VakifBankVPos\Sale;

use YG\VakifBankVPos\Abstracts\AbstractRequestHandler;
use YG\VakifBankVPos\Abstracts\Request;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\Sale\SaleRequest;

class SaleRequestHandler extends AbstractRequestHandler
{
    /**
     * @param SaleRequest $request
     */
    public function handle(Request $request): Response
    {
        $xml = <<<OOD
<MerchantId>{$request->getMerchantId()}</MerchantId>
<Password>{$request->getMerchantPassword()}</Password>
<TerminalNo>{$request->getTerminalNo()}</TerminalNo>
<Pan>{$request->getPan()}}</Pan>
<Expiry>20{$request->getExpiry()}</Expiry>
<CurrencyAmount>{$request->getCurrencyAmount()}</CurrencyAmount>
<CurrencyCode>{$request->getCurrencyCode()}</CurrencyCode>
<TransactionType>{$request->getTransactionType()}</TransactionType>
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

        $result = $this->requestService->post($this->config->get('serviceUrl'), http_build_query([
            'prmstr' => $xml
        ]));

        $response = new SaleResponse();

        if ($result->isSuccess())
        {
            $data = $this->xmlToArray($result->getRawResult());
            if ($data === false)
            {
                $response->setError('', 'Banka tarafından geçersiz bir yanıt alındı.');
                return $response;
            }
            $response->assign($data);
            return $response;
        }

        $response->setError($result->getErrorCode(), $result->getErrorMessage());
        return $response;
    }
}