<?php

namespace YG\VakifBankVPos\Abstracts\Sale;

interface Sale
{
    public function getTransactionType(): ?string;

    public function getTerminalNo(): ?string;

    public function getPan(): ?string;

    public function getExpiry(): ?string;

    public function getCurrencyAmount(): ?string;

    public function getCurrencyCode(): ?string;

    public function getCavv(): ?string;

    public function getEci(): ?string;

    public function getMpiTransactionId(): ?string;

    public function getClientIp(): ?string;

    public function getTransactionDeviceSource(): ?string;

    public function getOrderId(): ?string;

    public function getOrderDescription(): ?string;
}