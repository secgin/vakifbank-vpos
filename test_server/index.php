<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
if (isset($_POST['code']))
{
    $code = $_POST['code'];

    $postData = [
        'MerchantId' => '000100000013506',
        'Pan' => '4508034508034509',
        'Expiry' => '2609',
        'PurchAmount' => '100',
        'PurchCurrency' => '949',
        'VerifyEnrollmentRequestId' => 'transaction1',
        'Xid' => 'ssar4bot2u1npzkio3nc',
        'SessionInfo' => '',
        'Status' => 'Y',
        'Cavv' => 'ABIBBjcAAMy3AAABAAAAAAAAAAA =',
        'Eci' => '02',
        'ExpSign' => '',
        'InstallmentCount' => '',
        'SubMerchantNo' => '',
        'SubMerchantName' => '',
        'SubMerchantNumber' => '',
        'ErrorCode' => '',
        'ErrorMessage' => ''
    ];
    $postData = array_merge($postData, $_POST);

    $postUrl = $_POST['SuccessUrl'];
    if ($code != '1')
    {
        $postData['Status'] = 'N';
        $postData['ErrorCode'] = '2023';
        $postData['ErrorMessage'] = 'Şifre yanlış';
        $postUrl = $_POST['FailUrl'];
    }


    $formFields = '';
    foreach ($postData as $key => $value)
        $formFields .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    ?>
    <form action="<?php echo $postUrl ?>" method="post" id="acsForm" name="acsForm">
        <?php echo $formFields; ?>
        <button type="submit">Gönder</button>
    </form>
    <script>
        document.acsForm.submit();
    </script>
<?php
}
else
{

$formFields = '';
foreach ($_POST as $key => $value)
    $formFields .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';

?>
    <form action="" method="post">
        <h1>Doğrulama kodunuz giriniz</h1>
        <input type="text" name="code"/>
        <?php echo $formFields; ?>
        <button type="submit">Gönder</button>
    </form>
<?php } ?>
</body>
</html>