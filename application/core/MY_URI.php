<?php

class MY_URI extends CI_URI
{
  public function filter_uri(&$str)
	{
		if ( ! empty($str) && ! empty($this->_permitted_uri_chars) && ! preg_match('/^['.$this->_permitted_uri_chars.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $str))
		{
			show_error('URL yang anda submit memiliki karakter yang tidak diijinkan.', 400);
		}
	}


}
