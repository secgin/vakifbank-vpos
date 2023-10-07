<?php

namespace YG\VakifBankVPos;

use YG\VakifBankVPos\Abstracts\AbstractHandler;
use YG\VakifBankVPos\Abstracts\Config;
use YG\VakifBankVPos\Abstracts\HttpClient;
use YG\VakifBankVPos\Abstracts\Response;
use YG\VakifBankVPos\Abstracts\VPosClient;
use YG\VakifBankVPos\Authentication\EnrollmentControlHandler;
use YG\VakifBankVPos\Cancel\CancelHandler;
use YG\VakifBankVPos\InquiryTransactions\Search\SearchHandler;
use YG\VakifBankVPos\InquiryTransactions\SettlementDetail\SettlementDetailHandler;
use YG\VakifBankVPos\InquiryTransactions\SucceededOpenBatchTransactionsHandler;
use YG\VakifBankVPos\InquiryTransactions\Suttlement\SettlementHandler;
use YG\VakifBankVPos\Refund\RefundHandler;
use YG\VakifBankVPos\Revers\ReversHandler;
use YG\VakifBankVPos\Sale\SaleHandler;

class VPos implements VPosClient
{
    private Config $config;

    private HttpClient $httpClient;

    private array $requestClasses = [
        'enrollmentControl' => EnrollmentControlHandler::class,
        'sale' => SaleHandler::class,
        'cancel' => CancelHandler::class,
        'refund' => RefundHandler::class,
        'revers' => ReversHandler::class,
        'settlementDetail' => SettlementDetailHandler::class,
        'settlement' => SettlementHandler::class,
        'search' => SearchHandler::class,
        'succeededOpenBatchTransactions' => SucceededOpenBatchTransactionsHandler::class
    ];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new CurlHttpClient();
    }

    public function __call($name, $arguments)
    {
        if ($this->hasRequestClass($name))
            return $this->handle($name, $arguments[0] ?? null);

        throw new \Exception('Method not found');
    }

    #region Handler Methods
    private function getRequestHandler($name)
    {
        $requestHandlerClass = $this->requestClasses[$name];
        $handler = new $requestHandlerClass();

        if ($handler instanceof AbstractHandler)
        {
            $handler->setConfig($this->config);
            $handler->setHttpClient($this->httpClient);
        }
        return $handler;
    }


    private function hasRequestClass(string $name): bool
    {
        return isset($this->requestClasses[$name]);
    }

    private function handle(string $requestName, $request): Response
    {
        return $this->getRequestHandler($requestName)->handle($request);
    }
    #endregion
}