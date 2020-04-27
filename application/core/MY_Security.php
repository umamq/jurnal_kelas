<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Security extends CI_Security
{

  public function csrf_show_error()
	{
		show_error('Aksi yang anda minta tidak diijinkan.', 403);    
	}
}
