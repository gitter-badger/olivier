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
 * Tag Entity
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 * @ORM\Table(name="tags")
 *
 * @UniqueEntity("title")
 */
class Tag implements TimestampableInterface
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
     * @Assert\Length(min="1", max="100")
     *
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
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
    private $description;

    /**
     * @var boolean $enabled Is enabled?
     *
     * @Assert\Type(type="bool")
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $enabled = true;

    /**
     * @var Collection|Operation[] $operations Operations
     *
     * @Assert\Type(type="object")
     *
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="tag", cascade={"persist", "remove"}, orphanRemoval=true)
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
        return $this->getTitle() ?: 'New Tag';
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
     * Get description
     *
     * @return string Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Is enabled
     *
     * @return boolean Enabled
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled Enabled
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

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
