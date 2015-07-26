<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 25/7/15
 * Time: 19:44
 */

require_once dirname('__ROOT__') . '/src/MyList.php';

class MyListTest extends \PHPUnit_Framework_TestCase
{
    private $list;

    function setUp()
    {
        $this->list = new MyList();
    }

    function testListIsEmpty()
    {
        $this->assertEquals(null, $this->list->find('fred'));
    }

    function testAddingNodeAndRetrievingValue()
    {
        $this->list->insertValue('fred');
        $this->assertEquals('fred', $this->list->find('fred'));
    }

    function testAdding2NodesAndFinding2DifferentValue()
    {
        $this->list->insertValue('fred');
        $this->list->insertValue('wilma');
        $this->assertEquals('fred', $this->list->find('fred'));
        $this->assertEquals('wilma', $this->list->find('wilma'));
    }

    function testAdding2NodesAndGettingAllResults()
    {
        $this->list->insertValue('fred');
        $this->list->insertValue('wilma');
        $this->assertEquals(array('fred', 'wilma'), $this->list->findAll());
    }

    function testAdding4NodesDeletingOneAndGettingAllResults()
    {
        $this->list->insertValue('fred');
        $this->list->insertValue('wilma');
        $this->list->insertValue('betty');
        $this->list->insertValue('barney');
        $this->list->delete('wilma');
        $this->assertEquals(array('fred', 'betty', 'barney'), $this->list->findAll());
    }

    function testAdding4NodesDeletingOneAfterOneAndGettingAllResults()
    {
        $this->list->insertValue('fred');
        $this->list->insertValue('wilma');
        $this->list->insertValue('betty');
        $this->list->insertValue('barney');
        $this->list->delete('wilma');
        $this->assertEquals(array('fred', 'betty', 'barney'), $this->list->findAll());
        $this->list->delete('barney');
        $this->assertEquals(array('fred', 'betty'), $this->list->findAll());
        $this->list->delete('fred');
        $this->assertEquals(array('betty'), $this->list->findAll());
        $this->list->delete('betty');
        $this->assertEquals(array(), $this->list->findAll());
    }

}