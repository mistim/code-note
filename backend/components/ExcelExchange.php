<?php

namespace backend\components;

use yii\base\Exception;

/**
 * Class ExcelExchange
 * @package app\helpers
 */
class ExcelExchange
{
    protected $row = 1;
    protected $col = 0;
    protected $exlColumns = [];
    protected $writerType = 'Excel2007'; //'Excel5';
    protected $formatList = [
        'Excel5' => 'xls',
        'Excel2007' => 'xlsx'
    ];

    /** @var $PHPExcel \PHPExcel */
    public $PHPExcel;

    /** @var array $languages */
    public $languages = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!array_key_exists($this->writerType, $this->formatList))
        {
            throw new Exception('Incorrect write type');
        }
    }

    /**
     * @param string $sheetName
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function createExcel($sheetName = 'active')
    {
        $this->setExlColumns();

        $this->PHPExcel = new \PHPExcel();

        $this->PHPExcel->getActiveSheet()->setTitle($sheetName);
        $this->PHPExcel->setActiveSheetIndex(0);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function newRow()
    {
        $this->row++;
        $this->col = 0;
    }

    /**
     * @param $value
     * @param bool|true $colPlus
     * @param bool|false $rowPlus
     * @return $this
     */
    public function setColumn($value, $colPlus = true, $rowPlus = false)
    {
        $this->PHPExcel->getActiveSheet()->setCellValue($this->getCurrentPosition(), $value);

        if($colPlus)
        {
            $this->col++;
        }

        if($rowPlus)
        {
            $this->row++;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentPosition()
    {
        $column = $this->exlColumns[$this->col];
        return $column.$this->row;
    }

    /**
     * @param $col
     * @param $row
     * @return string
     */
    public function getColtPosition($col, $row)
    {
        $column = $this->exlColumns[$col];
        return $column.$row;
    }

    /**
     * @param string $limit
     * @return $this
     */
    public function setExlColumns($limit = 'ZZZ')
    {
        $this->exlColumns = array('A');
        $current = 'A';
        while ($current !== $limit)
        {
            $this->exlColumns[] = ++$current;
        }
        return $this;
    }

    /**
     * @return string
     * @throws \PHPExcel_Reader_Exception
     */
    public function getContent()
    {
        ob_start();
        $writer = \PHPExcel_IOFactory::createWriter($this->PHPExcel, $this->writerType);
        $writer->save('php://output');
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    /**
     * @param string $prefix
     * @throws \PHPExcel_Reader_Exception
     */
    public function getContentDownload($prefix = '')
    {
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename=' . $this->getFileName($prefix));
        header('Content-Transfer-Encoding: binary');

        $writer = \PHPExcel_IOFactory::createWriter($this->PHPExcel, $this->writerType);
        $writer->save('php://output');
    }

    /**
     * @param $prefix
     * @return string
     */
    public function getFileName($prefix)
    {
        $filename = 'report_' . $prefix . '_' . date('d.m.Y_H-i-s') . '.' . $this->formatList[$this->writerType];
        return $filename;
    }
}