<?php

namespace YG\VakifBankVPos\Abstracts;

interface Config
{
    public function get(string $key): string;
}