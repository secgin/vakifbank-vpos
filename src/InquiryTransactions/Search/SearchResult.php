<?php

namespace YG\VakifBankVPos\InquiryTransactions\Search;

use YG\VakifBankVPos\Abstracts\AbstractInquiryResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentTransaction;

class SearchResult extends AbstractInquiryResponse implements \YG\VakifBankVPos\Abstracts\InquiryTransactions\SearchResult
{
    private PaymentTransaction $transaction;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $httpResult): SearchResult
    {
        return new SearchResult($httpResult);
    }

    private function loadData(): void
    {
        $data = $this->result['TransactionSearchResultInfo']['TransactionSearchResultInfo'] ?? [];

        $paymentTransaction = new PaymentTransaction();
        $paymentTransaction->paymentTransactionId = $data['PaymentTransactionId'] ?? '';
        $paymentTransaction->transactionType = $data['TransactionType'] ?? '';
        $paymentTransaction->transactionId = $data['TransactionId'] ?? '';
        $paymentTransaction->referenceTransactionId = $data['ReferenceTransactionId'] ?? '';
        $paymentTransaction->orderId = $data['OrderId'] ?? '';
        $paymentTransaction->amount = $data['Amount'] ?? 0;
        $paymentTransaction->amountCode = $data['AmountCode'] ?? '';
        $paymentTransaction->totalRefundAmount = $data['TotalRefundAmount'] ?? null;
        $paymentTransaction->isCanceled = ($data['IsCanceled'] ?? 'false') == 'true';
        $paymentTransaction->isRefunded = ($data['IsRefunded'] ?? 'false') == 'true';
        $paymentTransaction->isReversed = ($data['IsReversed'] ?? 'false') == 'true';
        $paymentTransaction->resultCode = $data['ResultCode'] ?? '';
        $paymentTransaction->resultMessage = $data['ResponseMessage'] ?? '';
        $paymentTransaction->requestInsertTime = $data['RequestInsertTime'] ?? '';

        if (isset($data['CustomItems']))
        {
            foreach ($data['CustomItems'] as $customItem)
            {
                if ($customItem['Name'] == 'CardHolderName')
                {
                    $paymentTransaction->cardHolderName = $customItem['Value'];
                    break;
                }
            }
        }

        $this->transaction = $paymentTransaction;
    }

    public function getTransaction(): PaymentTransaction
    {
        return $this->transaction;
    }

    public function isSuccess(): bool
    {
        $responseCode = $this->result['ResponseInfo']['ResponseCode'] ?? '';
        return parent::isSuccess() and $responseCode == '0000';
    }
}