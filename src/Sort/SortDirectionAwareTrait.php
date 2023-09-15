<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

trait SortDirectionAwareTrait
{
    protected SortDirectionEnum $sortDirection = SortDirectionEnum::ASC;

    public function setSortDirection(SortDirectionEnum $sortDirection): void
    {
        $this->sortDirection = $sortDirection;
    }
}
