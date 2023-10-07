<?php

namespace YG\VakifBankVPos\InquiryTransactions\SettlementDetail;

use YG\VakifBankVPos\Abstracts\AbstractInquiryResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PagedInfo;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentTransaction;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetailResult as SettlementDetailResultInterface;

class SettlementDetailResult extends AbstractInquiryResponse implements SettlementDetailResultInterface
{
    private PagedInfo $pagedInfo;

    private array $transactions;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $httpResult): SettlementDetailResultInterface
    {
        return new self($httpResult);
    }

    private function loadData(): void
    {
        $data = $this->result;

        $transactions = [];
        foreach ($data['TransactionSearchResultInfo']['PaymentTransactionInfo'] ?? [] as $item)
        {
            $paymentTransaction = new PaymentTransaction();
            $paymentTransaction->paymentTransactionId = $item['PaymentTransactionId'] ?? '';
            $paymentTransaction->transactionType = $item['TransactionType']['TransactionTypeName'] ?? '';
            $paymentTransaction->transactionId = $item['TransactionId'] ?? '';
            $paymentTransaction->referenceTransactionId = $item['ReferencedTransactionId'] ?? '';
            $paymentTransaction->orderId = $item['OrderId'] ?? '';
            $paymentTransaction->amount = $item['Amount'] ?? 0;
            $paymentTransaction->amountCode = $item['AmountCode'] ?? '';
            $paymentTransaction->totalRefundAmount = $item['TotalRefundAmount'] ?? null;
            $paymentTransaction->isCanceled = ($item['IsCanceled'] ?? 'false') == 'true';
            $paymentTransaction->isRefunded = ($item['IsRefunded'] ?? 'false') == 'true';
            $paymentTransaction->isReversed = ($item['IsReversed'] ?? 'false') == 'true';
            $paymentTransaction->resultCode = $item['ResultCode'] ?? '';
            $paymentTransaction->resultMessage = '';
            $paymentTransaction->requestInsertTime = $item['RequestInsertTime'] ?? '';

            if (isset($item['CustomItems']))
            {
                foreach ($item['CustomItems'] as $customItem)
                {
                    if ($customItem['Name'] == 'CardHolderName')
                    {
                        $paymentTransaction->cardHolderName = $customItem['Value'];
                        break;
                    }
                }
            }

            $transactions[] = $paymentTransaction;
        }

        $pagedInfo = PagedInfo::create(
            $data['PagedResponseInfo']['PageIndex'] ?? 0,
            $data['PagedResponseInfo']['PageSize'] ?? 0,
            $data['PagedResponseInfo']['TotalItemCount'] ?? 0);

        $this->transactions = $transactions;
        $this->pagedInfo = $pagedInfo;
    }

    /**
     * @inheritDoc
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function getPagedInfo(): PagedInfo
    {
        return $this->pagedInfo;
    }

    public function isSuccess(): bool
    {
        $responseCode = $this->result['ResponseInfo']['ResponseCode'] ?? '';
        return parent::isSuccess() and $responseCode == '0000';
    }
}