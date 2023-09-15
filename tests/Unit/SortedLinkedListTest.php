<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit;

use InvalidArgumentException;
use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Node\StringNode;
use Lebe\SortedLinkedList\Search\BinarySearch;
use Lebe\SortedLinkedList\Sort\InsertionSort;
use Lebe\SortedLinkedList\Sort\SortDirectionEnum;
use Lebe\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{
    public function testGetHead(): void
    {
        $sortedList = $this->createList();
        self::assertNull($sortedList->getHead());

        $head = new IntNode(1);
        $sortedList->addNewNode($head);
        self::assertInstanceOf(IntNode::class, $sortedList->getHead());
        self::assertSame(1, $sortedList->getHead()->getData());
        self::assertNull($sortedList->getHead()->getNext());

        $head = new IntNode(1, new IntNode(2));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);
        self::assertInstanceOf(IntNode::class, $sortedList->getHead());
        self::assertSame(1, $sortedList->getHead()->getData());
        self::assertInstanceOf(IntNode::class, $sortedList->getHead()->getNext());
        self::assertSame(2, $sortedList->getHead()->getNext()->getData());
    }

    public function testGetTail(): void
    {
        $sortedList = $this->createList();
        self::assertNull($sortedList->getTail());

        $head = new IntNode(1);
        $sortedList->addNewNode($head);
        self::assertInstanceOf(IntNode::class, $sortedList->getTail());
        self::assertSame(1, $sortedList->getTail()->getData());
        self::assertNull($sortedList->getTail()->getNext());

        $node = new IntNode(3);
        $sortedList->addNewNode($node);
        self::assertInstanceOf(IntNode::class, $sortedList->getTail());
        self::assertSame(3, $sortedList->getTail()->getData());
        self::assertNull($sortedList->getTail()->getNext());

        $node = new IntNode(2);
        $sortedList->addNewNode($node);
        self::assertInstanceOf(IntNode::class, $sortedList->getTail());
        self::assertSame(3, $sortedList->getTail()->getData());
        self::assertNull($sortedList->getTail()->getNext());
    }

    public function testToArray(): void
    {
        $head = new IntNode(1, new IntNode(10, new IntNode(3)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        self::assertSame([1,3,10], $sortedList->toArray());

        $node1 = new IntNode(10);
        $node2 = new IntNode(100);
        $node3 = new IntNode(1000);

        $sortedList = $this->createList();
        $sortedList->addNewNode($node3);
        self::assertSame([1000], $sortedList->toArray());

        $sortedList->addNewNode($node1);
        self::assertSame([10,1000], $sortedList->toArray());

        $sortedList->addNewNode($node2);
        self::assertSame([10,100, 1000], $sortedList->toArray());
    }

    public function testToArrayEmpty(): void
    {
        $sortedList = $this->createList();
        self::assertSame([], $sortedList->toArray());
    }

    public function testAddNewIncompatibleTypes(): void
    {
        $expectedMessage = 'This LinkedList holds only values of type Lebe\SortedLinkedList\Node\IntNode, ';
        $expectedMessage .= 'but Lebe\SortedLinkedList\Node\StringNode was added';
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage);

        $sortedList = $this->createList();
        $sortedList->addNewNode(new IntNode(1));
        $sortedList->addNewNode(new StringNode('test'));
    }

    public function testAddNewIntNode(): void
    {
        $head = new IntNode(56, new IntNode(1111, new IntNode(3)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);
        self::assertSame([3, 56, 1111], $sortedList->toArray());

        $head = new IntNode(56, new IntNode(1111, new IntNode(3)));
        $sortedList = $this->createList();
        $sortedList->setSortDirection(SortDirectionEnum::DESC);
        $sortedList->addNewNode($head);
        self::assertSame([1111, 56, 3], $sortedList->toArray());
    }

    public function testAddNewDuplicate(): void
    {
        $head = new IntNode(1, new IntNode(20));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);
        self::assertSame([1, 20], $sortedList->toArray());

        $sortedList->addNewNode(new IntNode(1));
        self::assertSame([1, 1, 20], $sortedList->toArray());

        $sortedList->addNewNode(new IntNode(20));
        self::assertSame([1, 1, 20, 20], $sortedList->toArray());
    }

    public function testGetMin(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();
        self::assertNull($sortedList->getMin());

        $sortedList->addNewNode($head);
        self::assertSame(1, $sortedList->getMin()->getData());

        $sortedList->reverse();
        self::assertSame(1, $sortedList->getMin()->getData());
    }

    public function testGetMax(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();
        self::assertNull($sortedList->getMax());

        $sortedList->addNewNode($head);
        self::assertSame(3, $sortedList->getMax()->getData());

        $sortedList->reverse();
        self::assertSame(3, $sortedList->getMax()->getData());
    }

    public function testIsEmpty(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();

        self::assertTrue($sortedList->isEmpty());

        $sortedList->addNewNode($head);
        self::assertFalse($sortedList->isEmpty());
    }

    public function testContainsEmpty(): void
    {
        $sortedList = $this->createList();
        self::assertFalse($sortedList->contains(1));

        $sortedList->addNewNode(new StringNode('test1'));
        self::assertTrue($sortedList->contains('test1'));
        self::assertFalse($sortedList->contains(1));
    }

    public function testCountElements(): void
    {
        $sortedList = $this->createList();
        self::assertSame(0, $sortedList->countElements());

        $sortedList->addNewNode(new IntNode(3, new IntNode(9)));
        self::assertSame(2, $sortedList->countElements());
    }

    public function testIterateEmpty(): void
    {
        $sortedList = $this->createList();
        self::assertNull($sortedList->iterate()->current());
    }

    public function testIterate(): void
    {
        $head = new IntNode(1, new IntNode(3, new IntNode(2)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        $counter = 1;
        foreach ($sortedList->iterate() as $node) {
            self::assertSame($counter, $node->getData());
            $counter++;
        }
    }

    public function testMerge(): void
    {
        $head = new IntNode(1, new IntNode(10, new IntNode(4)));
        $sortedList = $this->createList();
        $sortedList->addNewNode($head);

        self::assertSame([1, 4, 10], $sortedList->toArray());

        $head2 = new IntNode(90, new IntNode(100, new IntNode(2)));
        $sortedList2 = $this->createList();
        $sortedList2->addNewNode($head2);

        $sortedList->merge($sortedList2);
        self::assertSame([1, 2, 4, 10, 90, 100], $sortedList->toArray());

        $head3 = new IntNode(999);
        $sortedList3 = $this->createList();
        $sortedList3->addNewNode($head3);

        $sortedList->merge($sortedList3);
        self::assertSame([1, 2, 4, 10, 90, 100, 999], $sortedList->toArray());
    }

    private function createList(): SortedLinkedList
    {
        return new SortedLinkedList(new InsertionSort(), new BinarySearch());
    }
}
