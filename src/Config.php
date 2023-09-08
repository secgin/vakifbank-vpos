<?php

namespace YG\VakifBankVPos;

class Config implements Abstracts\Config
{
    private array $items = [];

    private function __construct(array $config)
    {
        $this->items = $config;
    }

    public static function create(array $config = []): self
    {
        return new self($config);
    }

    public function get(string $key): string
    {
        return $this->items[$key] ?? '';
    }

    public function merchantId(string $merchantId): self
    {
        $this->items['merchantId'] = $merchantId;
        return $this;
    }

    public function password(string $password): self
    {
        $this->items['password'] = $password;
        return $this;
    }

    public function serviceUrl(string $serviceUrl): self
    {
        $this->items['serviceUrl'] = $serviceUrl;
        return $this;
    }

    public function mpiServiceUrl(string $mpiServiceUrl): self
    {
        $this->items['mpiServiceUrl'] = $mpiServiceUrl;
        return $this;
    }
}