<?php

/**
 * PHPExceller_WorksheetIterator
 *
 * Copyright (c) 2021 PHPExceller
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExceller
 * @package    PHPExceller
 * @copyright  Copyright (c) 2021
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_WorksheetIterator implements Iterator
{
    /**
     * Spreadsheet to iterate
     *
     * @var PHPExceller
     */
    private $subject;

    /**
     * Current iterator position
     *
     * @var int
     */
    private $position = 0;

    /**
     * Create a new worksheet iterator
     *
     * @param PHPExceller         $subject
     */
    public function __construct(PHPExceller $subject = null)
    {
        // Set subject
        $this->subject = $subject;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->subject);
    }

    /**
     * Rewind iterator
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Current PHPExceller_Worksheet
     *
     * @return PHPExceller_Worksheet
     */
    public function current()
    {
        return $this->subject->getSheet($this->position);
    }

    /**
     * Current key
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Next value
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * More PHPExceller_Worksheet instances available?
     *
     * @return boolean
     */
    public function valid()
    {
        return $this->position < $this->subject->getSheetCount();
    }
}
