<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.07.2015
 * Time: 20:01
 */
abstract class old_mapper
{
    private $params = null;
    private $options = array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL);
    private $query = null;
    private $pdo = null;
    private $prepared = null;
    
    public function __construct($pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function select($records = [])
    {
        $select = 'SELECT ';

        foreach($records as $record)
        {
            $select .= $record.', ';
        }

        $select = trim($select);
        $select = rtrim($select, ',');

        $this->query = $select;

        return $this;
    }

    public function from($tables = [])
    {
        $from = ' FROM ';

        foreach($tables as $table)
        {
            $from .= $table.', ';
        }

        $from = trim($from);
        $from = rtrim($from, ',');

        $this->query .= ' '.$from;
        
        //var_dump($this->query);

        return $this;
    }

    public function where($condition = [])
    {
        $where = ' WHERE ';
        
        //var_dump($condition);

        foreach ($condition as $cond)
        {
            foreach($cond as $key => $val)
            $where .= $key.$val. ' and ';
        }

        $where = trim($where);
        $where = rtrim($where, 'and');

        $this->query .= ' ' . $where;

        return $this;
    }

    public function order_by($col, $cond = 'asc')
    {
        $ord = ' ORDER BY '.$col.' '.$cond;
        $this->query .= $ord;
        return $this;
    }

    public function limit($quantity, $start_row = 0)
    {
        if($start_row == null)
        {
            $start_row = 0;
        }
        $limit = ' LIMIT '.$start_row.','.$quantity;
        $this->query .= $limit;
        return $this;
    }

    public function insert($table, $columns = [])
    {
        $insert = 'INSERT INTO ';
        $this->query .= $insert.$table;

        $col = '(';

        foreach($columns as $column)
        {
            $col .= $column.', ';
        }

        $col = trim($col);
        $col = rtrim($col, ',');
        $col .= ')';

        $this->query .= $col.' ';

        return $this;
    }

    public function  values($values = [])
    {
        //var_dump($values);
        
        $v = 'VALUES';
        $this->query .= $v;

        $val = '(';

        foreach($values as $value)
        {
            $val .= $value.', ';
        }

        $val = trim($val);
        $val = rtrim($val, ',');
        $val .= ')';

        $this->query .= $val;

        return $this;
    }
    
    public function delete()
    {
        $this->query .= 'DELETE ';
        
        return $this;
    }
    
    public function update($table)
    {
        $this->query .= 'UPDATE '.$table;
        
        return $this;
    }
    
    public function set($data = [])
    {
        $set = ' SET ';
       
        
        //var_dump($data);

        foreach ($data as $d)
        {
            foreach($d as $key => $val)
            $set .= $key.$val. ' , ';
        }

        $set = trim($set);
        $set = rtrim($set, ',');
        
        //var_dump($set);

        $this->query .= ' ' . $set;

        return $this;
    }

    public function echoquery()
    {
        return $this->query;
    }

    public function prepare($options = null)
    {        
        if($this->pdo == null)
        {
            return null;
        }

        if($options != null)
        {
            $this->options = $options;
        }

        $this->prepared = $this->pdo->prepare($this->query, $this->options);
            //var_dump($this->prepared);
            //var_dump($this->query);

        return $this;

        //echo $this->query;
    }
    
    public function bind_param($param, $val, $pdo_param)
    {
        
    }

    public function execute($params = null, $select = true)
    {
        
        if($select === false)
        {
            $this->pdo->beginTransaction();

            //var_dump($this->prepared->execute($params));

            if(!$this->prepared->execute($params))
            {
                $this->pdo->rollBack();
                messages::set_message('30', 'alert-danger');
            }
            $this->pdo->commit();
        }
        else
        {
            if($this->prepared != null)
            {
                $this->prepared->execute($params);
                
            }
            else
            {
                $this->prepared = null;
                messages::set_message('30', 'alert-danger');  
            }
        }
        $this->query = null;
        return $this;
    }

    public function get_result()
    {
        //var_dump($this->prepared->fetchAll(PDO::FETCH_NAMED));
        if(!is_null($this->prepared))
        {
            return  $this->prepared->fetchAll(PDO::FETCH_NAMED);
        }
        messages::set_message('30', 'alert-danger'); 
        return null;
    }
    
    public function get_result_one()
    {
       return  $this->prepared->fetchAll(PDO::FETCH_NAMED);
    }


//    /* Сделать метод для одной строки */
//    public function get_res($model)
//    {
//        $model_arr = [];
//
//        foreach($this->prepared->fetchAll(PDO::FETCH_NAMED) as $arr)
//        {
//            //$model = new user_model();
//            foreach($arr as $key => $val)
//            {
//                $model[$key] = $val;
//            }
//
//            array_push($model_arr, $model);
//        }
//
//        //var_dump($model_arr);
//        return $model_arr;
//    }
//
//    public function get_res_one($model)
//    {
//        //$model_arr = [];
//
//        $model = new user_model();
//
//        foreach($this->prepared->fetchAll(PDO::FETCH_NAMED) as $arr)
//        {
//
//            foreach($arr as $key => $val)
//            {
//                //echo $key.'======>'.$val;
//                $model[$key] = $val;
//            }
//
//            //array_push($model_arr, $model);
//
//        }
//
//        return $model[0];
//    }

    function clear()
    {
        $this->params = null;
        $this->query = null;
        $this->pdo = null;
        $this->prepared = null;
    }


}