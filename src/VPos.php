<?php

namespace YG\VakifBankVPos;

use Exception;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlRequest;
use YG\VakifBankVPos\Abstracts\Authentication\EnrollmentControlResponse;
use YG\VakifBankVPos\Abstracts\Request;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\Sale\SaleRequest;
use YG\VakifBankVPos\Abstracts\Sale\SaleResponse;
use YG\VakifBankVPos\Abstracts\VPosInterface;

/**
 * @method EnrollmentControlResponse enrollmentControl(EnrollmentControlRequest $request)
 * @method SaleResponse sale(SaleRequest $request)
 */
class VPos implements VPosInterface
{
    private Abstracts\DependenceContainer $container;

    private Abstracts\Config $config;

    public function __construct(Abstracts\Config $config)
    {
        $this->config = $config;
        $this->container = new DependenceContainer();
        $this->container->set('config', $config);
    }

    /**
     * @throws Exception
     */
    private function handle(Request $request): Response
    {
        $request->setMerchantIdAndPassword($this->config->get('merchantId'), $this->config->get('password'));

        $handler = $this->container->get(get_class($request));
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
            ? $this->handle($arguments[0])
            : null;
    }
}