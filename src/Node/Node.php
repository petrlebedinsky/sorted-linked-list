<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Node;

class Node
{
    protected mixed $data;

    protected ?Node $next;

    public function __construct(mixed $data, ?Node $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setNext(?self $next = null): self
    {
        $this->next = $next;
        return $this;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }
}
