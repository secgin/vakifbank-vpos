<?php

namespace YG\VakifBankVPos;

use Exception;
use YG\VakifBankVPos\Abstracts\Request;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\VPosInterface;

class VPos implements VPosInterface
{
    private Abstracts\DependenceContainer $container;

    private Abstracts\Config $config;

    public function __construct(Abstracts\Config $config)
    {
        $this->config = $config;
        $this->container = new DependenceContainer();
        $this->container->set('config', $config);

        if ($config->get('useMockRequestService'))
            $this->container->set('requestService', MockCurlRequestService::class);
    }

    /**
     * @throws Exception
     */
    private function handle(string $name, Request $request): Response
    {
        $request->setMerchantIdAndPassword(
            $this->config->get('merchantId'),
            $this->config->get('password'));

        $handler = $this->container->get($name);
        if ($handler === null)
            throw new Exception('Handler not found for request: ' . get_class($request));

        return $handler->handle($request);
    }

    /**
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        return $this->container->has($name)
            ? $this->handle($name, $arguments[0])
            : null;
    }
}