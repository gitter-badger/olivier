<?php
/*
 * This file is part of the Olivier project
 *
 * (c) Artem Genvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Account;
use AppBundle\Entity\Operation;
use AppBundle\Entity\Place;
use AppBundle\Entity\Tag;

/**
 * Operation Entity Test
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @coversDefaultClass \AppBundle\Entity\Operation
 */
class OperationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Operation entity
     */
    public function testEmptyOperation()
    {
        $operation = new Operation();
        $this->assertEquals('New Operation', $operation->__toString());
        $this->assertNull($operation->getId());
        $this->assertNull($operation->getSourceAccount());
        $this->assertNull($operation->getDestinationAccount());
        $this->assertNull($operation->getComment());
        $this->assertNull($operation->getTag());
        $this->assertNull($operation->getPlace());
        $this->assertEquals(0, $operation->getValue());
        $this->assertEquals(0, $operation->getCommission());
        $this->assertNull($operation->getCreatedAt());
        $this->assertNull($operation->getUpdatedAt());
    }

    /**
     * Test setter and getter for sourceAccount
     */
    public function testSetGetSourceAccount()
    {
        $account = new Account();
        $operation = (new Operation())->setSourceAccount($account);
        $this->assertEquals($account, $operation->getSourceAccount());
    }

    /**
     * Test setter and getter for destinationAccount
     */
    public function testSetGetDestinationAccount()
    {
        $account = new Account();
        $operation = (new Operation())->setDestinationAccount($account);
        $this->assertEquals($account, $operation->getDestinationAccount());
    }

    /**
     * Test setter and getter for comment
     */
    public function testSetGetComment()
    {
        $comment = 'Comment';
        $operation = (new Operation())->setComment($comment);
        $this->assertEquals($comment, $operation->getComment());
    }

    /**
     * Test setter and getter for tag
     */
    public function testSetGetTag()
    {
        $tag = new Tag();
        $operation = (new Operation())->setTag($tag);
        $this->assertEquals($tag, $operation->getTag());
    }

    /**
     * Test setter and getter for place
     */
    public function testSetGetPlace()
    {
        $place = new Place();
        $operation = (new Operation())->setPlace($place);
        $this->assertEquals($place, $operation->getPlace());
    }

    /**
     * Test setter and getter for commission
     */
    public function testSetGetCommission()
    {
        $commission = 12.5;
        $operation = (new Operation())->setCommission($commission);
        $this->assertEquals($commission, $operation->getCommission());
    }

    /**
     * Test setter and getter for value
     */
    public function testSetGetValue()
    {
        $value = 20.5;
        $operation = (new Operation())->setValue($value);
        $this->assertEquals($value, $operation->getValue());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();
        $operation = (new Operation())->setCreatedAt($now);
        $this->assertEquals($now, $operation->getCreatedAt());
    }

    /**
     * Test setter and getter for updatedAt
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();
        $operation = (new Operation())->setUpdatedAt($now);
        $this->assertEquals($now, $operation->getUpdatedAt());
    }
}
