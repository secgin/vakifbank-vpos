<?php

namespace YG\VakifBankVPos\Abstracts;

interface DependenceContainer
{
    public function set(string $key, $objectOrClass): void;

    public function get(string $key);

    public function has(string $key): bool;
}