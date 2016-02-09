<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mapper
 *
 * @author vasilyevab
 */

abstract class mapper
{  
    protected $pdo = null;
    protected $query_builder = null;
    private $options = array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL);
    private $prepared = null;
    protected $model = null;
    protected $result = null;
    protected $model_array = [];


    public function __construct(query_builder $query_builder, PDO $pdo, IModel $model)
    {
        $this->pdo = $pdo;
        $this->query_builder = $query_builder;
        $this->model = $model;
    }
    
    public function setModel(IModel $model)
    {
        $this->model = $model;
    }
    
    public function setQueryBuilder(query_builder $query_builder)
    {
        $this->query_builder = $query_builder;
        
        //var_dump($query_builder);
    }

    public function get_query_builder()
    {
        return $this->query_builder;
    }

    public function prepare($params, $options = null)
    {    
        if($options != null)
        {
            $this->options = $options;
        }
        $this->prepared = $this->pdo->prepare($this->query_builder->get_query(), $this->options);
          
        //var_dump($this->prepared);
        //var_dump($this->query_builder);
        
        $this->prepared->execute($params);
        $this->result = $this->prepared->fetchAll(PDO::FETCH_NAMED);
        
        return $this;
    }
    
    public function set($params, $options = null)
    {
        var_dump($params);
        
        $last_id = 0;
        
        if($options != null)
        {
            $this->options = $options;
        }
        $this->prepared = $this->pdo->prepare($this->query_builder->get_query(), $this->options);
        $this->pdo->beginTransaction();
        
            if(!$this->prepared->execute($params))
            {
                $this->pdo->rollBack();
                messages::set_message('30', 'alert-danger');
                return $last_id;
            }
            
            $last_id = $this->pdo->lastInsertId();
            
        $this->pdo->commit();
        
        return $last_id;
    }

    protected function get()
    {             
        $m = $this->model;
        
        //var_dump($this->result);
        
        foreach ($this->result as $key => $val)
        {
            $this->model_array[$key] = $m::create()->set($val);
        }
        
        return $this->model_array;
    }
    
    protected function get_one()
    {
        $m = $this->model;
        
        //var_dump($this->result);
        
        $arr = [];
        
        $this->model_array = [];
        
        //var_dump($this->result);
        
        foreach ($this->result as $key => $val)
        {
            //var_dump($val);
            $mod = null;
            $mod = $m::create()->set($val);
            //var_dump($mod);
            $this->model_array[$key] = $mod;
        }
        //var_dump('--------------------------------', $arr, '---------------------------------------');
        
        //var_dump($this->model_array);
        
        if(!empty($this->model_array[0]))
        {
            //var_dump($this->model);
            return $this->model_array[0];
        }

        return $this->model;
    }
    
    public function getArray()
    {
        $res = [];
        $tmp = [];
        
        foreach ($this->result as $val)
        {
            foreach ($val as $k => $v)
            {
                array_push($tmp, $v);
                $res[$k] = $tmp;
            }
        }
        
        return $res;
    }

        public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    
    
}
