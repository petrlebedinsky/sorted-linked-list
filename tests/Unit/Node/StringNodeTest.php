<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Node;

use Lebe\SortedLinkedList\Node\StringNode;
use PHPUnit\Framework\TestCase;

class StringNodeTest extends TestCase
{
    public function testWithoutNext(): void
    {
        $node = new StringNode('test1');

        self::assertSame('test1', $node->getData());
        self::assertNull($node->getNext());
    }

    public function testWithNext(): void
    {
        $node = new StringNode('test1', new StringNode('test2'));

        self::assertSame('test1', $node->getData());
        self::assertSame('test2', $node->getNext()->getData());
        self::assertNull($node->getNext()->getNext());
    }
}
