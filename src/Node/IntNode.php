<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Node;

class IntNode extends Node
{
    public function __construct(int $data, ?IntNode $next = null)
    {
        parent::__construct($data, $next);
    }

    public function getData(): int
    {
        return $this->data;
    }
}
