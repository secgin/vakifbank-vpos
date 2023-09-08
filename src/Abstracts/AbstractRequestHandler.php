<?php

namespace YG\VakifBankVPos\Abstracts;

/**
 * @property RequestService $requestService
 * @property Config         $config
 */
abstract class AbstractRequestHandler implements RequestHandler
{
    private DependenceContainer $container;

    public function setContainer(DependenceContainer $container): void
    {
        $this->container = $container;
    }

    /**
     * @return array|bool
     */
    protected function xmlToArray(string $xmlData)
    {
        try
        {
            $xml = @simplexml_load_string($xmlData);
            $json = @json_encode($xml);
            return @json_decode($json, true);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function __get($name)
    {
        if ($this->container->has($name))
            return $this->container->get($name);

        return null;
    }
}