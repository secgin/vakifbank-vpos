<?php

namespace YG\VakifBankVPos\Abstracts\Cancel;

use YG\VakifBankVPos\Abstracts\Response;

interface CancelResult extends Response
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

    public function getGainedPoint(): ?float;

    public function getTotalPoint(): ?float;

    public function getCurrencyAmount(): ?float;

    public function getCurrencyCode(): ?string;

    public function getTreeDSecureType(): ?string;

    public function getTransactionDeviceSource(): ?string;

    public function getBatchNo(): ?string;

    public function getTlAmount(): ?float;
}