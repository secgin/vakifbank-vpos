<?php

namespace YG\VakifBankVPos\InquiryTransactions\Suttlement;

use YG\VakifBankVPos\Abstracts\AbstractInquiryResponse;
use YG\VakifBankVPos\Abstracts\HttpResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Models\PaymentSummary;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementResult as SettlementResultInterface;

class SettlementResult extends AbstractInquiryResponse implements SettlementResultInterface
{
    private array $items;

    protected function __construct(HttpResult $httpResult)
    {
        parent::__construct($httpResult);

        if ($httpResult->isSuccess())
            $this->loadData();
    }

    public static function create(HttpResult $httpResult): SettlementResult
    {
        return new self($httpResult);
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

        $this->items = $transactions;
    }

    public function getItems(): array
    {
        return $this->items ?? [];
    }

    public function isSuccess(): bool
    {
        $responseCode = $this->result['ResponseInfo']['ResponseCode'] ?? '';
        return parent::isSuccess() and $responseCode == '0000';
    }
}