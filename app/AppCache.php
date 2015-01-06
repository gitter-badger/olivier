<?php
/*
 * This file is part of the Olivier project
 *
 * (c) Artem Genvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

/**
 * Class AppCache
 */
class AppCache extends HttpCache
{
}
