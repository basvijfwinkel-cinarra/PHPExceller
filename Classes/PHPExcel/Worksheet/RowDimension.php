<?php

/**
 * PHPExceller_Worksheet_RowDimension
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
 * @package    PHPExceller_Worksheet
 * @copyright  Copyright (c) 2021 PHPExceller
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_Worksheet_RowDimension extends PHPExceller_Worksheet_Dimension
{
    /**
     * Row index
     *
     * @var int
     */
    private $rowIndex;

    /**
     * Row height (in pt)
     *
     * When this is set to a negative value, the row height should be ignored by IWriter
     *
     * @var double
     */
    private $height = -1;

     /**
     * ZeroHeight for Row?
     *
     * @var bool
     */
    private $zeroHeight = false;

    /**
     * Create a new PHPExceller_Worksheet_RowDimension
     *
     * @param int $pIndex Numeric row index
     */
    public function __construct($pIndex = 0)
    {
        // Initialise values
        $this->rowIndex = $pIndex;

        // set dimension as unformatted by default
        parent::__construct(null);
    }

    /**
     * Get Row Index
     *
     * @return int
     */
    public function getRowIndex()
    {
        return $this->rowIndex;
    }

    /**
     * Set Row Index
     *
     * @param int $pValue
     * @return void
     */
    public function setRowIndex($pValue)
    {
        $this->rowIndex = $pValue;
    }

    /**
     * Get Row Height
     *
     * @return double
     */
    public function getRowHeight()
    {
        return $this->height;
    }

    /**
     * Set Row Height
     *
     * @param double $pValue
     * @return void
     */
    public function setRowHeight($pValue = -1)
    {
        $this->height = $pValue;
    }

    /**
     * Get ZeroHeight
     *
     * @return bool
     */
    public function getZeroHeight()
    {
        return $this->zeroHeight;
    }

    /**
     * Set ZeroHeight
     *
     * @param bool $pValue
     * @return void
     */
    public function setZeroHeight($pValue = false)
    {
        $this->zeroHeight = $pValue;
    }
}
