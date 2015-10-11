<?php

class MY_Controller extends CI_Controller
{

	private $dblabg =  array();
	public function __construct()
	{		
		parent::__construct();		

		
		if($this->config->item("use_database") == 1)
		{			
			$this->load->database();
			$this->load->model("dashboard/admin");								
			$this->set_config();	
			if($this->config->item("module_user_online") == 1 )
			{		
				$this->set_online();		
			}

		}
		$this->set_lang();
		$this->clean_cache();

		if($this->router->fetch_module() == 'dashboard')
		{			
			$this->__dashboard();
		}

				
		
	}
	protected function set_lang()
	{		
		if($this->config->item("user_change_lang") == "1")
        {        	
    	   	if($this->input->get("lang"))
	        {	        	
	        	if(in_array($this->input->get("lang"),$this->config->item("langs_available")) || $this->config->item("use_db_language") == '1')
	        	{	        		
	        		$this->config->set_item("lang",$this->input->get("lang"));
	        		$this->session->set_userdata('lang', $this->input->get("lang"));
	        	}
	        }
	        else
	        {
	        	if($this->session->userdata('lang') != '')
	        	{
	        		$this->config->set_item("lang",$this->session->userdata('lang'));
	        	}
	        	else
	        	{
	        		if($this->config->item("language_browser") == '1' )
	        		{
		        		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		        		$temp = $this->admin->getTable('languages',array("iso" => $lang));
		        		
		        		if($temp->num_rows()>0 && $this->config->item("language_browser") == '1' && $this->router->fetch_module() != 'dashboard')
		        		{
		        			$d = $temp->row();
		        			$this->config->set_item("lang",$d->language);
		        		}
		        	}	        		
	        		
	        	}
	        }	        
        }
        if($this->config->item("use_db_language") == '1')
        {        	
        	$this->load_db_language($this->config->item("lang"));
        }
        else
        	$this->lang->load($this->config->item("lang"),$this->config->item("lang"));     	

	}

	public function load_db_language($lang = 'english')
	{



        $this->db->select   ('*');
        $this->db->from     ('language');
        $this->db->where    ('language', $lang);        

        $query = $this->db->get()->result();
        foreach ( $query as $row )        
        {
            $return[$row->key] = $row->text;
            
        }

        $this->dblabg = $return;


        $this->db->select   ('*');
        $this->db->order_by("language"); 
        $this->db->from     ('languages');        
        $query = $this->db->get()->result();
        $return = array();
        foreach ( $query as $row )        
        {  
            $return[$row->language] = $row->language;
        }        

        $this->config->set_item("langs_available", $return);				

        unset($query,$return);
	}


	public function get_label($key)
	{
		return  $this->dblabg[$key];
	}

	protected function clean_cache()
	{
		if(exec('echo EXEC') == 'EXEC')
		{
			if($this->config->item("clean_cache") != '0')
			{				
				exec("find  ".getcwd()." -type f -name '*.cache' -mtime +".$this->config->item("clean_cache")." -exec rm {} \;");					
			}
			
		}
	}

	protected function set_online()
	{
		$this->admin->setUsuarioOnline(intval($this->session->userdata('id')));
	}
	protected function set_config()
	{		

		$config 	= $this->admin->getTable("settings");		
		if($config->num_rows() == 0)
		{
			show_error("No settings founds in your database, you need install this script on clean database",400);
		}
		foreach ($config->result_array() as $row)
		{
			
			if($row['var'] != 'use_database')
			{
				if($row['var'] == 'langs_available')
				{

				    $this->load->helper('directory');
				    $langs = directory_map('./application/language');
				    foreach ($langs as $key => $value) {
				    	 $temp[] = $key;				    	
				    }				    
					$row['value'] = $temp;					 
				}								
				if($row['var'] == 'theme')
				{
					if($_GET['skin'])
					{
						$row['value'] = $_GET['skin'];
					}
				}
				if(!is_array($row['value']))
				{
					//$row['value'] = str_ireplace('"', "'",$row['value']);
					$row['value'] = str_ireplace('\"', '"',$row['value']);
					$row['value'] = str_ireplace("\'", "'",$row['value']);
					$row['value'] = html_entity_decode($row['value']);	
					
				}
				
				$this->config->set_item($row['var'], $row['value']);	

				
				if($this->agent->is_mobile())
				{					
					$this->config->set_item("theme", $this->config->item("theme_mobile"));														
				}
			}
			
		}

		if($this->agent->is_mobile())
		{			
			if($this->config->item("mobile_redirect") != '')				
				redirect($this->config->item("mobile_redirect"), 'location', 301);
		}

		if(is_logged())
		{
			$this->config->set_item("biography_lang_temp",$this->config->item("biography_lang"));						
			$this->config->set_item("biography_lang", $this->session->userdata('biography_lang'));						
		}		
			
		

		

		   $config = Array(
        		'protocol' => 'smtp',
        		'smtp_host' => $this->config->item("smtp_host"),
        		'smtp_port' => $this->config->item("smtp_port"),
        		'smtp_user' => $this->config->item("smtp_user"), // change it to yours
        		'smtp_pass' => $this->config->item("smtp_pass"), // change it to yours
        		'mailtype' => 'html',
        		'charset' => 'utf-8',
        		'wordwrap' => TRUE,
        		'newline' => "\r\n"
    	);
		$this->load->library('email',$config);	
	}

	protected function __dashboard()
	{		
		if($this->config->item("use_database") == 0)
		{
			show_404();	
		}
		if(!is_logged() && $this->router->method != 'login'  && $this->router->method != 'logout' )
		{
			redirect(base_url()."dashboard/login");
		}			
		if($this->session->userdata('is_admin') != 1 && $this->router->method != 'login')
		{
			//redirect(base_url(),"refresh");
			redirect(base_url()."dashboard/login");
		}
		else{
			if($this->session->userdata('username') == 'demo@jodacame.com' && $this->router->method != 'login')
			{
				if($this->router->method == 'website')
				{
					$this->config->set_item("lastfm", 'lastfmdemomodeapikey');			
				}
				if($_POST || $this->router->method == 'smtp' || $this->router->method == 'license' || $this->router->method =='users'  || $this->router->method =='lyrics'  ||  $this->router->method == 'newsletter' )
				{
					show_error("Demo Account don't have permission for this action",403);
				}
					
			}
			// Upgrade            
			if(file_exists("upgrade/upgrade.sql"))
			{
				$MD5 = md5_file("upgrade/upgrade.sql");
				if($this->config->item("md5updated") != $MD5)
				{
					$sql 	= file_get_contents("upgrade/upgrade.sql");
					$sqls 	= explode(";\n",$sql);
					foreach ($sqls as $key => $value) {								
						if($value != '')
						{
							$this->db->query($value);
							//echo $this->db->last_query()."<br>";	
						}						
					}				
					$this->db->query("UPDATE settings SET value = '$MD5' WHERE var='md5updated';");					
					$this->session->sess_destroy();					
					//echo $this->db->last_query()."<br>";
					redirect(base_url()."dashboard/login/1");
				}				
				
			}

			if(file_exists("install.sql"))
			{
				$sql 	= file_get_contents("install.sql");
				$sqls 	= explode(";\n",$sql);
				foreach ($sqls as $key => $value) {								
					if($value != '')
					{
						$this->db->query($value);
						//echo $this->db->last_query()."<br>";	
					}						
				}			
				unlink("install.sql");
				redirect(base_url()."dashboard/login/2");
			}								
			


			// Check install modules


			
		}

		
	}
}

