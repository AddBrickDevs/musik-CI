<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends MY_Controller {

	public function __construct(){
		parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
	}

	public function login()
    {


		$this->load->library('facebooklogin');                 
		$user = $this->facebooklogin->getUser();        
        if ($user) {
            try {
                $user_profile = $this->facebooklogin->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;                
            }
        }else {
            $this->facebooklogin->destroySession();            
        }
        if ($user) {
            // Verificamos si existe
            $exist          = $this->admin->getTable('users',array('idfacebook' => $user_profile['id']));
            if($exist->num_rows() == 0)
                $exist          = $this->admin->getTable('users',array('username' => $user_profile['email']));
            
            $DATA['idfacebook']  = $user_profile['id'];            
            $DATA['names']  = $user_profile['name'];
            $DATA['avatar'] = 'https://graph.facebook.com/'.$user_profile['id'].'/picture?type=large';
            if($exist->num_rows() > 0)
            {
                if($user_profile['email'] != '')
                    $DATA['username']  = $user_profile['email'];     
                if($user_profile['email'] == '')                
                    $user_profile['email'] =     $user_profile['id'].'@facebook.com';                

                if($user_profile['email'] == '') 
                    $this->admin->updateTable('users',$DATA,array('idfacebook' => $user_profile['id']));                                  
                else
                    $this->admin->updateTable('users',$DATA,array('username' => $user_profile['email']));                                  
                
                $data = $exist->result_array();                                       
                $data[0]['facebook'] = '1';
                $this->session->set_userdata($data[0]);
                redirect(base_url());
            }
            else
            {
                
                if($user_profile['email'] == '')
                {
                    $user_profile['email'] =     $user_profile['id'].'@facebook.com';
                }                
                if($user_profile['email'] != '')
                {
                    $DATA['username']  = $user_profile['email'];    
                    $DATA['password']   = sha1(rand(99999,999999999).date('Y-m-d H:i:s'));
                    $DATA['avatar']     = 'https://graph.facebook.com/'.$user_profile['id'].'/picture?type=large';
                    $nickname           = explode("@", $user_profile['email']);
                    $DATA['nickname']   = str_ireplace(".", "_", $nickname[0]);                    
                    $this->admin->setTable('users',$DATA);                                  
                    $exist              = $this->admin->getTable('users',array('idfacebook' => $user_profile['id']));
                    $data               = $exist->result_array();                                       
                    $data[0]['facebook']= '1';
                    $this->session->set_userdata($data[0]);    
                }
                redirect(base_url());
            }           
            
        } else {
            $data['login_url'] = $this->facebooklogin->getLoginUrl(array('redirect_uri' => base_url().'music/facebook/login','scope' => array("email") ));
            redirect( $data['login_url']);
        }        
        

	}

    public function logout(){

        $this->load->library('facebooklogin');
        $this->facebooklogin->destroySession();
        redirect(base_url());
    }

}
