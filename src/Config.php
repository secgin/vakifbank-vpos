<?php

namespace YG\VakifBankVPos;

/**
 * @method Config merchantId(string $merchantId)
 * @method Config username(string $username)
 * @method Config password(string $password)
 * @method Config successUrl(string $successUrl)
 * @method Config failUrl(string $failUrl)
 * @method Config activeTestMode()
 */
class Config implements Abstracts\Config
{
    private array $items = [];

    private array $methods = [
        'merchantId',
        'username',
        'password',
        'successUrl',
        'failUrl'
    ];

    private function __construct(array $config)
    {
        $this->items = $config;
        $this->loadServices();
    }

    public static function create(array $config = []): self
    {
        return new self($config);
    }

    public function set(string $key, $value): Abstracts\Config
    {
        $this->items[$key] = $value;
        return $this;
    }

    public function get(string $key): string
    {
        return $this->items[$key] ?? '';
    }

    public function __call($name, $arguments)
    {
        if ($name == 'activeTestMode')
        {
            $this->set('testMode', true);
            $this->loadTestServices();
            return $this;
        }

        if (in_array($name, $this->methods) === false)
            throw new \Exception('Method not found!');

        if (count($arguments) === 0)
            return $this->get($name);

        return $this->set($name, $arguments[0]);
    }

    private function loadServices(): void
    {
        $mpiServiceUrl = 'https://3dsecure.vakifbank.com.tr:4443/MPIAPI/MPI_Enrollment.aspx';
        $serviceUrl = 'https://onlineodeme.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx';
        $inquiryServiceUrl = 'https://onlineodeme.vakifbank.com.tr:4443/UIService/';

        $this->set('mpiServiceUrl', $mpiServiceUrl);
        $this->set('serviceUrl', $serviceUrl);
        $this->set('inquiryServiceUrl', $inquiryServiceUrl);
    }

    private function loadTestServices(): void
    {
        $mpiServiceUrl = 'https://3dsecuretest.vakifbank.com.tr:4443/MPIAPI/MPI_Enrollment.aspx';
        $serviceUrl = 'https://onlineodemetest.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx';
        $inquiryServiceUrl = 'https://onlineodemetest.vakifbank.com.tr:4443/UIService/';

        $this->set('mpiServiceUrl', $mpiServiceUrl);
        $this->set('serviceUrl', $serviceUrl);
        $this->set('inquiryServiceUrl', $inquiryServiceUrl);
    }
}