<?php
if ( ! function_exists('base_url_static'))
{
        function base_url_static()
        {
                $CI =& get_instance();
                return $CI->config->slash_item('base_url_static');
        }
}

if ( ! function_exists('base_url_static_f'))
{
	function base_url_static_f()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url_static_f');
	}
}

if ( ! function_exists('base_url_static_b'))
{
	function base_url_static_b()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url_static_b');
	}
}
if ( ! function_exists('echo_anti_wysiwig'))
{
    function echo_anti_wysiwig($text=NULL, $limit=NULL)
    {
        $text = strip_tags($text); 
        return substr($text,0,$limit);
    }
}
if ( ! function_exists('script_tag_backend'))
{
	function script_tag_backend($script=NULL, $url=NULL)
	{
		$obj =& get_instance();
		if ($script === NULL)
			return FALSE;

		if ($url === NULL)
			$url = base_url_static().'backend/js';

		$html = "<script src=\"{$url}/{$script}\" type=\"text/javascript\"></script>\n";
		return $html;
	}
}

function script_tag($script=NULL, $url=NULL)
{
	$obj =& get_instance();
	if ($script === NULL)
		return FALSE;

	if ($url === NULL)
		$url = base_url_static_f().'js';

	$html = "<script src=\"{$url}/{$script}.js\" type=\"text/javascript\"></script>\n";
	return $html;
}

if ( ! function_exists('printame_input_text'))
{
    function printame_input_text($name=NULL, $value=NULL, $label=NULL, $validacion=NULL)
    {
        $html="
        	<section>
        		<label>$label</label>
        		<div><input type=\"text\" name=\"$name\" id=\"id_$name\" class=\"text\" value=\"$value\"";
        $html.=($validacion=="required")?"required":"";
        $html.="></div>
        	</section>";

         return $html;
    }
}
if ( ! function_exists('printame_input_password'))
{
    function printame_input_password($name=NULL, $value=NULL, $label=NULL, $validacion=NULL)
    {
        $html="<section><label for=\"$name\">$label</label>
							<div><textarea id=\"textarea_auto\" name=\"$name\" data-autogrow=\"true\" ".($validacion=="required")?"required":""."></textarea>
								
							</div>
					</section>";
         return $html;
    }
}
if ( ! function_exists('printame_input_checkbox'))
{
    function printame_input_checkbox($name=NULL, $value=NULL, $label=NULL, $validacion=NULL)
    {
        $checked = (!empty($value))? " checked=\"checked\"" : "";
        if($validacion=="required"){ $html.="<span class=\"required\">*</span>"; }
        $html="
        <div class=\"form-checkbox-item clear\">
			<input type=\"checkbox\" class=\"checkbox fl-space $validacion\" name=\"$name\" id=\"checkbox$name\" rel=\"checkboxvert\"  $checked> <label class=\"fl\" for=\"checkbox$name\">$label </label>
		</div> ";
       
         return $html;
    }
}


if ( ! function_exists('printame_input_textarea'))
{
    function printame_input_textarea($name=NULL, $value=NULL,$label=NULL,$validacion=NULL)
    {
    
         $html="<section><label for=\"$name\">$label</label>
							<div><textarea id=\"textarea_auto\" name=\"$name\" data-autogrow=\"true\" ";
         $html.=($validacion=="required")?"required":"";
         $html.=">$value</textarea>
								
							</div>
					</section>";
         return $html;
    }
}

if ( ! function_exists('printame_input_wysiwig'))
{
    function printame_input_wysiwig($name=NULL, $value=NULL,$label=NULL,$validacion=NULL)
    {
    
        $html="
        <section>
        	<label for=\"textarea_auto\">$label<br></label>
				<div><textarea id=\"textarea_wysiwyg\" name=\"$name\" class=\"html\" rows=\"12\">$value</textarea></div>
		</section>
        ";
       return $html;
    }
}
if ( ! function_exists('printame_input_select'))
{
    function printame_input_select($name=NULL, $arr_select=NULL,$value=NULL,$label=NULL,$validacion=NULL)
    {

        $html="
        <section>
			<label for=\"dropdown\">$label</label>
			<div>		
			";
            if(count($arr_select)	== 0 )	{ $html.="No existen datos asociados"; } else 
            {
                $html.="
    			<select name=\"$name\" id=\"dropdown\" ";
    			
                $html.= ($validacion=="required")? "required>" :">";
    
                foreach($arr_select AS $option)
                {
                    if($option['value'] == $value) $selected = " selected=\"selected\""; else $selected="";
                
                    $html.="<option value=\"".$option['value']."\" $selected>".$option['option']."</option>";
                }
                $html.="</select>";
            }
         $html.="  </div>
		</section>";

        return $html;
        
    }
}
if ( ! function_exists('printame_examinar'))
{
    function printame_examinar($name=NULL,$label=NULL,$span=NULL)
    {
        $html="
			<section><label for=\"file_upload_$name\">$label<br><span>$span</span></label>
				<div><input type=\"file\" id=\"file_upload\" name=\"$name\" ";
        $html.=($validacion=="required")?"required":"";
        $html.=    "></div>
		</section>";
        

        return $html;
        
    }
}
if ( ! function_exists('printame_value'))
{
    function printame_value($post=NULL, $datos_bbdd=NULL,$tag=null,$type="text",$value_esperado=null)
    {

        if(isset($datos_bbdd)&&(!empty($datos_bbdd["$tag"]))) 
        {
            switch($type)
            {
                case "text":
                     return $datos_bbdd["$tag"];
                break;
                case "select":
                    if($value_esperado == $datos_bbdd["$tag"])
                         return " selected";
                break;
                case "check":
                    if($value_esperado == $datos_bbdd["$tag"])
                         return " checked='checked'";
                break;
            }
        }

        if(isset($post)&&(!empty($post["$tag"]))) 
        {
            switch($type)
            {
                case "text":
                     return $post["$tag"];
                break;
                case "select":
                    
                     if($value_esperado == $post["$tag"])
                         return " selected";
                break;
                case "check":
                    if($value_esperado == $post["$tag"])
                         return " checked='checked'";
                break;
            }
           
        }            
        return "";
    }

}
?>
