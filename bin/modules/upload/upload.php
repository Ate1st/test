<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author vasilyevab
 */
class upload 
{
    //$h, $w - высота и ширина файла
    
    private $uploaddir = null;
    private $uploadpath = null;
    private $uploadfile = null;
    private $filename = null;
    private $filenewname = null;
    private $tmpfilename = null;
    private $h = 140;
    private $w = 140;

    
    //$name1 - часть имени файля для хеширования
    //$save_path - путь к папке для сохранения файлов (без слешей снаружи)
    
    public function __construct($name1, $save_path)
    {
        $this->uploaddir = '/'.$save_path.'/';
        $this->uploadpath = $_SERVER['DOCUMENT_ROOT'].$this->uploaddir;
        $this->filename = $_FILES['file_name']['name'];
        $this->filenewname = md5($name1.$this->filename).substr($this->filename, strlen($this->filename) - 4);
        $this->uploadfile = $this->uploadpath.$this->filenewname;  
        $this->tmpfilename = $_FILES['file_name']['tmp_name'];
    }
    
    public function setParams($h, $w)
    {
        $this->h = $h;
        $this->w = $w;
    }
    
    public function start()
    {
        //var_dump($this->filename, $this->uploadfile);
        
        if (move_uploaded_file($this->tmpfilename, $this->uploadfile))
        {
            $img = new Imagick($this->uploadfile);
            $img->resizeimage($this->h, $this->w, Imagick::FILTER_LANCZOS, 1);
            $img->writeimage($this->uploadfile);
            $img->destroy();
            
            return $this->uploaddir.$this->filenewname;
        } 
        
        //echo 'not found';
        
        return false;
    }
}
