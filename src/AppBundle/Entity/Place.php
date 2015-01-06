<?php
/*
 * This file is part of the Olivier project
 *
 * (c) Artem Genvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\TimestampableEntityBundle\Model\TimestampableInterface;
use Fresh\TimestampableEntityBundle\Traits\TimestampableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Place Entity
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlaceRepository")
 * @ORM\Table(name="places")
 *
 * @UniqueEntity("title")
 */
class Place implements TimestampableInterface
{
    // Methods and properties for timestampable entity
    use TimestampableTrait;

    /**
     * @var int $id ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string $title Title
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(min="1", max="255")
     *
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    private $title;

    /**
     * @var string $description Description
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max="255")
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var Collection|Operation[] $operations Operations
     *
     * @Assert\Type(type="object")
     *
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="place", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $operations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->operations = new ArrayCollection();
    }

    /**
     * __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'New Place';
    }

    /**
     * Get ID
     *
     * @return int ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title Title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get address
     *
     * @return string Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address Address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get operations
     *
     * @return Collection|Operation[] Operations
     */
    public function getOperations()
    {
        return $this->operations;
    }
}
