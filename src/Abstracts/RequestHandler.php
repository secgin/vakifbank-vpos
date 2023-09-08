<?php

namespace YG\VakifBankVPos\Abstracts;

interface RequestHandler
{
    public function handle(Request $request): Response;
}