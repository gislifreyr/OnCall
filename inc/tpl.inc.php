<?
class tpl
{
    var $vars = array();
    var $path = "./tpl/";

    function tpl($path = null, $vars = null)
    {
        if ($path)
            $this->path = $path;
        if ($vars)
            $this->vars = $vars;
    }

    function set_var($name, $value)
    {
        if (is_array($value))
            return $this->set_array($name,$value);
        $this->vars[$name] = $value;
    }

    function set_array($name, $value)
    {
	$cnt = count($value);
        for ($i = 0; $i < $cnt; $i++)
            $this->vars[$name."[".$i."]"] = $value[$i];
    }

    function clear_vars()
    {
        $this->vars = array();
    }

    function load_vars($vars)
    {
        foreach ($vars as $key => $val)
            $this->vars[$key] = $val;
    }
    
    function parse_imports($str)
    {
        if (is_array($str))
            $str = file_get_contents($this->path.$str[1]);
            
        return preg_replace_callback("/@import\(([^\s]+)\);?/", array($this, "parse_imports"), $str);
    }

    function _process($str)
    {
        $x = $this->parse_imports($str);
        return @preg_replace("/%([^\s\"]+)%/e", "\$this->vars[\"\\1\"]", $x);
    }

    function process($tpl)
    {
        $x = file_get_contents($this->path.$tpl);
        return $this->_process($x);
    }

    function display($tpl)
    {
        print $this->process($tpl);
    }
}
?>
