<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

use Exception;
use Lebe\SortedLinkedList\Node\Node;

class QuickSort implements LinkedListSortingInterface
{
    public function sortList(Node $head, SortDirectionEnum $sortDirection): Node
    {
        throw new Exception('Not implemented');
    }
}
