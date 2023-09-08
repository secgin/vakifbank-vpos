<?php

namespace YG\VakifBankVPos\Abstracts;

abstract class AbstractResponse implements Response
{
    protected bool $success = true;

    protected ?string $errorCode = null;

    protected ?string $errorMessage = null;

    public function setError(string $errorCode, string $errorMessage)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->success = false;
    }

    public function assign(array $data): void
    {
        foreach ($data as $key => $value)
        {
            $key = lcfirst($key);
            if (property_exists($this, $key))
            {
                $this->{$key} = $value ?? '';
            }
        }
    }

    #region ResponseInterface methods
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
    #endregion
}