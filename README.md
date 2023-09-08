# VakıfBank VPos API Library

Sadece 3D Secure ile ödeme almak için kullanabileceğiniz bir kütüphanedir.

## Kurulum

```bash
composer require secgin/vakifbank-vpos
```

## Kullanım

### 3D Güvenli Ödeme Aktif Kontrolü
```php
$config = Config::create()
    ->merchantId('merchantId')
    ->password('password')
    ->mpiServiceUrl('https://3dsecure.vakifbank.com.tr:4443/MPIAPI/MPI_Enrollment.aspx')
    ->serviceUrl('https://onlineodeme.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx');

$vPos = new VPos($config);

$request = EnrollmentControlRequest::create(
    'transaction id',
    'kart numarası',
    'son kullanma tarihi (yymm)',
    'tutar',
    '949',
    '100',
    'success url',
    'fail url');
$result = $vPos->enrollmentControl($request);

if ($result->isSuccess())
{
    if ($result->has3DSecure())
    {
        // ACS Kontrol Aşaması
    }
    else
    {
        echo 'Kartınınız 3D Güvenli Ödemesi Aktif Değildir.';
    }
}
else
{
    echo 'Enrollment control is failed. -> ' . $result->getErrorMessage() . '(' . $result->getErrorCode() . ')';
}
```

### Satış İşlemi
```php
$authenticationResponse = new AuthenticationResponse();
$authenticationResponse->assign($_POST);

if ($authenticationResponse->successAuth())
{
    $saleRequest = SaleRequest::create(
        'Sale',
        'terminal no',
        $authenticationResponse->getPan(),
        $authenticationResponse->getExpiry(),
        $authenticationResponse->getPurchAmount(),
        $authenticationResponse->getPurchCurrency(),
        $authenticationResponse->getCavv(),
        $authenticationResponse->getEci(),
        $authenticationResponse->getVerifyEnrollmentRequestId(),
        $_SERVER['REMOTE_ADDR'],
        '0');
        
    $result = $vPos->sale($saleRequest);

    if ($result->isSuccess())
    {
        if ($result->isSuccessPayment())
        {
            echo 'Ödeme başarılı.';
        }
        else
        {
            echo 'Ödeme başarısız. ' . $result->getResultCode() . '(' . $result->getResultDetail() . ')';
        }
    }
    else
    {
        echo 'Ödeme başarısız. ' . $result->getErrorMessage() . '(' . $result->getErrorCode() . ')';
    }
}
else
{
    echo '3D Secure işlemi başarısız. ' . $authenticationResponse->getErrorMessage() . '(' . $authenticationResponse->getErrorCode() . ')';
}
```
