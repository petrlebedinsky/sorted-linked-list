<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

use Lebe\SortedLinkedList\Node\Node;

class BubbleSort implements LinkedListSortingInterface
{
    use SortAwareTrait;

    public function sortList(Node $head, SortDirectionEnum $sortDirection): Node
    {
        do {
            $swapped = false;
            $current = $head;
            $previous = null;

            while ($current && $current->getNext() !== null) {
                if (
                    ($this->isAscending($sortDirection) && $current->getData() > $current->getNext()->getData()) ||
                    ($this->isDescending($sortDirection) && $current->getData() < $current->getNext()->getData())
                ) {
                    // Swap the nodes
                    $temp = $current->getNext();
                    $current->setNext($temp?->getNext());
                    $temp?->setNext($current);

                    if ($previous) {
                        $previous->setNext($temp);
                    } else {
                        $head = $temp;
                    }

                    $previous = $temp;
                    $swapped = true;
                } else {
                    $previous = $current;
                    $current = $current->getNext();
                }
            }
        } while ($swapped);

        return $head;
    }
}
