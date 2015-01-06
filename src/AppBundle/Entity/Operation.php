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

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineEnumAssert;
use Fresh\TimestampableEntityBundle\Model\TimestampableInterface;
use Fresh\TimestampableEntityBundle\Traits\TimestampableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Operation Entity
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperationRepository")
 * @ORM\Table(name="operations")
 */
class Operation implements TimestampableInterface
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
     * @var Account $sourceAccount Source account
     *
     * @Assert\NotNull
     * @Assert\Type(type="object")
     *
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="expensesOperations")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $sourceAccount;

    /**
     * @var Account $destinationAccount Destination account
     *
     * @Assert\NotNull
     * @Assert\Type(type="object")
     *
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="incomeOperations")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $destinationAccount;

    /**
     * @var Tag $tag Tag
     *
     * @Assert\NotNull
     * @Assert\Type(type="object")
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="operations")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $tag;

    /**
     * @var Place $place Place
     *
     * @Assert\NotNull
     * @Assert\Type(type="object")
     *
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="operations")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $place;

    /**
     * @var float $value Value
     *
     * @Assert\NotNull
     * @Assert\Type(type="float")
     * @Assert\NotEqualTo(value=0)
     *
     * @ORM\Column(type="decimal", precision=17, scale=2, nullable=false)
     */
    private $value;

    /**
     * @var float $commission Commission
     *
     * @Assert\NotNull
     * @Assert\Type(type="float")
     *
     * @ORM\Column(type="decimal", precision=17, scale=2, nullable=false)
     */
    private $commission = 0;

    /**
     * @var string $comment Comment
     *
     * @Assert\Type(type="string")
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime $date Date
     *
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $date;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    /**
     * __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue() ?: 'New Operation';
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
     * Get source account
     *
     * @return Account Source account
     */
    public function getSourceAccount()
    {
        return $this->sourceAccount;
    }

    /**
     * Set source account
     *
     * @param Account $sourceAccount Source account
     *
     * @return $this
     */
    public function setSourceAccount($sourceAccount)
    {
        $this->sourceAccount = $sourceAccount;

        return $this;
    }

    /**
     * Get destination account
     *
     * @return Account Destination account
     */
    public function getDestinationAccount()
    {
        return $this->destinationAccount;
    }

    /**
     * Set destinationAccount
     *
     * @param Account $destinationAccount Destination account
     *
     * @return $this
     */
    public function setDestinationAccount($destinationAccount)
    {
        $this->destinationAccount = $destinationAccount;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set tag
     *
     * @param Tag $tag Tag
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get place
     *
     * @return Place Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set place
     *
     * @param Place $place Place
     *
     * @return $this
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get value
     *
     * @return float Value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param float $value Value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float Commission
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set commission
     *
     * @param float $commission Commission
     *
     * @return $this
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string Comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set comment
     *
     * @param string $comment Comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date Date
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }
}
