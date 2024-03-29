<?php

/**
 * PHPExceller_Shared_Escher
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
 * @package    PHPExceller_Shared_Escher
 * @copyright  Copyright (c) 2021 PHPExceller
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_Shared_Escher
{
    /**
     * Drawing Group Container
     *
     * @var PHPExceller_Shared_Escher_DggContainer
     */
    private $dggContainer;

    /**
     * Drawing Container
     *
     * @var PHPExceller_Shared_Escher_DgContainer
     */
    private $dgContainer;

    /**
     * Get Drawing Group Container
     *
     * @return PHPExceller_Shared_Escher_DgContainer
     */
    public function getDggContainer()
    {
        return $this->dggContainer;
    }

    /**
     * Set Drawing Group Container
     *
     * @param PHPExceller_Shared_Escher_DggContainer $dggContainer
     */
    public function setDggContainer($dggContainer)
    {
        return $this->dggContainer = $dggContainer;
    }

    /**
     * Get Drawing Container
     *
     * @return PHPExceller_Shared_Escher_DgContainer
     */
    public function getDgContainer()
    {
        return $this->dgContainer;
    }

    /**
     * Set Drawing Container
     *
     * @param PHPExceller_Shared_Escher_DgContainer $dgContainer
     */
    public function setDgContainer($dgContainer)
    {
        return $this->dgContainer = $dgContainer;
    }
}
