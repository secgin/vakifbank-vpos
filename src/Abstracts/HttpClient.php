<?php

namespace YG\VakifBankVPos\Abstracts;

interface HttpClient
{
    public function post(string $serviceUrl, string $data): HttpResult;
}