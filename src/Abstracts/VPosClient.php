<?php

namespace YG\VakifBankVPos\Abstracts;

use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControl;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlResult;
use YG\VakifBankVPos\Abstracts\Cancel\Cancel;
use YG\VakifBankVPos\Abstracts\Cancel\CancelResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Search;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SearchResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\Settlement;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetail;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementDetailResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SettlementResult;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SucceededOpenBatchTransactions;
use YG\VakifBankVPos\Abstracts\InquiryTransactions\SucceededOpenBatchTransactionsResult;
use YG\VakifBankVPos\Abstracts\Refund\Refund;
use YG\VakifBankVPos\Abstracts\Refund\RefundResult;
use YG\VakifBankVPos\Abstracts\Revers\Revers;
use YG\VakifBankVPos\Abstracts\Revers\ReversResult;
use YG\VakifBankVPos\Abstracts\Sale\Sale;
use YG\VakifBankVPos\Abstracts\Sale\SaleResult;

/**
 * @method Response|EnrollmentControlResult enrollmentControl(EnrollmentControl $request)
 * @method Response|SaleResult sale(Sale $request)
 * @method Response|CancelResult cancel(Cancel $request)
 * @method Response|RefundResult refund(Refund $request)
 * @method Response|ReversResult revers(Revers $request)
 * @method Response|SettlementDetailResult settlementDetail(SettlementDetail $request)
 * @method Response|SettlementResult settlement(Settlement $request)
 * @method Response|SearchResult search(Search $request)
 * @method Response|SucceededOpenBatchTransactionsResult succeededOpenBatchTransactions(SucceededOpenBatchTransactions $request)
 */
interface VPosClient
{
}