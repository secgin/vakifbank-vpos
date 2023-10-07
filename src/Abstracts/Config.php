<?php

namespace YG\VakifBankVPos\Abstracts;

interface Config
{
    public function set(string $key, $value): self;

    public function get(string $key): string;
}