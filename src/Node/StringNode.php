<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Node;

class StringNode extends Node
{
    public function __construct(string $data, ?StringNode $next = null)
    {
        parent::__construct($data, $next);
    }

    public function getData(): string
    {
        return parent::getData();
    }
}
