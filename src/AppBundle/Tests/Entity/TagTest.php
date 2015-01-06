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

use AppBundle\Entity\Tag;

/**
 * Tag Entity Test
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @coversDefaultClass \AppBundle\Entity\Tag
 */
class TagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Tag entity
     */
    public function testEmptyTag()
    {
        $tag = new Tag();
        $this->assertEquals('New Tag', $tag->__toString());
        $this->assertNull($tag->getId());
        $this->assertNull($tag->getTitle());
        $this->assertNull($tag->getDescription());
        $this->assertTrue($tag->isEnabled());
        $this->assertEquals(0, $tag->getOperations()->count());
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $tag->getOperations());
        $this->assertNull($tag->getCreatedAt());
        $this->assertNull($tag->getUpdatedAt());
    }

    /**
     * Test setter and getter for title
     */
    public function testSetGetTitle()
    {
        $title = 'Title';
        $tag = (new Tag())->setTitle($title);
        $this->assertEquals($title, $tag->getTitle());
    }

    /**
     * Test setter and getter for description
     */
    public function testSetGetDescription()
    {
        $description = 'Description';
        $tag = (new Tag())->setDescription($description);
        $this->assertEquals($description, $tag->getDescription());
    }

    /**
     * Test setter and getter for enabled
     */
    public function testSetIsEnabled()
    {
        $tag = (new Tag())->setEnabled(false);
        $this->assertFalse($tag->isEnabled());
        $tag->setEnabled(true);
        $this->assertTrue($tag->isEnabled());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();
        $tag = (new Tag())->setCreatedAt($now);
        $this->assertEquals($now, $tag->getCreatedAt());
    }

    /**
     * Test setter and getter for updatedAt
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();
        $tag = (new Tag())->setUpdatedAt($now);
        $this->assertEquals($now, $tag->getUpdatedAt());
    }
}
