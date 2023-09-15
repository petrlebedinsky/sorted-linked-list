<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit;

use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Node\StringNode;
use Lebe\SortedLinkedList\Search\BinarySearch;
use Lebe\SortedLinkedList\Sort\InsertionSort;
use Lebe\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListRemoveTest extends TestCase
{
    public function testRemoveEmpty(): void
    {
        $sortedList = $this->createList();
        $sortedList->remove(3);

        self::assertSame([], $sortedList->toArray());
    }

    public function testRemoveSimple(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2, new IntNode(50))));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        $sortedList->remove(3);

        self::assertSame([1, 2, 50], $sortedList->toArray());

        $sortedList->remove(50);
        self::assertSame([1, 2], $sortedList->toArray());
    }

    public function testRemoveDuplicate(): void
    {
        $head = new IntNode(50, new IntNode(3, new IntNode(2, new IntNode(50))));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);
        self::assertSame([2, 3, 50, 50], $sortedList->toArray());

        $sortedList->remove(50);
        self::assertSame([2, 3, 50], $sortedList->toArray());
    }

    public function testRemoveUnexisting(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        $sortedList->remove(50);
        self::assertSame([1,2,3], $sortedList->toArray());

        $sortedList->remove('nevim');
        self::assertSame([1,2,3], $sortedList->toArray());
    }

    public function testRemoveSingleElement(): void
    {
        $sortedList = $this->createList();
        $sortedList->addNewNode(new StringNode('test1'));

        $sortedList->remove('test1');

        self::assertSame([], $sortedList->toArray());
    }

    private function createList(): SortedLinkedList
    {
        return new SortedLinkedList(new InsertionSort(), new BinarySearch());
    }
}
