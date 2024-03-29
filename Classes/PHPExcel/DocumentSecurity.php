<?php

/**
 * PHPExceller_DocumentSecurity
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
class PHPExceller_DocumentSecurity
{
    /**
     * LockRevision
     *
     * @var boolean
     */
    private $lockRevision;

    /**
     * LockStructure
     *
     * @var boolean
     */
    private $lockStructure;

    /**
     * LockWindows
     *
     * @var boolean
     */
    private $lockWindows;

    /**
     * RevisionsPassword
     *
     * @var string
     */
    private $revisionsPassword;

    /**
     * WorkbookPassword
     *
     * @var string
     */
    private $workbookPassword;

    /**
     * Create a new PHPExceller_DocumentSecurity
     */
    public function __construct()
    {
        // Initialise values
        $this->lockRevision      = false;
        $this->lockStructure     = false;
        $this->lockWindows       = false;
        $this->revisionsPassword = '';
        $this->workbookPassword  = '';
    }

    /**
     * Is some sort of document security enabled?
     *
     * @return boolean
     */
    public function isSecurityEnabled()
    {
        return  $this->lockRevision ||
                $this->lockStructure ||
                $this->lockWindows;
    }

    /**
     * Get LockRevision
     *
     * @return boolean
     */
    public function getLockRevision()
    {
        return $this->lockRevision;
    }

    /**
     * Set LockRevision
     *
     * @param boolean $pValue
     * @return void
     */
    public function setLockRevision($pValue = false)
    {
        $this->lockRevision = $pValue;
    }

    /**
     * Get LockStructure
     *
     * @return boolean
     */
    public function getLockStructure()
    {
        return $this->lockStructure;
    }

    /**
     * Set LockStructure
     *
     * @param boolean $pValue
     * @return void
     */
    public function setLockStructure($pValue = false)
    {
        $this->lockStructure = $pValue;
    }

    /**
     * Get LockWindows
     *
     * @return boolean
     */
    public function getLockWindows()
    {
        return $this->lockWindows;
    }

    /**
     * Set LockWindows
     *
     * @param boolean $pValue
     * @return void
     */
    public function setLockWindows($pValue = false)
    {
        $this->lockWindows = $pValue;
    }

    /**
     * Get RevisionsPassword (hashed)
     *
     * @return string
     */
    public function getRevisionsPassword()
    {
        return $this->revisionsPassword;
    }

    /**
     * Set RevisionsPassword
     *
     * @param string     $pValue
     * @param boolean     $pAlreadyHashed If the password has already been hashed, set this to true
     * @return void
     */
    public function setRevisionsPassword($pValue = '', $pAlreadyHashed = false)
    {
        if (!$pAlreadyHashed) {
            $pValue = PHPExceller_Shared_PasswordHasher::hashPassword($pValue);
        }
        $this->revisionsPassword = $pValue;
    }

    /**
     * Get WorkbookPassword (hashed)
     *
     * @return string
     */
    public function getWorkbookPassword()
    {
        return $this->workbookPassword;
    }

    /**
     * Set WorkbookPassword
     *
     * @param string     $pValue
     * @param boolean     $pAlreadyHashed If the password has already been hashed, set this to true
     * @return void
     */
    public function setWorkbookPassword($pValue = '', $pAlreadyHashed = false)
    {
        if (!$pAlreadyHashed) {
            $pValue = PHPExceller_Shared_PasswordHasher::hashPassword($pValue);
        }
        $this->workbookPassword = $pValue;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }
}
