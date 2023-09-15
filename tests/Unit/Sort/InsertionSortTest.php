<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Tests\Unit\Sort;

use Lebe\SortedLinkedList\Sort\InsertionSort;
use PHPUnit\Framework\TestCase;

class InsertionSortTest extends TestCase
{
    use SortTestTrait;

    public function setUp(): void
    {
        $this->sort = new InsertionSort();
    }
}
