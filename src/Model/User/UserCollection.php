<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prooph\ProophessorDo\Model\User;

/**
 * Interface UserCollection
 *
 * @package Prooph\ProophessorDo\Model\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface UserCollection
{
    /**
     * @param User $user
     * @return void
     */
    public function add(User $user);

    /**
     * @param UserId $userId
     * @return User
     */
    public function get(UserId $userId);
}
