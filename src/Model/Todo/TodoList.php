<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prooph\ProophessorDo\Model\Todo;

/**
 * Interface TodoList
 *
 * @package Prooph\ProophessorDo\Model\Todo
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface TodoList
{
    /**
     * @param Todo $todo
     * @return void
     */
    public function add(Todo $todo);

    /**
     * @param TodoId $todoId
     * @return Todo
     */
    public function get(TodoId $todoId);
}
