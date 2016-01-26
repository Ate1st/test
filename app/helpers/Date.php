<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Date
 *
 * @author vasilyevab
 */
class Date 
{
    private $date = null;
    
    public function setDate($y, $m, $d)
    {
        if(checkdate((int)$m, (int)$d, (int)$y))
        {
            $this->date = new DateTime($y.'-'.$m.'-'.$d);
        }
        else
        {
            $this->date = new DateTime('0000-00-00');
        }
    }
    
    public function setDateFromStr($date)
    {
        if(is_null($date) || $date == 0)
        {
            $this->date = new DateTime('0000-00-00');
        }
        $this->date = new DateTime($date);
    }
    
    public function modifyDate($days)
    {
        $this->date = $this->date->add(DateInterval::createFromDateString($days.' days'));
    }
    
    public function getDateStr()
    {
        return $this->date->format('d-m-Y');
    }
    
    public function getDateForDB()
    {
        return $this->date->format('Y-m-d');
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getDay()
    {
        return $this->date->format('d');
    }
    
    public function getMonth()
    {
        return $this->date->format('m');
    }
    
    public function getYear()
    {
        return $this->date->format('Y');
    }

        //если $date < $this->date - true иначе false
    public function diff(DateTime $date)
    {
        $interval = $this->date->diff($date);
        //echo '----+'.(int)$interval->format('%R%a').'----';
        //echo '===='.(int)$int.'====';
        
        $int3 = (int)$interval->format('%R%a');
        //$int4 = (int)$int;
        
        //echo '---diff==='.$int3.'===';
        //echo '+++int==='.$int4.'+++';
        
        if($int3 > 0)
        {
            return true;
        }
        return false;
    }
}
