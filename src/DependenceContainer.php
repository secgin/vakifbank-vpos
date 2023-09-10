<?php

namespace YG\VakifBankVPos;

use YG\VakifBankVPos\Authentication\EnrollmentControlRequestHandler;
use YG\VakifBankVPos\Sale\SaleRequestHandler;

final class DependenceContainer implements Abstracts\DependenceContainer
{
    /**
     * @var string[]
     */
    private array $items = [];

    /**
     * @var object[]
     */
    private array $objects = [];


    public function __construct()
    {
        $this->set('requestService', CurlRequestService::class);
        $this->set('enrollmentControl', EnrollmentControlRequestHandler::class);
        $this->set('sale', SaleRequestHandler::class);
    }

    public function set(string $key, $objectOrClass): void
    {
        if (is_object($objectOrClass))
            $this->objects[$key] = $objectOrClass;
        else if (is_string($objectOrClass))
            $this->items[$key] = $objectOrClass;
    }

    public function get(string $key)
    {
        $item = $this->items[$key] ?? null;
        if ($item === null)
        {
            if (isset($this->objects[$key]))
                return $this->objects[$key];

            return null;
        }

        if (class_exists($item))
        {
            if (!isset($this->objects[$key]))
            {
                if (!isset($this->items[$key]))
                    return null;

                $object = new $this->items[$key];

                if (method_exists($object, 'setContainer'))
                    $object->setContainer($this);

                $this->objects[$key] = $object;
            }

            return $this->objects[$key];
        }

        return $item;
    }

    public function has(string $key): bool
    {
        return isset($this->items[$key]) or isset($this->objects[$key]);
    }

    public function __get($name)
    {
        if ($this->has($name))
            return $this->get($name);

        return null;
    }
}