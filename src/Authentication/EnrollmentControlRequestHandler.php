<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\AbstractRequestHandler;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlRequest;
use YG\VakifBankVPos\Abstracts\Request;
use YG\VakifBankVPos\Abstracts\Response;

class  EnrollmentControlRequestHandler extends AbstractRequestHandler
{
    /**
     * @param EnrollmentControlRequest $request
     */
    public function handle(Request $request): Response
    {
        $data = [
            'MerchantId' => $request->getMerchantId(),
            'MerchantPassword' => $request->getMerchantPassword(),
            'VerifyEnrollmentRequestId' => $request->getVerifyEnrollmentRequestId(),
            'Pan' => $request->getPan(),
            'ExpiryDate' => $request->getExpiryDate(),
            'PurchaseAmount' => $request->getPurchaseAmount(),
            'Currency' => $request->getCurrency(),
            'BrandName' => $request->getBrandName(),
            'SessionInfo' => $request->getSessionInfo(),
            'SuccessUrl' => $request->getSuccessUrl(),
            'FailureUrl' => $request->getFailureUrl(),
        ];
        if ($request->getInstallmentCount() > 1)
            $data['InstallmentCount'] = $request->getInstallmentCount();

        $response = new EnrollmentControlResponse();
        $result = $this->requestService->post($this->config->get('mpiServiceUrl'), http_build_query($data));
        if ($result->isSuccess())
        {
            $data = $this->xmlToArray($result->getRawResult());
            if ($data === false)
            {
                $response->setError('', 'Banka tarafından geçersiz bir yanıt alındı.');
                return $response;
            }

            $status = $data['Message']['VERes']['Status'] ?? $data['VERes']['Status'];

            $responseData = [];
            $responseData['status'] = $status;

            if ($status == 'Y')
            {
                $responseData['messageId'] = $data['Message']['@attributes']['ID'];
                $responseData['version'] = $data['Message']['VERes']['Version'];
                $responseData['paReq'] = $data['Message']['VERes']['PaReq'];
                $responseData['acsUrl'] = $data['Message']['VERes']['ACSUrl'];
                $responseData['termUrl'] = $data['Message']['VERes']['TermUrl'];
                $responseData['md'] = $data['Message']['VERes']['MD'];
                $responseData['actualBrand'] = $data['Message']['VERes']['ActualBrand'];
                $responseData['verifyEnrollmentRequestId'] = $data['VerifyEnrollmentRequestId'];
            }
            elseif ($status == 'N')
            {
                $responseData['version'] = $data['VERes']['Version'];
                $responseData['actualBrand'] = $data['VERes']['ActualBrand'];
            }
            elseif ($status == 'E')
            {
                $response->setError(
                    $data['MessageErrorCode'] ?? $data['ResultDetail']['ErrorCode'] ?? '',
                    $data['ErrorMessage'] ?? $data['ResultDetail']['ErrorMessage'] ?? '');
            }

            $response->assign($responseData);
            return $response;
        }

        $response->setError($result->getErrorCode(), $result->getErrorMessage());
        return $response;
    }
}