<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Sort;

use Lebe\SortedLinkedList\Sort\BubbleSort;
use PHPUnit\Framework\TestCase;

class BubbleSortTest extends TestCase
{
    use SortTestTrait;

    public function setUp(): void
    {
        $this->sort = new BubbleSort();
    }
}
