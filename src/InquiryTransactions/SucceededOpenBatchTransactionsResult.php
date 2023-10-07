<?php

namespace YG\VakifBankVPos\InquiryTransactions;

use YG\VakifBankVPos\Abstracts\AbstractInquiryResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentSummary;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SucceededOpenBatchTransactionsResult as TransactionsResultInterface;

class SucceededOpenBatchTransactionsResult extends AbstractInquiryResponse implements TransactionsResultInterface
{
    private array $transactions;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $httpResult): SucceededOpenBatchTransactionsResult
    {
        return new SucceededOpenBatchTransactionsResult($httpResult);
    }

    private function loadData(): void
    {
        $transactions = [];

        $transactionTypes = ['Sale', 'Cancel', 'Refund', 'Capture', 'PointSale', 'VTFSale', 'TKFlexSale', 'TKSale'];

        foreach ($transactionTypes as $transactionType)
        {
            $items = $this->result[$transactionType]['Items'] ?? [];
            $totalItem = $items['TotalItem'] ?? [];
            $firstKey = array_key_first($totalItem);
            if ($firstKey === null)
                continue;

            if (is_numeric($firstKey))
            {
                foreach ($totalItem as $item)
                {
                    $transactions[] = PaymentSummary::create(
                        $transactionType,
                        $item['TotalCount'] ?? 0,
                        $item['TotalAmount'] ?? 0,
                        $item['CurrencyCode'] ?? '');
                }
            }
            else
            {
                $transactions[] = PaymentSummary::create(
                    $transactionType,
                    $totalItem['TotalCount'] ?? 0,
                    $totalItem['TotalAmount'] ?? 0,
                    $totalItem['CurrencyCode'] ?? '');
            }
        }

        $this->transactions = $transactions;
    }

    public function getTransactions(): array
    {
        return $this->transactions ?? [];
    }

    public function isSuccess(): bool
    {
        $responseCode = $this->result['ResponseInfo']['ResponseCode'] ?? '';
        return parent::isSuccess() and $responseCode == '0000';
    }
}