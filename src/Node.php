<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 25/7/15
 * Time: 19:50
 */

class Node
{
    private $value;
    private $previousNode;
    private $nextNode;

    function __construct($value)
    {
        $this->value = $value;
        $this->previousNode = NULL;
        $this->nextNode = NULL;
    }

    public function printValue()
    {
        return $this->value;
    }

    public function updateValue($value)
    {
        $this->value = $value;
    }

    public function setPreviousNode($node)
    {
        $this->previousNode = $node;
    }

    public function setNextNode($node)
    {
        $this->nextNode = $node;
    }

    public function getPreviousNode()
    {
        return $this->previousNode;
    }
    public function getNextNode()
    {
       return $this->nextNode;
    }

    public function find($value)
    {
        if(strcmp($this->value, $value) == 0)
        {
            return $this;
        }
        else
        {
            if($this->nextNode != NULL)
            {
                return $this->nextNode->find($value);
            }
            else
            {
                 return NULL;
            }
        }
    }

    public function findAll()
    {
        $values = array();
        $node = $this;

        while($node->nextNode != NULL)
        {
            array_push($values, $node->printValue());
            $node = $node->nextNode;
        }
        array_push($values, $node->printValue());

        return $values;
    }

    public function findLast()
    {
        if($this->nextNode === NULL)
        {
            return $this;
        }
        else
        {
            return $this->nextNode->findLast();
        }
    }


} 