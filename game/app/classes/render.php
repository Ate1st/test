<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.07.2015
 * Time: 19:22
 */
class render 
{
    private static $main_tpl = null;
    private static $content = [];
    private static $message;

    public static function rend()
    {
        echo self::$main_tpl;
    }
    
    public static function add_message($key, $value)
    {
        ob_start();
        echo '<div class="message_'.$value.'">';
        echo message_mapper::$messages[$key];
        echo '</div>';
        echo '<p>';
        self::$message .= ob_get_clean();
    }
    
    public static function get_message()
    {
        $res = self::$message;
        self::$message = '';
        
        return $res;
    }

    public static function add_content($content_id, $content_name)
    {
        ob_start();

        if(file_exists(config::get_config('tpl_config')['bloks_folder'].'/'.$content_name.'.php')) {

            require config::get_config('tpl_config')['bloks_folder']. '/' . $content_name . '.php';
        }
        else
        {
            messages::set_message('20', 'alert-danger');
        }

        self::$content[$content_id] = ob_get_contents();

        ob_end_clean();
    }

    public static function get_main_tpl($name = null)
    {
        ob_start();
        
        if($name == NULL)
        {
            require config::get_config('tpl_config')['index'];
        }
        else 
        {
            require config::get_config('tpl_config')[$name];
        }

        self::$main_tpl = ob_get_contents();

        ob_end_clean();
        
    }

    public static function get_content($content_id)
    {
        if(isset(self::$content[$content_id]))
        {
            return self::$content[$content_id];
        }
        return null;
    }

    public static function add_css($css_id, $css_name)
    {

        if(file_exists(config::get()->_get('DEFAULT_CSS_FOLDER').'/'.$css_name.'.css'))
        {
            $file_path = str_replace(config::get()->_get('APP_ROOT'), '', config::get()->_get('DEFAULT_CSS_FOLDER'));

            self::$content[$css_id] = '<link rel="stylesheet" type="text/css"
            href="'.$file_path.'/'.$css_name.'.css">';
        }
        else
        {
            echo '  --file '.config::get()->_get('DEFAULT_CSS_FOLDER').'/'.$css_name.'.css'.' not found--  ';
        }
    }

    public static function get_css($css_id)
    {
        if(isset(self::$content[$css_id]))
        {
            return self::$content[$css_id];
        }
        return null;
    }

    public static function add_js($js_id, $js_name)
    {

        if(file_exists(config::get()->_get('DEFAULT_JS_FOLDER').'/'.$js_name.'.js'))
        {
            $file_path = str_replace(config::get()->_get('APP_ROOT'), '', config::get()->_get('DEFAULT_JS_FOLDER'));
            $this->content[$js_id] = '<script src="'.$file_path.'/'.$js_name.'.js"></script>';
        }
        else
        {
            echo '  --file '.config::get()->_get('DEFAULT_JS_FOLDER').'/'.$js_name.'.js'.' not found--  ';
        }
    }

    public static function add_js_from_arr($js_arr = [])
    {
        if(is_array($js_arr))
        {
            if(!empty($js_arr))
            {
                foreach($js_arr as $key => $val)
                {
                    self::$add_js($key, $val);
                }
            }
        }
    }

    public static function add_css_from_arr($css_arr = [])
    {
        if(is_array($css_arr))
        {
            if(!empty($css_arr))
            {
                foreach($css_arr as $key => $val)
                {
                    self::$add_css($key, $val);
                }
            }
        }
    }

    public static function get_js($js_id)
    {
        if(isset(self::$content[$js_id]))
        {
            return self::$content[$js_id];
        }
        return null;
    }

    public static function get_val($val_id)
    {
        if(isset(self::$content[$val_id]))
        {
            return self::$content[$val_id];
        }
        return null;
    }

    public static function add_val($val_id, $val)
    {
        self::$content[$val_id] = $val;
    }

    public static function get_all()
    {
        return self::$content;
    }

//config::get()->_get('DEFAULT_CSS_FOLDER').'/'.

}