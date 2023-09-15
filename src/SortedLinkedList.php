<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList;

use Generator;
use InvalidArgumentException;
use Lebe\SortedLinkedList\Node\Node;
use Lebe\SortedLinkedList\Search\LinkedListSearchingInterface;
use Lebe\SortedLinkedList\Sort\LinkedListSortingInterface;
use Lebe\SortedLinkedList\Sort\SortDirectionAwareTrait;
use Lebe\SortedLinkedList\Sort\SortDirectionEnum;

class SortedLinkedList implements LinkedListInterface
{
    use SortDirectionAwareTrait;

    private ?string $type = null;

    private ?Node $head = null;

    private LinkedListSortingInterface $sorting;

    private LinkedListSearchingInterface $searching;

    public function __construct(LinkedListSortingInterface $sorting, LinkedListSearchingInterface $searching)
    {
        $this->sorting = $sorting;
        $this->searching = $searching;
    }

    public function addNewNode(Node $node): void
    {
        $nodeType = get_class($node);
        if ($this->type !== null && $nodeType !== $this->type) {
            throw new InvalidArgumentException(sprintf(
                'This LinkedList holds only values of type %s, but %s was added',
                $this->type,
                $nodeType,
            ));
        }

        $this->type ??= $nodeType;

        if ($this->head === null) {
            $this->head = $node;
        } else {
            /** @var Node $current */
            $current = $this->getTail();
            $current->setNext($node);
        }

        $this->sortList();
    }

    public function reverse(): void
    {
        $this->sortDirection === SortDirectionEnum::ASC ?
            $this->sortDirection = SortDirectionEnum::DESC :
            $this->sortDirection = SortDirectionEnum::ASC;

        $this->sortList();
    }

    public function getHead(): ?Node
    {
        return $this->head;
    }

    public function getTail(): ?Node
    {
        if ($this->head === null) {
            return null;
        }

        $currentNode = $this->head;
        while ($currentNode->getNext() !== null) {
            $currentNode = $currentNode->getNext();
        }

        return $currentNode;
    }

    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    public function getMin(): ?Node
    {
        return $this->sortDirection === SortDirectionEnum::ASC ?
            $this->getHead() :
            $this->getTail();
    }

    public function getMax(): ?Node
    {
        return $this->sortDirection === SortDirectionEnum::ASC ?
            $this->getTail() :
            $this->getHead();
    }

    public function countElements(): int
    {
        if ($this->head === null) {
            return 0;
        }

        $elements = 0;
        $currentNode = $this->head;

        do {
            $elements++;
            $currentNode = $currentNode->getNext();
        } while ($currentNode !== null);

        return $elements;
    }

    public function toArray(): array
    {
        if ($this->head === null) {
            return [];
        }

        $data = [];

        $currentNode = $this->head;

        do {
            $data[] = $currentNode->getData();
            $currentNode = $currentNode->getNext();
        } while ($currentNode !== null);

        return $data;
    }

    public function remove(mixed $value): void
    {
        if ($this->head === null) {
            return;
        }

        $previousNode = null;
        $currentNode = $this->head;

        do {
            if ($previousNode === null && $currentNode->getData() === $value && $currentNode->getNext() === null) {
                // remove single element
                $this->head = null;
            } elseif ($currentNode->getData() === $value && $currentNode->getNext() === null) {
                // remove link from previous
                $previousNode->setNext(null);
            } elseif (
                $previousNode !== null &&
                $currentNode->getData() === $value &&
                $currentNode->getNext() !== null
            ) {
                // link previous to next
                $previousNode->setNext($currentNode->getNext());
            }

            $previousNode = $currentNode;
            $currentNode = $currentNode->getNext();
        } while ($currentNode !== null);
    }

    public function contains(mixed $value): bool
    {
        if ($this->head === null) {
            return false;
        }

        return $this->searching->contains($value, $this->head);
    }

    public function iterate(): Generator
    {
        if ($this->head === null) {
            return [];
        }

        $currentNode = $this->head;

        do {
            yield $currentNode;
            $currentNode = $currentNode->getNext();
        } while ($currentNode !== null);
    }

    public function merge(LinkedListInterface $linkedList): void
    {
        /** @var Node $node */
        foreach ($linkedList->iterate() as $node) {
            $node = clone $node;
            $node->setNext();
            $this->addNewNode($node);
        }
    }

    private function sortList(): void
    {
        if ($this->head === null) {
            return; // @codeCoverageIgnore
        }

        $this->head = $this->sorting->sortList($this->head, $this->sortDirection);
    }
}
