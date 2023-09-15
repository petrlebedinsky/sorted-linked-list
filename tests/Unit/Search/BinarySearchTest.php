<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Search;

use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Node\StringNode;
use Lebe\SortedLinkedList\Search\BinarySearch;
use PHPUnit\Framework\TestCase;

class BinarySearchTest extends TestCase
{
    public function testContainsInt(): void
    {
        $head = new IntNode(1, new IntNode(2, new IntNode(6)));
        $search = new BinarySearch();

        self::assertTrue($search->contains(1, $head));
        self::assertTrue($search->contains(2, $head));
        self::assertTrue($search->contains(6, $head));
        self::assertFalse($search->contains(50, $head));
        self::assertFalse($search->contains('test', $head));
    }

    public function testContainString(): void
    {
        $head = new StringNode('test1', new StringNode('test3', new StringNode('test30')));
        $search = new BinarySearch();

        self::assertTrue($search->contains('test3', $head));
        self::assertTrue($search->contains('test30', $head));
        self::assertTrue($search->contains('test1', $head));
        self::assertFalse($search->contains('test999', $head));
        self::assertFalse($search->contains(1, $head));
    }

    public function testContainsSingleElement(): void
    {
        $head = new IntNode(1, new IntNode(9));
        $search = new BinarySearch();
        self::assertTrue($search->contains(1, $head));
    }
}
