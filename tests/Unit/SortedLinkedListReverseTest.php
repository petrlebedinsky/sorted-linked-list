<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit;

use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Node\StringNode;
use Lebe\SortedLinkedList\Search\BinarySearch;
use Lebe\SortedLinkedList\Sort\InsertionSort;
use Lebe\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListReverseTest extends TestCase
{
    public function testReverseNoData(): void
    {
        $sortedList = $this->createList();
        $sortedList->reverse();

        self::assertSame([], $sortedList->toArray());

        $sortedList->reverse();

        self::assertSame([], $sortedList->toArray());
    }

    public function testReverseIntNodes(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        self::assertSame([1,2,3], $sortedList->toArray());

        $sortedList->reverse();
        self::assertSame([3,2,1], $sortedList->toArray());
    }

    public function testReverseStringNodes(): void
    {
        $head = new StringNode('test30', new StringNode('test15', new StringNode('test0')));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        self::assertSame(['test0', 'test15', 'test30'], $sortedList->toArray());

        $sortedList->reverse();
        self::assertSame(['test30', 'test15', 'test0'], $sortedList->toArray());
    }

    private function createList(): SortedLinkedList
    {
        return new SortedLinkedList(new InsertionSort(), new BinarySearch());
    }
}
