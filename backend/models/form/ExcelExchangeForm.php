<?php

namespace backend\models\form;

use backend\components\ExcelExchange;
use common\models\Message;
use common\models\SourceMessage;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

/**
 * Class ExcelExchangeForm
 * @package backend\models\form
 */
class ExcelExchangeForm extends Model
{
    public $languages; // 'uk', 'en' or 'ru'
    public $is_rewrite = false;
    public $type_end; // 'backend' or 'frontend';
    public $category; // 'admin' or 'app'
    public $file;
    public $errors;

    protected $translation_;
    protected $fileName;
    protected $filePath;
    protected $formats = [
        'xls'  => 'Excel5',
        'xlsx' => 'Excel2007',
    ];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['languages', 'is_rewrite'], 'required'],
            ['is_rewrite', 'boolean'],
            ['type_end', 'in', 'range' => ['backend', 'frontend']],
            ['category', 'in', 'range' => ['admin', 'app']],
            [
                'file', 'file', 'skipOnEmpty'            => true,
                                   'extensions'             => ['xls', 'xlsx'],
                                   'maxSize'                => 1024 * 1024 * 10,
                                   'enableClientValidation' => false,
                                    'on' => 'export'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'languages'  => Yii::t('admin', 'Languages'),
            'is_rewrite' => Yii::t('app', 'Is rewrite'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->languages = $this->category === 'admin' ? ['ru'] : ['en', 'uk'];
        $this->type_end = $this->category === 'admin' ? 'backend' : 'frontend';
    }

    /**
     * @inheritdoc
     */
    public function import()
    {
        /** @var Message $model */
        $model = Message::getByCategory($this->category);
        /** @var ExcelExchange $excel */
        $excel = new ExcelExchange();
        /** @var ExcelExchange $PHPExcel */
        $PHPExcel = $excel->createExcel($this->type_end);

        // set title columns
        $this->setHeader($PHPExcel);
        // new row
        $PHPExcel->newRow();
        // set value
        foreach ($model as $row) {
            $this->setValue($PHPExcel, $row);
        }
        // set filter
        $this->setFilter($PHPExcel->PHPExcel);
        // set style
        $this->setStyle($PHPExcel->PHPExcel);
        // get file to download
        $PHPExcel->getContentDownload('translations_' . $this->type_end);
    }

    public function export()
    {
        /** @var \PHPExcel_Reader_IReader $objReader */
        $objReader = \PHPExcel_IOFactory::createReader($this->formats[$this->file->extension]);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($this->filePath . $this->fileName);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow();
        //$highestColumn = $objWorksheet->getHighestColumn();
        //$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);

        for ($row = 2; $row <= $highestRow; ++$row) {
            if ($this->category !== $objWorksheet->getCellByColumnAndRow(1, $row)->getValue()) {
                $this->errors[] = Yii::t('admin', 'Incorrect category! Need {need}, given {given}', [
                    'need' => $this->category,
                    'given' => $objWorksheet->getCellByColumnAndRow(1, $row)->getValue()
                ]);
            } else {
                $model = SourceMessage::findOne([
                    'category' => $this->category,
                    'message'  => $objWorksheet->getCellByColumnAndRow(2, $row)->getValue()
                ]);

                if (!$model) {
                    $this->insertTranslation($objWorksheet, $row);
                } else {
                    $this->updateTranslation($objWorksheet, $row, $model);
                }
            }
        }

        unlink($this->filePath . $this->fileName);

        return true;
    }

    /**
     * @return bool
     */
    public function upload()
    {
        $this->filePath = FileHelper::normalizePath(Yii::getAlias('@statics/web/uploads/temp')) . DIRECTORY_SEPARATOR;

        if ($this->validate()) {
            if (!file_exists($this->filePath)) {
                mkdir($this->filePath, 0777, true);
            }

            $this->fileName = md5($this->file->baseName . time()) . '.' . $this->file->extension;
            $this->file->saveAs($this->filePath . $this->fileName);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param ExcelExchange $PHPExcel
     */
    protected function setHeader(ExcelExchange $PHPExcel)
    {
        $PHPExcel->setColumn('ID');
        $PHPExcel->setColumn('Category');
        $PHPExcel->setColumn('Source');

        if ($this->category === 'admin') {
            $PHPExcel->setColumn('Message RU');
        } else {
            $PHPExcel->setColumn('Message EN');
            $PHPExcel->setColumn('Message UA');
        }
    }

    /**
     * @param ExcelExchange $PHPExcel
     * @param Message $row
     */
    protected function setValue(ExcelExchange $PHPExcel, Message $row)
    {
        if ($row->language === 'en') {
            $this->translation_ = $row->translation;
        } else {
            $PHPExcel->setColumn($row->id);
            $PHPExcel->setColumn($row->sourceMessage->category);
            $PHPExcel->setColumn($row->sourceMessage->message);
            $this->category !== 'admin' && $PHPExcel->setColumn($this->translation_);
            $PHPExcel->setColumn($row->translation);
            $PHPExcel->newRow();
        }
    }

    /**
     * @param \PHPExcel $PHPExcel
     */
    protected function setFilter(\PHPExcel $PHPExcel)
    {
        $PHPExcel->getActiveSheet()->setAutoFilter(
            'A1:'
            . $PHPExcel->setActiveSheetIndex(0)->getHighestColumn()
            . $PHPExcel->setActiveSheetIndex(0)->getHighestRow()
        );
    }

    /**
     * @param \PHPExcel $PHPExcel
     */
    protected function setStyle(\PHPExcel $PHPExcel)
    {
        // set auto-size
        foreach(range('A',$PHPExcel->setActiveSheetIndex(0)->getHighestColumn()) as $columnID)
        {
            $PHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // set first row bold
        $PHPExcel->getActiveSheet()->getStyle(
            'A1:'
            . $PHPExcel->setActiveSheetIndex(0)->getHighestColumn()
            . '1'
        )->getFont()->setBold(true);
    }

    /**
     * @param \PHPExcel_Worksheet $objWorksheet
     * @param $row
     * @return bool
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    protected function insertTranslation(\PHPExcel_Worksheet $objWorksheet, $row)
    {
        $transaction = SourceMessage::getDb()->beginTransaction();

        try {
            $sourceMessage = new SourceMessage();
            $sourceMessage->category = $this->category;
            $sourceMessage->message = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
            $sourceMessage->save();

            if ($this->category === 'admin') {
                $message = new Message();
                $message->id = $sourceMessage->id;
                $message->language = 'ru';
                $message->translation = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                $message->save();
            } else {
                foreach ([3 => 'en', 4 => 'uk'] as $index => $lang) {
                    $message = new Message();
                    $message->id = $sourceMessage->id;
                    $message->language = $lang;
                    $message->translation = $objWorksheet->getCellByColumnAndRow($index, $row)->getValue();
                    $message->save();
                }
            }

            $transaction->commit();

            return true;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @param \PHPExcel_Worksheet $objWorksheet
     * @param $row
     * @param SourceMessage $sourceMessage
     * @return bool
     */
    protected function updateTranslation(\PHPExcel_Worksheet $objWorksheet, $row, SourceMessage $sourceMessage)
    {
        foreach ([3 => 'en', 4 => 'uk'] as $index => $lang) {
            foreach ($sourceMessage->messages as $message) {
                if ($message->language === $lang) {
                    if ($message->translation !== $objWorksheet->getCellByColumnAndRow($index, $row)->getValue()) {
                        $message->language = $lang;
                        $message->translation = $objWorksheet->getCellByColumnAndRow($index, $row)->getValue();
                        $this->is_rewrite && $message->save();
                    }
                }
            }
        }

        return true;
    }
}
