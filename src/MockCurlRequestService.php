<?php

namespace YG\VakifBankVPos;

class MockCurlRequestService implements Abstracts\RequestService
{
    public function post(string $serviceUrl, string $data): Abstracts\RequestServiceResult
    {
        if ($serviceUrl === 'https://3dsecure.vakifbank.com.tr:4443/MPIAPI/MPI_Enrollment.aspx')
            return $this->getEnrollmentControlResult($data);

        if ($serviceUrl === 'https://onlineodeme.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx')
            return $this->getSaleResult($data);

        return RequestServiceResult::fail('404', 'Not found');
    }

    private function getEnrollmentControlResult(string $data): RequestServiceResult
    {
        $arrData = [];

        $arr = explode('&', $data);
        foreach ($arr as $item)
        {
            $arrItem = explode('=', $item);
            $arrData[$arrItem[0]] = $arrItem[1];
        }

        $verifyEnrollmentRequestId = $arrData['VerifyEnrollmentRequestId'];

        $successXml = <<<EOD
<?xml version="1.0" encoding="utf-8" ?>
<IPaySecure>
    <Message ID="umh7y4i3602e3e80a9424b1da279624537aa4a4e">
        <VERes>
            <Version>1.0.2</Version>
            <Status>Y</Status>
            <PaReq>eJxVUttuwjAM/ZWq72vSNFCKTBAMtKFtDAGaxGNoPahEUwgpl339kgKDRXnwObZjHzvQPRUb74B6n5eq44cB9T1UaZnlatXxK/P91PK7AuZrjTiYYVppFPCB+71coZdnNqRYx2eeR03KMMIWlQlnfBlmksVJk/FGFEvJJUdfwKQ3xZ2AazFhawUMyA3aV3W6lsoIkOmuPxoLnkQtHgK5QihQjwaC3k+cNBpALjQoWaD4mnzOvNH723DqzYezuTfvjUdAahekZaWMPos4sVVvACq9EWtjtm1CjsdjkCtVHmSQlkVgNBDnBXLvbFI5a29fO+WZQLUx6c80XL6cqoUq+aLYGhn1G9lg1QHiIiCTBgWjYUJjyj3K21HLXiA1D7JwbYjQarEyLwC2rkbv0fPIgF2Bths6i4QnVscNAZ62pUIbYdX92UDuHT+/usmmxg6L0WaTc1bPtiZcdm7HwSLK63QHgLgUcl0buW7dWv9+wy+80btF</PaReq>
            <ACSUrl>http://localhost:8001/acs</ACSUrl>
            <TermUrl>https://3dsecuretest.vakifbank.com.tr/MPIAPI/MPI_PARes.aspx</TermUrl>
            <MD>umh7y4i3602e3e80a9424b1da279624537aa4a4e</MD>
            <ACTUALBRAND>100</ACTUALBRAND>
        </VERes>
    </Message>
    <VerifyEnrollmentRequestId>$verifyEnrollmentRequestId</VerifyEnrollmentRequestId>
    <MessageErrorCode>200</MessageErrorCode>
</IPaySecure>
EOD;

        $failTreeDXml = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<IPaySecure>
    <Message ID="913ba68c1fef4c96bcc551dc99197e1b6d7fb9d5"/>
    <VERes>
        <Version>1.0.2</Version>
        <Status>N</Status>
        <ACTUALBRAND>100</ACTUALBRAND>
    </VERes>
</IPaySecure>
EOD;

        $failXml = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<IPaySecure>
    <Message>
        <VERes>
            <Status>E</Status>
        </VERes>
    </Message>
    <ResultDetail>
        <ErrorCode>2023</ErrorCode>
        <ErrorMessage>Verify Enrollment Request Id Already exist for this merchant</ErrorMessage>
    </ResultDetail>
</IPaySecure>
EOD;

        return RequestServiceResult::success($successXml);
    }

    private function getSaleResult(string $data): RequestServiceResult
    {
        $success = <<<EOD
<?xml version="1.0" encoding="utf-8"?> 
<VposResponse>
<MerchantId>***************</MerchantId> 
<TransactionType>Sale</TransactionType> 
<TransactionId>b2d71cc5-d242-4b01-8479-d56eb8f74d7c</TransactionId> 
<OrderId>z2d71cc5-d242-4b01-8479-d56eb8f74d7c</OrderId> 
<ResultCode>0000</ResultCode>
<ResultDetail>İŞLEM BAŞARILI</ResultDetail> 
<AuthCode>11234</AuthCode> 
<HostDate>175017</HostDate> 
<Rrn>201101240006</Rrn> 
<CurrencyAmount>10.50</CurrencyAmount> 
<CurrencyCode>949</CurrencyCode> 
<ThreeDSecureType>2</ThreeDSecureType> 
<GainedPoint>0</GainedPoint> 
<TotalPoint>100</TotalPoint>
<BatchNo>86</BatchNo>
<TLAmount>10.50</TLAmount> </VposResponse>
EOD;

        $fail = <<<EOD
<?xml version="1.0" encoding="utf-8"?> 
<VposResponse>
<MerchantId>***************</MerchantId> 
<TransactionType>Sale</TransactionType> 
<TransactionId>b2d71cc5-d242-4b01-8479-d56eb8f74d7c</TransactionId> 
<OrderId>z2d71cc5-d242-4b01-8479-d56eb8f74d7c</OrderId> 
<ResultCode>0001</ResultCode>
<ResultDetail>İŞLEM BAŞARILI</ResultDetail> 
<AuthCode>11234</AuthCode> 
<HostDate>175017</HostDate> 
<Rrn>201101240006</Rrn> 
<CurrencyAmount>10.50</CurrencyAmount> 
<CurrencyCode>949</CurrencyCode> 
<ThreeDSecureType>2</ThreeDSecureType> 
<GainedPoint>0</GainedPoint> 
<TotalPoint>100</TotalPoint>
<BatchNo>86</BatchNo>
<TLAmount>10.50</TLAmount> </VposResponse>
EOD;

        return RequestServiceResult::success($success);
    }
}