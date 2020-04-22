<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Alert Helpers For Alert Library.
 *
 * @category	Helpers
 *
 * @author		Twitter: @d_nizh / Facebook: /dna1993
 *
 * @link		https://github.com/dnizh93/codeigniter-alert
 */

 /* Controller

      public function index()
      {
      	if(!auth_check('member')){

      		// Alert will show after redirect
      		$this->alert->set('alert-danger', 'Orang asing dilarang masuk!');
      		redirect(base_url('auth/login'));
      	}

      	redirect(base_url());
      }

      public function login()
      {
      	if($this->input->post('do_login') AND !$this->do_login()){

      		// This is not for next request
      		$this->alert->set('alert-danger', 'Login gagal!', true);
      	}

      	$this->load->view('login');
      }


    Views
    <?php if(has_alert()):
    	foreach(has_alert() as $type => $message): ?>
    		<div class="alert alert-dismissible <?php echo $type; ?>">
    			<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    			<?php echo $message; ?>
    		</div>
    	<?php endforeach;
    endif; ?>
*/

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('has_alert')) {
    function has_alert($type = '')
    {
        $CI = &get_instance();
        $alerts = $CI->alert->has_alert($type);

        if (!empty($alerts)) {
            return $alerts;
        }

        return false;
    }
}
