<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phpexcel_block_class
 *
 * @author User
 */
class phpexcel_block_class extends block
{
    public static function getBlock()
    {
        
        session::start();
        $block_path = __DIR__.'/block/';
        $block_name = str_replace('_class', '', __CLASS__).'.php';
        self::$block_name = $block_name;
        self::$blocks[$block_name] = ['name' => $block_name, 'path' => $block_path]; 
        
        
        // Create new PHPExcel object
        $xls = new PHPExcel();
        // Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();
        // Подписываем лист
        $sheet->setTitle('Таблица умножения');

        // Вставляем текст в ячейку A1
        $sheet->setCellValue("A1", 'Таблица умножения');
        $sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

        // Объединяем ячейки
        $sheet->mergeCells('A1:H1');

        // Выравнивание текста
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
             PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        for ($i = 2; $i < 10; $i++) {
                for ($j = 2; $j < 10; $j++) {
                // Выводим таблицу умножения
                $sheet->setCellValueByColumnAndRow(
                                          $i - 2,
                                          $j,
                                          $i . "x" .$j . "=" . ($i*$j));
                // Применяем выравнивание
	    $sheet->getStyleByColumnAndRow($i - 2, $j)->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
        }
            
        
        //Сохранение листа excel в PDF рабочий вариант
        //1. скачать tcpdf, распаковать в classes
        //2. в PHPExcel/Settings строка 49 заменить tcPDF на tcpdf
        //3. далее работающий код

        $rendererLibrary = 'tcpdf';
        $rendererLibraryPath = 'app/classes/' . $rendererLibrary;
        PHPExcel_Settings::setPdfRenderer('tcpdf', $rendererLibraryPath); 

        
            $path = 'files/asdfg1_'.date('i').'_'.date('s').'.pdf';
            $objWriter = new PHPExcel_Writer_PDF($xls);
            $objWriter = PHPExcel_IOFactory::createWriter($xls, 'PDF'); 
            $objWriter->setSheetIndex(0);
            $objWriter->save($path);

            self::$values['path'] = $path;
            //echo 
        //controller::call('/main/get_pdf', ['params' => ['path' => 'files/asdfg1.pdf']]);    
            
        return self::show();
    }
}
