<?php

namespace YG\VakifBankVPos;

class CurlRequestService implements Abstracts\RequestService
{
    public function post(string $serviceUrl, string $data): Abstracts\RequestServiceResult
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $serviceUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type" => "application/x-www-form-urlencoded"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

        //curl_setopt($ch, CURLOPT_TIMEOUT, 59);
        //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        //curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($ch);

        $requestResult = $result === false
            ? RequestServiceResult::fail(curl_errno($ch), curl_error($ch))
            : RequestServiceResult::success($result);

        curl_close($ch);
        return $requestResult;
    }
}