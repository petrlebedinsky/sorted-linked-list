<?php

declare(strict_types=1);

namespace Lebe\SortedLinkedList\Search;

use Lebe\SortedLinkedList\Node\Node;

class BinarySearch implements LinkedListSearchingInterface
{
    public function contains(mixed $value, Node $head): bool
    {
        $left = $head;
        $right = null;

        while ($left !== $right) {
            $mid = $left;
            $length = 0;

            // Determine the distance between left and right
            for ($end = $left; $end !== $right; $end = $end->getNext()) {
                $length++;
                if (!$end->getNext()) {
                    break;
                }
            }

            // Move mid to the midpoint position
            for ($i = 0; $i < floor($length / 2); $i++) {
                if ($mid === null) {
                    break; // @codeCoverageIgnore
                }
                $mid = $mid->getNext();
            }

            if ($mid->getData() === $value) {
                return true;
            }

            if ($mid->getData() < $value) {
                if (!$mid->getNext()) {
                    return false;
                }
                $left = $mid->getNext();
            } else {
                $right = $mid;
            }
        }

        return false;
    }
}
