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

use AppBundle\DBAL\Types\CurrencyType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineEnumAssert;
use Fresh\TimestampableEntityBundle\Model\TimestampableInterface;
use Fresh\TimestampableEntityBundle\Traits\TimestampableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account Entity
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 * @ORM\Table(name="accounts")
 *
 * @UniqueEntity("title")
 */
class Account implements TimestampableInterface
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
     * @var float $value Value
     *
     * @Assert\Type(type="float")
     *
     * @ORM\Column(type="decimal", precision=17, scale=2, nullable=false)
     */
    private $value = 0;

    /**
     * @var float $currency Currency
     *
     * @Assert\Currency
     * @DoctrineEnumAssert\Enum(entity="AppBundle\DBAL\Types\CurrencyType")
     *
     * @ORM\Column(type="CurrencyType", precision=17, scale=2, nullable=false)
     */
    private $currency = CurrencyType::UAH;

    /**
     * @var Collection|Operation[] $incomeOperations Income operations
     *
     * @Assert\Type(type="object")
     *
     * @ORM\OneToMany(
     *     targetEntity="Operation", mappedBy="destinationAccount", cascade={"persist", "remove"}, orphanRemoval=true
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $incomeOperations;

    /**
     * @var Collection|Operation[] $expensesOperations Expenses operations
     *
     * @Assert\Type(type="object")
     *
     * @ORM\OneToMany(
     *     targetEntity="Operation", mappedBy="sourceAccount", cascade={"persist", "remove"}, orphanRemoval=true
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $expensesOperations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->incomeOperations   = new ArrayCollection();
        $this->expensesOperations = new ArrayCollection();
    }

    /**
     * __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'New Account';
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
     * Get currency
     *
     * @return float Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency
     *
     * @param float $currency Currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get income operations
     *
     * @return Collection|Operation[] Income operations
     */
    public function getIncomeOperations()
    {
        return $this->incomeOperations;
    }

    /**
     * Set income operations
     *
     * @param Collection|Operation[] $incomeOperations Income operations
     *
     * @return $this
     */
    public function setIncomeOperations(Collection $incomeOperations)
    {
        foreach ($incomeOperations as $incomeOperation) {
            $incomeOperation->setSourceAccount($this);
        }
        $this->incomeOperations = $incomeOperations;

        return $this;
    }

    /**
     * Add income operation
     *
     * @param Operation $incomeOperation Income operation
     *
     * @return $this
     */
    public function addIncomeOperation(Operation $incomeOperation)
    {
        $this->incomeOperations->add($incomeOperation->setSourceAccount($this));

        return $this;
    }

    /**
     * Remove income operation
     *
     * @param Operation $incomeOperation Income operation
     *
     * @return $this
     */
    public function removeIncomeOperation(Operation $incomeOperation)
    {
        $this->incomeOperations->removeElement($incomeOperation);

        return $this;
    }

    /**
     * Get expenses operations
     *
     * @return Collection|Operation[] Expenses operations
     */
    public function getExpensesOperations()
    {
        return $this->expensesOperations;
    }

    /**
     * Set expenses operations
     *
     * @param Collection|Operation[] $expensesOperations Expenses operations
     *
     * @return $this
     */
    public function setExpensesOperations(Collection $expensesOperations)
    {
        foreach ($expensesOperations as $expensesOperation) {
            $expensesOperation->setDestinationAccount($this);
        }
        $this->expensesOperations = $expensesOperations;

        return $this;
    }

    /**
     * Add expenses operation
     *
     * @param Operation $expensesOperation Expenses operation
     *
     * @return $this
     */
    public function addExpensesOperation(Operation $expensesOperation)
    {
        $this->expensesOperations->add($expensesOperation->setDestinationAccount($this));

        return $this;
    }

    /**
     * Remove expenses operation
     *
     * @param Operation $expensesOperation Expenses operation
     *
     * @return $this
     */
    public function removeExpensesOperation(Operation $expensesOperation)
    {
        $this->expensesOperations->removeElement($expensesOperation);

        return $this;
    }
}
