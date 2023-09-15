<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Search;

use Lebe\SortedLinkedList\Node\Node;

interface LinkedListSearchingInterface
{
    public function contains(mixed $value, Node $head): bool;
}
