<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Breadcrumbs Class
 *
 * This class manages the breadcrumb object
 *
 * @package		Breadcrumb
 * @version		1.0
 * @author 		Buti <buti@nobuti.com>
 * @copyright 	Copyright (c) 2012, Buti
 * @link		https://github.com/nobuti/codeigniter-breadcrumb
 */
class Breadcrumbs {

	/**
	 * Breadcrumbs stack
	 *
     */
	private $breadcrumbs = array();

	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct()
	{
		log_message('debug', "Breadcrumbs Class Initialized");
	}

	public function load_config($config){
		$this->ci =& get_instance();
		// Load config file
		$this->ci->load->config('breadcrumbs');

		// Get breadcrumbs display options
		$this->tag_open = $this->ci->config->item('tag_open',$config);
		$this->tag_close = $this->ci->config->item('tag_close',$config);

		$this->crumb_divider = $this->ci->config->item('crumb_divider',$config);

		$this->crumb_open = $this->ci->config->item('crumb_open',$config);
		$this->crumb_close = $this->ci->config->item('crumb_close',$config);

		$this->crumb_first_open = $this->ci->config->item('crumb_first_open',$config);
		$this->crumb_first_close = $this->ci->config->item('crumb_first_close',$config);

		$this->crumb_last_open = $this->ci->config->item('crumb_last_open',$config);
		$this->crumb_last_close = $this->ci->config->item('crumb_last_close',$config);

	}

	// --------------------------------------------------------------------

	/**
	 * Append crumb to stack
	 *
	 * @access	public
	 * @param	string $page
	 * @param	string $href
	 * @return	void
	 */
	function push($page, $href, $base = false)
	{
		// no page or href provided
		if (!$page OR !$href) return;

		// Prepend site url
		if($base === false)
		{
			$href = base_url($href);
		}
		else
		{
			$href = site_url($href);
		}

		// push breadcrumb
		array_push($this->breadcrumbs, array('page' => $page, 'href' => $href));
	}

	// --------------------------------------------------------------------

	/**
	 * Prepend crumb to stack
	 *
	 * @access	public
	 * @param	string $page
	 * @param	string $href
	 * @return	void
	 */
	function unshift($page, $href, $base = false)
	{
		// no crumb provided
		if (!$page OR !$href) return;

		// Prepend site url
		if($base === false)
		{
			$href = base_url($href);
		}
		else
		{
			$href = site_url($href);
		}

		// add at firts
		array_unshift($this->breadcrumbs, array('page' => $page, 'href' => $href));
	}

	// --------------------------------------------------------------------

	/**
	 * Generate breadcrumb
	 *
	 * @access	public
	 * @return	string
	 */
	function show()
	{
		if ($this->breadcrumbs) {

			// set output variable
			$output = $this->tag_open;

			// construct output
			foreach ($this->breadcrumbs as $key => $crumb) {
				$keys = array_keys($this->breadcrumbs);
				if (end($keys) == $key) {
					$output .= $this->crumb_last_open . '' . $crumb['page'] . '' . $this->crumb_last_close;
				}else {
					if ($key == 0) {
						$output .= $this->crumb_first_open.'<a href="' . $crumb['href'] . '">' . $crumb['page'] . '</a>'.$this->crumb_divider.$this->crumb_first_close;
					}else{
						$output .= $this->crumb_open.'<a href="' . $crumb['href'] . '">' . $crumb['page'] . '</a>'.$this->crumb_divider.$this->crumb_close;
					}
				}
			}

			// return output
			return $output . $this->tag_close . PHP_EOL;
		}

		// no crumbs
		return '';
	}

}
// END Breadcrumbs Class

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */
