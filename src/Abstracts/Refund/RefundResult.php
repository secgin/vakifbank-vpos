<?php

namespace YG\VakifBankVPos\Abstracts\Refund;

use YG\VakifBankVPos\Abstracts\Response;

interface RefundResult extends Response
{
    public function getMerchantId(): ?string;

    public function getTransactionType(): ?string;

    public function getTransactionId(): ?string;

    public function getReferenceTransactionId(): ?string;

    public function getResultCode(): ?string;

    public function getResultDetail(): ?string;

    public function getAuthCode(): ?string;

    public function getHostDate(): ?string;

    public function getRrn(): ?string;

    public function getTerminalNo(): ?string;

    public function getGainedPoint(): ?string;

    public function getTotalPoint(): ?string;

    public function getCurrencyAmount(): ?string;

    public function getCurrencyCode(): ?string;

    public function getTransactionDeviceSource(): ?string;

    public function getBatchNo(): ?string;

    public function getTLAmount(): ?string;
}