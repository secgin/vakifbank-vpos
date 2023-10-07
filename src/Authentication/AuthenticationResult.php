<?php

namespace YG\VakifBankVPos\Authentication;

use YG\VakifBankVPos\Abstracts\Authentication\AuthenticationResult as AuthenticationResultInterface;

final class AuthenticationResult implements AuthenticationResultInterface
{
    private array $data;
    
    private function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public static function create(array $data): AuthenticationResultInterface
    {
        return new AuthenticationResult($data);
    }

    public function getMerchantId(): ?string
    {
        return $this->data['MerchantId'] ?? null;
    }

    public function getPan(): ?string
    {
        return $this->data['Pan'] ?? null;
    }

    public function getVerifyEnrollmentRequestId(): ?string
    {
        return $this->data['VerifyEnrollmentRequestId'] ?? null;
    }

    public function getExpiry(): ?string
    {
        return $this->data['Expiry'] ?? null;
    }

    public function getPurchAmount(): ?string
    {
        return $this->data['PurchAmount'] ?? null;
    }

    public function getPurchCurrency(): ?string
    {
        return $this->data['PurchCurrency'] ?? null;
    }

    public function getXid(): ?string
    {
        return $this->data['Xid'] ?? null;
    }

    public function getSessionInfo(): ?string
    {
        return $this->data['SessionInfo'] ?? null;
    }

    public function getStatus(): ?string
    {
        return $this->data['Status'] ?? null;
    }

    public function getCavv(): ?string
    {
        return $this->data['Cavv'] ?? null;
    }

    public function getEci(): ?string
    {
        return $this->data['Eci'] ?? null;
    }

    public function getInstallmentCount(): ?string
    {
        return $this->data['InstallmentCount'] ?? null;
    }

    public function successAuth(): bool
    {
        return $this->data['Status'] == 'Y';
    }

    public function getErrorMessage(): ?string
    {
        return $this->data['ErrorMessage'] ?? null;
    }

    public function getErrorCode(): ?string
    {
        return $this->data['ErrorCode'] ?? null;
    }
}