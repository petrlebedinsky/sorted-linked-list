<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList;

use Lebe\SortedLinkedList\Node\Node;

interface LinkedListInterface
{
    public function addNewNode(Node $node): void;

    public function contains(mixed $value): bool;

    public function getHead(): ?Node;

    public function getMin(): mixed;

    public function getMax(): mixed;

    public function getTail(): ?Node;

    public function isEmpty(): bool;

    public function iterate();

    public function merge(LinkedListInterface $linkedList): void;

    public function reverse(): void;

    public function remove(mixed $value): void;

    public function toArray(): array;
}
