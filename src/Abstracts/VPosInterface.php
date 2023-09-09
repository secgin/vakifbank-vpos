<?php

namespace YG\VakifBankVPos\Abstracts;

use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlRequest;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlResponse;
use YG\VakifBankVPos\Abstracts\Sale\SaleRequest;
use YG\VakifBankVPos\Abstracts\Sale\SaleResponse;

/**
 * @method EnrollmentControlResponse enrollmentControl(EnrollmentControlRequest $request)
 * @method SaleResponse sale(SaleRequest $request)
 */
interface VPosInterface
{
}