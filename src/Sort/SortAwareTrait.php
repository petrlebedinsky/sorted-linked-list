<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

trait SortAwareTrait
{
    public function isAscending(SortDirectionEnum $direction): bool
    {
        return $direction === SortDirectionEnum::ASC;
    }

    public function isDescending(SortDirectionEnum $direction): bool
    {
        return $direction === SortDirectionEnum::DESC;
    }
}
