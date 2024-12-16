<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern;

use Cheba\PhpUnit\Enums\ClientType;

class Client
{
    private string $name;
    private ClientType $type;

    public function __construct(string $name, ClientType $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ClientType
    {
        return $this->type;
    }
}