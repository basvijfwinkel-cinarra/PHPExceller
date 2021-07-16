<?php

/**
 * PHPExceller_CachedObjectStorage_Igbinary
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
 * @package    PHPExceller_CachedObjectStorage
 * @copyright  Copyright (c) 2021
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_CachedObjectStorage_Igbinary extends PHPExceller_CachedObjectStorage_CacheBase implements PHPExceller_CachedObjectStorage_ICache
{
    /**
     * Store cell data in cache for the current cell object if it's "dirty",
     *     and the 'nullify' the current cell object
     *
     * @return    void
     * @throws    PHPExceller_Exception
     */
    protected function storeData()
    {
        if ($this->currentCellIsDirty && !empty($this->currentObjectID)) {
            $this->currentObject->detach();

            $this->cellCache[$this->currentObjectID] = igbinary_serialize($this->currentObject);
            $this->currentCellIsDirty = false;
        }
        $this->currentObjectID = $this->currentObject = null;
    }    //    function _storeData()


    /**
     * Add or Update a cell in cache identified by coordinate address
     *
     * @param    string            $pCoord        Coordinate address of the cell to update
     * @param    PHPExceller_Cell    $cell        Cell to update
     * @return    PHPExceller_Cell
     * @throws    PHPExceller_Exception
     */
    public function addCacheData($pCoord, PHPExceller_Cell $cell)
    {
        if (($pCoord !== $this->currentObjectID) && ($this->currentObjectID !== null)) {
            $this->storeData();
        }

        $this->currentObjectID = $pCoord;
        $this->currentObject = $cell;
        $this->currentCellIsDirty = true;

        return $cell;
    }    //    function addCacheData()


    /**
     * Get cell at a specific coordinate
     *
     * @param     string             $pCoord        Coordinate of the cell
     * @throws     PHPExceller_Exception
     * @return     PHPExceller_Cell     Cell that was found, or null if not found
     */
    public function getCacheData($pCoord)
    {
        if ($pCoord === $this->currentObjectID) {
            return $this->currentObject;
        }
        $this->storeData();

        //    Check if the entry that has been requested actually exists
        if (!isset($this->cellCache[$pCoord])) {
            //    Return null if requested entry doesn't exist in cache
            return null;
        }

        //    Set current entry to the requested entry
        $this->currentObjectID = $pCoord;
        $this->currentObject = igbinary_unserialize($this->cellCache[$pCoord]);
        //    Re-attach this as the cell's parent
        $this->currentObject->attach($this);

        //    Return requested entry
        return $this->currentObject;
    }    //    function getCacheData()


    /**
     * Get a list of all cell addresses currently held in cache
     *
     * @return  string[]
     */
    public function getCellList()
    {
        if ($this->currentObjectID !== null) {
            $this->storeData();
        }

        return parent::getCellList();
    }


    /**
     * Clear the cell collection and disconnect from our parent
     *
     * @return    void
     */
    public function unsetWorksheetCells()
    {
        if (!is_null($this->currentObject)) {
            $this->currentObject->detach();
            $this->currentObject = $this->currentObjectID = null;
        }
        $this->cellCache = array();

        //    detach ourself from the worksheet, so that it can then delete this object successfully
        $this->parent = null;
    }    //    function unsetWorksheetCells()


    /**
     * Identify whether the caching method is currently available
     * Some methods are dependent on the availability of certain extensions being enabled in the PHP build
     *
     * @return    boolean
     */
    public static function cacheMethodIsAvailable()
    {
        if (!function_exists('igbinary_serialize')) {
            return false;
        }

        return true;
    }
}
