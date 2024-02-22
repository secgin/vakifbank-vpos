<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControl;
use YG\VakifBankVPos\Abstracts\Response;

final class  EnrollmentControlHandler extends AbstractHandler
{
    public function handle(EnrollmentControl $request): Response
    {
        $data = [
            'MerchantId' => $this->config->get('merchantId'),
            'MerchantPassword' => $this->config->get('password'),
            'VerifyEnrollmentRequestId' => $request->getVerifyEnrollmentRequestId(),
            'Pan' => $request->getPan(),
            'ExpiryDate' => $request->getExpiryDate(),
            'PurchaseAmount' => $request->getPurchaseAmount(),
            'Currency' => $request->getCurrency(),
            'BrandName' => $request->getBrandName(),
            'SessionInfo' => $request->getSessionInfo(),
            'SuccessUrl' => $request->getSuccessUrl(),
            'FailureUrl' => $request->getFailureUrl()
        ];
        if ($request->getInstallmentCount() > 1)
            $data['InstallmentCount'] = $request->getInstallmentCount();


        $result = $this->httpClient->post($this->config->get('mpiServiceUrl'), http_build_query($data));

        return EnrollmentControlResult::create($result);
    }
}