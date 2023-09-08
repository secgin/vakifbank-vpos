<?php

namespace YG\VakifBankVPos\Abstracts;

interface RequestService
{
    public function post(string $serviceUrl, string $data): RequestServiceResult;
}