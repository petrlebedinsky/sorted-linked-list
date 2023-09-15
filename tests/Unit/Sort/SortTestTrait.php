<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Sort;

use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Node\StringNode;
use Lebe\SortedLinkedList\Sort\LinkedListSortingInterface;
use Lebe\SortedLinkedList\Sort\SortDirectionEnum;

trait SortTestTrait
{
    protected LinkedListSortingInterface $sort;

    public function testIntNode(): void
    {
        $head = $this->createIntHead();

        $current = $this->sort->sortList($head, SortDirectionEnum::ASC);

        $counter = 1;
        do {
            self::assertSame($counter, $current->getData());
            $counter++;
            $current = $current->getNext();
        } while ($current !== null);

        $head = $this->createIntHead();
        $current = $this->sort->sortList($head, SortDirectionEnum::DESC);

        $counter = 4;
        do {
            self::assertSame($counter, $current->getData());
            $counter--;
            $current = $current->getNext();
        } while ($current !== null);
    }

    public function testStringNode(): void
    {
        $head = $this->createStringHead();

        $current = $this->sort->sortList($head, SortDirectionEnum::ASC);

        $counter = 1;
        do {
            self::assertSame('test' . $counter, $current->getData());
            $counter++;
            $current = $current->getNext();
        } while ($current !== null);

        $head = $this->createStringHead();
        $current = $this->sort->sortList($head, SortDirectionEnum::DESC);

        $counter = 4;
        do {
            self::assertSame('test' . $counter, $current->getData());
            $counter--;
            $current = $current->getNext();
        } while ($current !== null);
    }

    private function createIntHead(): IntNode
    {
        return new IntNode(2, new IntNode(3, new IntNode(4, new IntNode(1))));
    }

    private function createStringHead(): StringNode
    {
        return new StringNode('test3', new StringNode('test1', new StringNode('test4', new StringNode('test2'))));
    }
}
