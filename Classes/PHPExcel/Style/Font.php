<?php

/**
 * PHPExceller_Style_Font
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
 * @package    PHPExceller_Style
 * @copyright  Copyright (c) 2021 PHPExceller
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExceller_Style_Font extends PHPExceller_Style_Supervisor implements PHPExceller_IComparable
{
    /* Underline types */
    const UNDERLINE_NONE             = 'none';
    const UNDERLINE_DOUBLE           = 'double';
    const UNDERLINE_DOUBLEACCOUNTING = 'doubleAccounting';
    const UNDERLINE_SINGLE           = 'single';
    const UNDERLINE_SINGLEACCOUNTING = 'singleAccounting';

    /**
     * Font Name
     *
     * @var string
     */
    protected $name = 'Calibri';

    /**
     * Font Size
     *
     * @var float
     */
    protected $size = 11;

    /**
     * Bold
     *
     * @var boolean
     */
    protected $bold = false;

    /**
     * Italic
     *
     * @var boolean
     */
    protected $italic = false;

    /**
     * Superscript
     *
     * @var boolean
     */
    protected $superScript = false;

    /**
     * Subscript
     *
     * @var boolean
     */
    protected $subScript = false;

    /**
     * Underline
     *
     * @var string
     */
    protected $underline = self::UNDERLINE_NONE;

    /**
     * Strikethrough
     *
     * @var boolean
     */
    protected $strikethrough = false;

    /**
     * Foreground color
     *
     * @var PHPExceller_Style_Color
     */
    protected $color;

    /**
     * Create a new PHPExceller_Style_Font
     *
     * @param    boolean    $isSupervisor    Flag indicating if this is a supervisor or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     * @param    boolean    $isConditional    Flag indicating if this is a conditional style or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     */
    public function __construct($isSupervisor = false, $isConditional = false)
    {
        // Supervisor?
        parent::__construct($isSupervisor);

        // Initialise values
        if ($isConditional) {
            $this->name = null;
            $this->size = null;
            $this->bold = null;
            $this->italic = null;
            $this->superScript = null;
            $this->subScript = null;
            $this->underline = null;
            $this->strikethrough = null;
            $this->color = new PHPExceller_Style_Color(PHPExceller_Style_Color::COLOR_BLACK, $isSupervisor, $isConditional);
        } else {
            $this->color = new PHPExceller_Style_Color(PHPExceller_Style_Color::COLOR_BLACK, $isSupervisor);
        }
        // bind parent if we are a supervisor
        if ($isSupervisor) {
            $this->color->bindParent($this, 'color');
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor
     *
     * @return PHPExceller_Style_Font
     */
    public function getSharedComponent()
    {
        return $this->parent->getSharedComponent()->getFont();
    }

    /**
     * Build style array from subcomponents
     *
     * @param array $array
     * @return array
     */
    public function getStyleArray($array)
    {
        return array('font' => $array);
    }

    /**
     * Apply styles from array
     *
     * <code>
     * $objPHPExceller->getActiveSheet()->getStyle('B2')->getFont()->applyFromArray(
     *        array(
     *            'name'        => 'Arial',
     *            'bold'        => TRUE,
     *            'italic'    => FALSE,
     *            'underline' => PHPExceller_Style_Font::UNDERLINE_DOUBLE,
     *            'strike'    => FALSE,
     *            'color'        => array(
     *                'rgb' => '808080'
     *            )
     *        )
     * );
     * </code>
     *
     * @param    array    $pStyles    Array containing style information
     * @throws    PHPExceller_Exception
     * @return void
     */
    public function applyFromArray($pStyles = null)
    {
        if (is_array($pStyles)) {
            if ($this->isSupervisor) {
                $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($this->getStyleArray($pStyles));
            } else {
                if (array_key_exists('name', $pStyles)) {
                    $this->setName($pStyles['name']);
                }
                if (array_key_exists('bold', $pStyles)) {
                    $this->setBold($pStyles['bold']);
                }
                if (array_key_exists('italic', $pStyles)) {
                    $this->setItalic($pStyles['italic']);
                }
                if (array_key_exists('superScript', $pStyles)) {
                    $this->setSuperScript($pStyles['superScript']);
                }
                if (array_key_exists('subScript', $pStyles)) {
                    $this->setSubScript($pStyles['subScript']);
                }
                if (array_key_exists('underline', $pStyles)) {
                    $this->setUnderline($pStyles['underline']);
                }
                if (array_key_exists('strike', $pStyles)) {
                    $this->setStrikethrough($pStyles['strike']);
                }
                if (array_key_exists('color', $pStyles)) {
                    $this->getColor()->applyFromArray($pStyles['color']);
                }
                if (array_key_exists('size', $pStyles)) {
                    $this->setSize($pStyles['size']);
                }
            }
        } else {
            throw new PHPExceller_Exception("Invalid style array passed.");
        }
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getName();
        }
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $pValue
     * @return void
     */
    public function setName($pValue = 'Calibri')
    {
        if ($pValue == '') {
            $pValue = 'Calibri';
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('name' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->name = $pValue;
        }
    }

    /**
     * Get Size
     *
     * @return double
     */
    public function getSize()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSize();
        }
        return $this->size;
    }

    /**
     * Set Size
     *
     * @param double $pValue
     * @return void
     */
    public function setSize($pValue = 10)
    {
        if ($pValue == '') {
            $pValue = 10;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('size' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->size = $pValue;
        }
    }

    /**
     * Get Bold
     *
     * @return boolean
     */
    public function getBold()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBold();
        }
        return $this->bold;
    }

    /**
     * Set Bold
     *
     * @param boolean $pValue
     * @return void
     */
    public function setBold($pValue = false)
    {
        if ($pValue == '') {
            $pValue = false;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('bold' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->bold = $pValue;
        }
    }

    /**
     * Get Italic
     *
     * @return boolean
     */
    public function getItalic()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getItalic();
        }
        return $this->italic;
    }

    /**
     * Set Italic
     *
     * @param boolean $pValue
     * @return void
     */
    public function setItalic($pValue = false)
    {
        if ($pValue == '') {
            $pValue = false;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('italic' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->italic = $pValue;
        }
    }

    /**
     * Get SuperScript
     *
     * @return boolean
     */
    public function getSuperScript()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSuperScript();
        }
        return $this->superScript;
    }

    /**
     * Set SuperScript
     *
     * @param boolean $pValue
     * @return void
     */
    public function setSuperScript($pValue = false)
    {
        if ($pValue == '') {
            $pValue = false;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('superScript' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->superScript = $pValue;
            $this->subScript = !$pValue;
        }
    }

        /**
     * Get SubScript
     *
     * @return boolean
     */
    public function getSubScript()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSubScript();
        }
        return $this->subScript;
    }

    /**
     * Set SubScript
     *
     * @param boolean $pValue
     * @return void
     */
    public function setSubScript($pValue = false)
    {
        if ($pValue == '') {
            $pValue = false;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('subScript' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->subScript = $pValue;
            $this->superScript = !$pValue;
        }
    }

    /**
     * Get Underline
     *
     * @return string
     */
    public function getUnderline()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getUnderline();
        }
        return $this->underline;
    }

    /**
     * Set Underline
     *
     * @param string|boolean $pValue    PHPExceller_Style_Font underline type
     *                                    If a boolean is passed, then TRUE equates to UNDERLINE_SINGLE,
     *                                        false equates to UNDERLINE_NONE
     * @return void
     */
    public function setUnderline($pValue = self::UNDERLINE_NONE)
    {
        if (is_bool($pValue)) {
            $pValue = ($pValue) ? self::UNDERLINE_SINGLE : self::UNDERLINE_NONE;
        } elseif ($pValue == '') {
            $pValue = self::UNDERLINE_NONE;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('underline' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->underline = $pValue;
        }
    }

    /**
     * Get Strikethrough
     *
     * @return boolean
     */
    public function getStrikethrough()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getStrikethrough();
        }
        return $this->strikethrough;
    }

    /**
     * Set Strikethrough
     *
     * @param boolean $pValue
     * @return void
     */
    public function setStrikethrough($pValue = false)
    {
        if ($pValue == '') {
            $pValue = false;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(array('strike' => $pValue));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->strikethrough = $pValue;
        }
    }

    /**
     * Get Color
     *
     * @return PHPExceller_Style_Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Color
     *
     * @param    PHPExceller_Style_Color $pValue
     * @throws    PHPExceller_Exception
     * @return void
     */
    public function setColor(PHPExceller_Style_Color $pValue = null)
    {
        // make sure parameter is a real color and not a supervisor
        $color = $pValue->getIsSupervisor() ? $pValue->getSharedComponent() : $pValue;

        if ($this->isSupervisor) {
            $styleArray = $this->getColor()->getStyleArray(array('argb' => $color->getARGB()));
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->color = $color;
        }
    }

    /**
     * Get hash code
     *
     * @return string    Hash code
     */
    public function getHashCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getHashCode();
        }
        return md5(
            $this->name .
            $this->size .
            ($this->bold ? 't' : 'f') .
            ($this->italic ? 't' : 'f') .
            ($this->superScript ? 't' : 'f') .
            ($this->subScript ? 't' : 'f') .
            $this->underline .
            ($this->strikethrough ? 't' : 'f') .
            $this->color->getHashCode() .
            __CLASS__
        );
    }
}
