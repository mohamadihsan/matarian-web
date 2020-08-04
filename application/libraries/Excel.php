<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once APPPATH."/third_party/PHPExcel.php";
require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
require_once APPPATH."/third_party/PHPExcel/Reader/IReadFilter.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}

class chunkReadFilter implements PHPExcel_Reader_IReadFilter
{ 
    private $_startRow = 0; 
    private $_endRow   = 0; 

    public function setRows($startRow, $chunkSize) { 
        $this->_startRow = $startRow; 
        $this->_endRow   = $startRow + $chunkSize; 
    } 

    public function readCell($column, $row, $worksheetName = '') { 
        if (($row == 1) ||
            ($row >= $this->_startRow && $row < $this->_endRow)) { 
            return true; 
        } 
        return false; 
    } 
} 