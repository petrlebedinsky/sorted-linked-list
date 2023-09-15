<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Sort;

use Lebe\SortedLinkedList\Node\Node;

class InsertionSort implements LinkedListSortingInterface
{
    use SortAwareTrait;

    public function sortList(Node $head, SortDirectionEnum $sortDirection): Node
    {
        $sorted = null;

        while ($head !== null) {
            // Extract the current node
            $current = $head;
            $head = $head->getNext();

            // If the sorted list is empty or the current node is less than the head
            if (
                $sorted === null ||
                ($this->isAscending($sortDirection) && $current->getData() < $sorted->getData()) ||
                ($this->isDescending($sortDirection) && $current->getData() > $sorted->getData())
            ) {
                $current->setNext($sorted);
                $sorted = $current;
            } else {
                // Otherwise, insert into the correct position in the sorted list
                $spot = $sorted;
                while (
                    $spot->getNext() &&
                        (($this->isAscending($sortDirection) && $spot->getNext()->getData() < $current->getData()) ||
                        ($this->isDescending($sortDirection) && $spot->getNext()->getData() > $current->getData()))
                ) {
                    $spot = $spot->getNext();
                }

                $current->setNext($spot->getNext());
                $spot->setNext($current);
            }
        }

        return $sorted;
    }
}
