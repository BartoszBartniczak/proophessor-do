<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ProophessorDo\Model\Todo;

use Prooph\ProophessorDo\Model\Enum;

/**
 * Class TodoStatus
 *
 * @package Prooph\ProophessorDo\Model\Todo
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 *
 * @method static TodoStatus OPEN()
 * @method static TodoStatus DONE()
 * @method static TodoStatus EXPIRED()
 */
final class TodoStatus extends Enum
{
    const OPEN = "open";
    const DONE = "done";
    const EXPIRED = "expired";
}
