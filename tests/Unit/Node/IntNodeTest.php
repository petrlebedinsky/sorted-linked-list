<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Node;

use Lebe\SortedLinkedList\Node\IntNode;
use PHPUnit\Framework\TestCase;

class IntNodeTest extends TestCase
{
    public function testWithoutNext(): void
    {
        $node = new IntNode(1);

        self::assertSame(1, $node->getData());
        self::assertNull($node->getNext());
    }

    public function testWithNext(): void
    {
        $node = new IntNode(1, new IntNode(2));

        self::assertSame(1, $node->getData());
        self::assertSame(2, $node->getNext()->getData());
        self::assertNull($node->getNext()->getNext());
    }
}
