<?php
/*
 * This file is part of the Olivier project
 *
 * (c) Artem Genvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Currency type
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 */
class CurrencyType extends AbstractEnumType
{
    const UAH = 'UAH';
    const USD = 'USD';
    const EUR = 'EUR';

    /**
     * {@inheritdoc}
     */
    protected static $choices = [
        self::UAH => 'UAH',
        self::USD => 'USD',
        self::EUR => 'EUR'
    ];
}
