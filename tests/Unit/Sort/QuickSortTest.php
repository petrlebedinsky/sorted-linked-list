<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Sort;

use Exception;
use Lebe\SortedLinkedList\Node\IntNode;
use Lebe\SortedLinkedList\Sort\QuickSort;
use Lebe\SortedLinkedList\Sort\SortDirectionEnum;
use PHPUnit\Framework\TestCase;

class QuickSortTest extends TestCase
{
    public function testSortList(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Not implemented');

        $head = new IntNode(1);
        $sort = new QuickSort();
        $sort->sortList($head, SortDirectionEnum::ASC);
    }
}
