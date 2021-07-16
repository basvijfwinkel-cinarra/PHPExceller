<?php

/**
 * PHPExceller_Reader_IReader
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
interface PHPExceller_Reader_IReader
{
    /**
     * Can the current PHPExceller_Reader_IReader read the file?
     *
     * @param     string         $pFilename
     * @return     boolean
     */
    public function canRead($pFilename);

    /**
     * Loads PHPExceller from file
     *
     * @param     string         $pFilename
     * @return  PHPExceller
     * @throws     PHPExceller_Reader_Exception
     */
    public function load($pFilename);
}