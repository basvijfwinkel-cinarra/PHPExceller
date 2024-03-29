<?php

/** PHPExceller root directory */
if (!defined('PHPEXCELLER_ROOT')) {
    /**
     * @ignore
     */
    define('PHPEXCELLER_ROOT', dirname(__FILE__) . '/../../');
    require(PHPEXCELLER_ROOT . 'PHPExceller/Autoloader.php');
}

/**
 * PHPExceller_Reader_DefaultReadFilter
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
 * @package    PHPExceller_Reader
 * @copyright  Copyright (c) 2021 PHPExceller
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_Reader_DefaultReadFilter implements PHPExceller_Reader_IReadFilter
{
    /**
     * Should this cell be read?
     *
     * @param    $column           Column address (as a string value like "A", or "IV")
     * @param    $row              Row number
     * @param    $worksheetName    Optional worksheet name
     * @return   boolean
     */
    public function readCell($column, $row, $worksheetName = '')
    {
        return true;
    }
}
