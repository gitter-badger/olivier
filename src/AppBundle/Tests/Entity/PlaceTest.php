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

use AppBundle\Entity\Place;

/**
 * Place Entity Test
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @coversDefaultClass \AppBundle\Entity\Place
 */
class PlaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Place entity
     */
    public function testEmptyPlace()
    {
        $place = new Place();
        $this->assertEquals('New Place', $place->__toString());
        $this->assertNull($place->getId());
        $this->assertNull($place->getTitle());
        $this->assertNull($place->getAddress());
        $this->assertEquals(0, $place->getOperations()->count());
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $place->getOperations());
        $this->assertNull($place->getCreatedAt());
        $this->assertNull($place->getUpdatedAt());
    }

    /**
     * Test setter and getter for title
     */
    public function testSetGetTitle()
    {
        $title = 'Title';
        $place = (new Place())->setTitle($title);
        $this->assertEquals($title, $place->getTitle());
    }

    /**
     * Test setter and getter for address
     */
    public function testSetGetAddress()
    {
        $address = 'Address';
        $place = (new Place())->setAddress($address);
        $this->assertEquals($address, $place->getAddress());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();
        $place = (new Place())->setCreatedAt($now);
        $this->assertEquals($now, $place->getCreatedAt());
    }

    /**
     * Test setter and getter for updatedAt
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();
        $place = (new Place())->setUpdatedAt($now);
        $this->assertEquals($now, $place->getUpdatedAt());
    }
}
