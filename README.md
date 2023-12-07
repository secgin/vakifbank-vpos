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
    ->successUrl('')
    ->serviceUrl('');

$vPos = new VPos($config);

$request = EnrollmentControlRequest::create(
    'transaction id',
    'kart numarası',
    'son kullanma tarihi (yymm)',
    'tutar',
    '949',
    '100');
    
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
$authenticationResult = AuthenticationResult::create($_POST);

if ($authenticationResult->successAuth())
{
    $saleRequest = SaleRequest::create(
        'terminal no',
        $authenticationResult->getPan(),
        $authenticationResult->getExpiry(),
        $authenticationResult->getPurchAmount(),
        $authenticationResult->getPurchCurrency(),
        $authenticationResult->getCavv(),
        $authenticationResult->getEci(),
        $authenticationResult->getVerifyEnrollmentRequestId(),
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
