<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 25/7/15
 * Time: 19:46
 */

require_once dirname('__ROOT__') . '/src/Node.php';

class MyList
{
    public $numElements;
    private $ghost;

    function __construct()
    {
        $this->numElements = 0;
        $this->ghost = NULL;
    }

    function find($value)
    {
        if($this->numElements != 0)
        {
            $actualNode = $this->ghost->find($value);
            return $actualNode->printValue();
        }
        else
        {
            return NULL;
        }
    }

    function findAll()
    {
        if($this->ghost != NULL)
        {
            return $this->ghost->findAll();
        }
        else
        {
            return array();
        }
    }

    function insertValue($value)
    {
        if($this->ghost === NULL)
        {
            $this->ghost = new Node($value);
        }
        else
        {
            $lastNode = $this->ghost->findLast();
            $actualNode = new Node($value);
            $actualNode->setPreviousNode($lastNode);
            $lastNode->setNextNode($actualNode);
        }
        $this->numElements++;
    }

    function delete($value)
    {
        $nodeToDelete = $this->ghost->find($value);
        $previousNode = $nodeToDelete->getPreviousNode();
        $nextNode = $nodeToDelete->getNextNode();

        if($nextNode === NULL)
        {
            if($previousNode === NULL)
            {

                $this->ghost = NULL;
            }
            else
            {
                $previousNode->setNextNode(NULL);
            }
        }
        else
        {
            if($previousNode === NULL)
            {
                $this->ghost = $nextNode;
                $nextNode->setPreviousNode(NULL);
            }
            else
            {
                $previousNode->setNextNode($nextNode);
                $nextNode->setPreviousNode($previousNode);
            }
        }

        unset($nodeToDelete);
        $this->numElements--;
    }
} 