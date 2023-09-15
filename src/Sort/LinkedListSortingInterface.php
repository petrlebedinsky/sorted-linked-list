<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

use Lebe\SortedLinkedList\Node\Node;

interface LinkedListSortingInterface
{
    public function sortList(Node $head, SortDirectionEnum $sortDirection): Node;
}
