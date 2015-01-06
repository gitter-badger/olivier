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

use AppBundle\DBAL\Types\CurrencyType;
use AppBundle\Entity\Account;
use AppBundle\Entity\Operation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Account Entity Test
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 *
 * @coversDefaultClass \AppBundle\Entity\Account
 */
class AccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Account entity
     */
    public function testEmptyAccount()
    {
        $account = new Account();
        $this->assertEquals('New Account', $account->__toString());
        $this->assertNull($account->getId());
        $this->assertNull($account->getTitle());
        $this->assertNull($account->getDescription());
        $this->assertEquals(0, $account->getValue());
        $this->assertEquals(CurrencyType::UAH, $account->getCurrency());
        $this->assertEquals(0, $account->getIncomeOperations()->count());
        $this->assertEquals(0, $account->getExpensesOperations()->count());
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $account->getIncomeOperations());
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $account->getExpensesOperations());
        $this->assertNull($account->getCreatedAt());
        $this->assertNull($account->getUpdatedAt());
    }

    /**
     * Test setter and getter for title
     */
    public function testSetGetTitle()
    {
        $title = 'Title';
        $account = (new Account())->setTitle($title);
        $this->assertEquals($title, $account->getTitle());
    }

    /**
     * Test setter and getter for description
     */
    public function testSetGetDescription()
    {
        $description = 'Description';
        $account = (new Account())->setDescription($description);
        $this->assertEquals($description, $account->getDescription());
    }

    /**
     * Test setter and getter for value
     */
    public function testSetGetValue()
    {
        $value = 20.5;
        $account = (new Account())->setValue($value);
        $this->assertEquals($value, $account->getValue());
    }

    /**
     * Test setter and getter for currency
     */
    public function testSetGetCurrency()
    {
        $currency = CurrencyType::UAH;
        $account = (new Account())->setCurrency($currency);
        $this->assertEquals($currency, $account->getCurrency());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();
        $account = (new Account())->setCreatedAt($now);
        $this->assertEquals($now, $account->getCreatedAt());
    }

    /**
     * Test setter and getter for updatedAt
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();
        $account = (new Account())->setUpdatedAt($now);
        $this->assertEquals($now, $account->getUpdatedAt());
    }

    /**
     * Test setter and getter for income operations
     */
    public function testSetGetIncomeOperations()
    {
        $incomeOperations = new ArrayCollection();
        $incomeOperations->add(new Operation());
        $account = (new Account())->setIncomeOperations($incomeOperations);
        $this->assertEquals(1, $account->getIncomeOperations()->count());
        $this->assertEquals($incomeOperations, $account->getIncomeOperations());
    }

    /**
     * Test add and remove income operations
     */
    public function testAddRemoveIncomeOperation()
    {
        $account = new Account();
        $this->assertEquals(0, $account->getIncomeOperations()->count());
        $account->addIncomeOperation(new Operation());
        $this->assertEquals(1, $account->getIncomeOperations()->count());
        $team = $account->getIncomeOperations()->first();
        $account->removeIncomeOperation($team);
        $this->assertEquals(0, $account->getIncomeOperations()->count());
    }

    /**
     * Test setter and getter for expenses operations
     */
    public function testSetGetExpensesOperations()
    {
        $expensesOperations = new ArrayCollection();
        $expensesOperations->add(new Operation());
        $account = (new Account())->setExpensesOperations($expensesOperations);
        $this->assertEquals(1, $account->getExpensesOperations()->count());
        $this->assertEquals($expensesOperations, $account->getExpensesOperations());
    }

    /**
     * Test add and remove expenses operations
     */
    public function testAddRemoveExpensesOperation()
    {
        $account = new Account();
        $this->assertEquals(0, $account->getExpensesOperations()->count());
        $account->addExpensesOperation(new Operation());
        $this->assertEquals(1, $account->getExpensesOperations()->count());
        $team = $account->getExpensesOperations()->first();
        $account->removeExpensesOperation($team);
        $this->assertEquals(0, $account->getExpensesOperations()->count());
    }
}
