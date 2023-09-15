# Lightweight Sorted Linked List Library
* Provides support of strong typed nodes (IntNode, StringNode)
* Provides different implementation of sorting algos
  * Bubble sort
  * Insertion sort
  * Merge sort (TBD)
  * Quick sort (TBD)

* Provides different implementations of searching algos (for checking if element with given value is present)
  * Binary search
  * Other search algos not implemented because its already late ... :)

# Basic usage
```
// create new list
$sortedLinkedList = new SortedLinkedList(new BubbleSort(), new BinarySearch());

// create new node
$node = new IntNode(1);

// add node
$sortedLinkedList->addNewNode($node);

// create multi node
$multiNode = new IntNode(10, new IntNode(4));

// add multinode
$sortedLinkedList->addNewNode($node);

$sortedLinkedList->toArray(); // [1, 4, 10]
```

# Development requirements
* Docker, Git, GNU utils

# Development
* Library is shipped with convenient setup for development
* Just clone repo and type `make help`


