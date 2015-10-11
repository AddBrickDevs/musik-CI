<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends MY_Controller {

	public function __construct()
	{		
		parent::__construct();			
	}

	public function login($updated = 0)
	{
	
		if($this->input->post())
		{
			$username 	= addslashes($this->input->post("username",TRUE));
			$password 	= sha1($this->input->post("password",TRUE));
			$user 		= $this->admin->getTable("users",array('username' => $username, 'password' => $password, 'is_admin' => '1'));
			if($user->num_rows > 0)
			{			
				$data = $user->result_array();			
				if(strlen($data[0]['avatar'])>500)
					$data[0]['avatar'] = base_url()."assets/images/default_avatar.jpg";	

				$this->session->set_userdata($data[0]);
				redirect(base_url()."dashboard/website");
			}
			else
			{
				$this->load->view('dashboard/pages/login',array("error" => ___("error_login")));
			}
		}
		else
		{
			if($updated == 1)
				$msg = 'System has been updated! <br>Please login Again.';
			if($updated == 2)
				$msg = 'Module has been updated! <br>Please login Again.';
			$this->load->view('dashboard/pages/login',array("error" => false,"msg" => $msg));
		}
		
	}

	public function admin()
	{
		/* TODO:
		LOGIN REDIRECT
		*/
		redirect(base_url()."dashboard/website");
	}

	public function badges()
	{
		
		if($this->input->get('id'))
		{
			$this->admin->deleteTable('badges',array("id" => intval($this->input->get('id'))));
			redirect(base_url().'dashboard/badges');
		}
		if($this->input->post())
		{
			$save 				= $this->input->post();			
			$this->db->insert('badges',$save);			
			redirect(base_url().'dashboard/badges');
		}

		$DATA 				= array();				
		$DATA['title'] 		= 'Badges';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'badges';						
		$DATA['badges']		= $this->admin->getTable('badges');
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/badges',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function lyrics()
	{
		if($this->input->get('remove'))
		{
			$this->admin->deleteTable('lyrics',array("idlyrics" => intval($this->input->get('remove'))));
		}
		$DATA 				= array();				
		$DATA['title'] 		= 'Lyrics - List';
		$DATA['active']		= 'lyrics';				
		$DATA['active2']	= 'lyrics';						
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/lyrics',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function lyric()
	{
		$DATA 				= array();				
		if($this->input->post("artist"))
		{
			$_data['artist'] = $this->input->post('artist');
			$_data['track'] = $this->input->post('track');
			$_data['lyric'] = nl2br($this->input->post('lyric'));
			if(intval($this->input->post("id"))>0)
			{
				$this->admin->updateTable('lyrics',$_data,array('idlyrics' => intval($this->input->post("id"))));
				$DATA['msg'] = 'Updated!';
			}
			else
			{				
				$this->admin->setTable('lyrics',$_data);
				$DATA['msg'] = 'Saved!';
			}
			

		}
		$id = intval($this->input->get("id"));
		
		$DATA['title'] 		= 'Lyrics - Add/Edit';
		$DATA['active']		= 'lyrics';				
		$DATA['active2']	= 'lyric';				
		$DATA['lyric']		= $this->admin->getTable("lyrics",array("idlyrics" => $id),"idlyrics");						
		$DATA['lyric']		= $DATA['lyric']->row();
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/lyric',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function downloads()
	{
			
		$DATA['title'] 		= 'Downloads';
		$DATA['active']		= 'downloads';				
		$DATA['active2']	= 'downloads';				
		$DATA['total']		= getTotalDownloads();
		$DATA['total'] 		= $DATA['total']->row();
		$DATA['top']		= getTopDownloads();
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/downloads',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}



	public function all_lyrics()
	{
		$status['B']['style'] 	= 'default';
		$status['B']['text'] 	= 'BORRADOR';

		$status['P']['style'] 	= 'success';
		$status['P']['text'] 	= 'PUBLICO';


	/*
	* Ordering
	*/	$sOrder = false;
		if ($this->input->get('iSortCol_0') || 1==1)
		{
			$columns[0] = 'idlyrics';
			$columns[1] = 'artist';
			$columns[2] = 'track';						
			$columns[3] = 'idlyrics';						
			$columns[3] = 'lyric';						
			$sOrder = $columns[$this->input->get('iSortCol_0')]." ".$this->input->get('sSortDir_0');			
		}
		$like= false;
		if ($this->input->get('sSearch') != "" )
		{
			foreach ($columns as $key => $value) {
				$like[$value]	= $this->input->get('sSearch');
			}
			
		}
		$lyrics 				= $this->admin->getTable("lyrics",false,$sOrder,'idlyrics,artist,track',$this->input->get('iDisplayLength'),$this->input->get('iDisplayStart'),$like);	
		
		$total 					= $this->admin->getTable("lyrics",false,$sOrder,'idlyrics,artist,track',false,false,$like);	
		$total 					= $total->num_rows();
		$output = array(
		"sEcho" => intval($this->input->get('sEcho')),
		"iTotalRecords" => $total,
		"iTotalDisplayRecords" => $total,
		"aaData" => array()
		);
		foreach ($lyrics->result_array() as $key => $value) {
			$row = array();		
			
			$row[] = $value['artist'];
			$row[] = $value['track'];			
			$row[]	= '<a class="btn btn-warning btn-xs" href="'.base_url().'dashboard/lyric?id='.$value['idlyrics'].'"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-xs" href="?remove='.$value['idlyrics'].'"><i class="fa fa-trash-o"></i></a>';
			
			$output['aaData'][] = $row;
		}
		
		echo json_encode( $output );
	}

	public function index()
	{		
		if($this->input->post("cache"))
		{
			$this->load->helper('file');
			delete_files("./cache/");
			write_file('./cache/.htaccess', 'Deny from all');
			//mkdir("./cache");
			redirect(base_url().'dashboard');
		}

		$DATA 				= array();

		$DATA['database'] 	= getInfoDatabase();
		
		$this->load->helper('file');
		/*$dir 				= get_dir_file_info("./cache/",FALSE);
		

		foreach ($dir as $key => $value) {
			$size += $value['size'];
		}*/

		$DATA['sizeDir']  		= '0';
		$DATA['used']  		= '0';
		if(function_exists('disk_free_space'))
			$DATA['sizeDir'] 	= disk_free_space("./cache/");
		if(function_exists('disk_total_space'))
		$DATA['used']		= disk_total_space("./cache/") - $DATA['sizeDir'];


		$DATA['active']		= 'dashboard';
		$DATA['history']	= $this->admin->getRegisteredUsersByMonth();
		$DATA['users'] 		= $this->admin->getCountTable("users");
		$DATA['playlist'] 	= $this->admin->getCountTable("playlist");
		$DATA['activity'] 	= $this->admin->getCountTable("activity");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/dashboard',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}




	public function users()
	{		

		$DATA 				= array();
		$DATA['title'] 		= 'Users';
		$DATA['active']		= 'users';
		$DATA['users'] 		= $this->admin->getTable("users",false,"id");			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/users',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}	


	public function language_edit($lang)
	{		

		if($this->input->post())
		{			
			foreach ($this->input->post() as $key => $value) {				
				$this->admin->updateTable('language',array("text" => addslashes($value)),array("language"=>$lang,"key" => $key));	

			}
			redirect(base_url().'dashboard/language');
		}


		$DATA 				= array();
		$DATA['title'] 		= 'Languages';
		$DATA['active']		= 'language';
		$DATA['labels'] 		= $this->admin->getTable("language",array("language" => $lang),"text");					
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/labels',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}	

	public function language()
	{		

		if($this->input->get("download"))
		{
			$powered 	= base_url();
			$date 		= date("Y-m-d H:i:s");
			$this->load->helper('download');
			$name 		= $this->input->get("download")."_lang.php";
			$locate 	= "application/language/".$this->input->get("download")."/".$this->input->get("download")."_lang.php";
			$lang 		= $this->admin->getTable("language",array("language" => $this->input->get("download")),"text");	
			foreach ($lang->result() as $row) {
				$labels.= "\$lang['".$row->key."'] = '".$row->text."';\n";
			}
			
			$data 		= "<?php
/*
* @File: $name
* @Package: Youtube Music Engine
* @Location: $locate
* Date: $date
* Translated: $powered 
*/
$labels
?>";
		force_download($name, $data);
					
		}
		if($this->input->get("r"))
		{
			$this->admin->deleteTable("languages",array('language' => $this->input->get("r")));	
			redirect(base_url().'dashboard/language');
		}
		if($this->input->post("iso"))
		{
			$this->admin->setTableIgnore('languages',array("language"=>$this->input->post("language"),"iso"=>$this->input->post("iso")));
			redirect(base_url().'dashboard/language');
		}
		if($this->input->get("sync"))
		{

			$file = require_once("./application/language/english/english_lang.php");
			foreach($lang as $key => $row)
			{
				if($this->input->get("sync") != 'english')
					$row = '';
				$this->admin->setTableIgnore('language',array("language"=>$this->input->get("sync"),"key" => $key,"text" => addslashes($row)));								
			}			
			
		}
		if($this->input->get("restore"))
		{

			if(file_exists("./application/language/".$this->input->get("restore")."/".$this->input->get("restore")."_lang.php"))
			{
				$lang = array();
				$file = require_once("./application/language/".$this->input->get("restore")."/".$this->input->get("restore")."_lang.php");

				foreach($lang as $key => $row)
				{					
					$this->admin->updateTable('language',array("text" => addslashes($row)),array("language"=>$this->input->get("restore"),"key" => $key));					
				}

			}
			redirect(base_url().'dashboard/language');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Languages';
		$DATA['active']		= 'language';
		$DATA['langs'] 		= $this->admin->getTable("languages",false,"language");					
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/language',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}	

	public function online()
	{		

		$DATA 				= array();
		//$DATA['title'] 		= 'Users Online';
		$DATA['active']		= 'online';		
		$DATA['users'] 		= getUsersOnline();
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/online',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function codecanyon()
	{		

		$DATA 				= array();
		$DATA['title'] 		= 'Youtube Music Engine - Addons';
		$DATA['active']		= 'codecanyon';		
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/codecanyon',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function install()
	{		
		$DATA 				= array();


		if($this->input->post("uploading"))
		{			
			if(!file_exists('./uploads/'))
			{
				mkdir('./uploads/');
			}
			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= 'zip';
			$config['overwrite'] 		=  true;
			$config['remove_spaces']	=  true;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('upload'))
			{
				$DATA['upload'] = array('error' => $this->upload->display_errors());				
			}
			else
			{
				$DATA['upload'] = array('upload_data' => $this->upload->data());
				$this->load->library('unzip');
				$file = './uploads/'.$DATA['upload']['upload_data']['file_name'];
				if(file_exists($file))
				{					
					$this->unzip->extract($file, './');	
					$errorZip = strip_tags($this->unzip->error_string());
					if($errorZip != '')
						$DATA['upload'] = $errorZip;
					@unlink($file);
				}
				else
				{
					$DATA['upload'] = array('error' =>'File '.$file." not exist");	
				}
				
				
			}
		}
		
		$this->load->helper('directory');
		$temp = directory_map("./application/modules/");
		$temp['musik'] = 'Ok';				
		foreach ($temp as $key => $value) {
			$module = $key;
			if($module == 'musik')
				$module = 'music';
			$data 	= file_get_contents("./application/modules/$module/controllers/$key.php");	
			$metadata = get_data_file($data);
			if($metadata)
				$DATA['modules'][] = $metadata;
			
		}
	
		

		
		$DATA['title'] 		= 'Install Module or Update';
		$DATA['active']		= 'install';		
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/install',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}



	public function website()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/website');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Website';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'website';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/website',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function comments()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/comments');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Comments & Social Network';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'comments';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/comments',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function newsletter()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/newsletter');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Newsletter';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'newsletter';	
		$DATA['users'] 		= $this->admin->getTable("users",array("newsletter" => '1'),"id");				
		$DATA['users_t']	= $this->admin->getTable("users",false,"id");				

		$this->db->select_sum('mails_received');
		$query = $this->db->get('users');
		$t = $query->row();

		$DATA['emails_sent'] = intval($t->mails_received);

		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/newsletter',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function themes_setting()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/themes_setting');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Current Theme';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes_setting';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes_setting',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function themes_setting_mobile()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/themes_setting_mobile');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Current Theme (Smartphone)';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes_mobile';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes_setting_mobile',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}



	public function ads()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/ads');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - '. ___("admin_advertising");
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'ads';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/ads',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function smtp()
	{	
		
		$DATA 				= array();
		if($this->input->post())
		{
			if($this->input->post("target"))
			{
			
				$this->email->from($this->config->item("contact_email"),$this->config->item("title"));
				$this->email->to($this->input->post("target")); 
				$this->email->subject('Email Test');
				$this->email->message('Testing the email config');	
				if($this->email->send())
				{
					$DATA['error'] = '1';
				}
				else
				{
					$DATA['error'] = $this->email->print_debugger();
					

				}
			}
			else
			{
				foreach ($this->input->post() as $key => $value) {
					$value 	= addslashes($value);				
					$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
				}	
				redirect(base_url().'dashboard/smtp');

			}
					
			
		}

	
		$DATA['title'] 		= 'Settings - SMTP Server';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'email';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/email',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function gui()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/gui');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - GUI';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'gui';	
		$DATA['pages']		= $this->admin->getTable("pages",false,"title");			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/gui',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}	

	public function carousel($action = false,$id = false)
	{		
		if($this->input->post('carousel_show'))
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/carousel');
		}

		if($this->input->post('order2'))
		{
			$this->admin->updateTable("carousel",array("order" => intval($this->input->post('order2'))),array("idcarousel" => intval($this->input->post('id'))));
			redirect(base_url().'dashboard/carousel');
		}
		
		if($this->input->post('title'))
		{
					

			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= 'jpg|jpeg|png';
			$config['overwrite'] 		=  true;
			$config['remove_spaces']	=  true;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('upload'))
			{				
				$r =  $this->upload->display_errors();				
			}
			else
			{
				$r = $this->upload->data();								
				$save 				= $this->input->post();
				$save['picture'] 	= $r['file_name'];				
				$this->db->insert('carousel',$save);				
			}

		}
		$DATA 				= array();
		if($action == 'remove')
		{
				$this->admin->deleteTable("carousel",array('idcarousel' => intval($id)));	
				redirect(base_url().'dashboard/carousel','location');
		}
		
		$DATA['title'] 		= 'Settings - Carousel';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'carousel';	
		$DATA['pages']		= $this->admin->getTable("pages",false,"title");			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/carousel',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function stations($action = false,$id = false)
	{			
	
		
		if($this->input->post('title'))
		{
					

			if($action != 'edit')	
			{
				if(!file_exists('./uploads/stations/'))	
					mkdir('./uploads/stations/');
				$config['upload_path'] 		= './uploads/stations/';
				$config['allowed_types'] 	= 'jpg|jpeg|png';
				$config['overwrite'] 		=  true;
				$config['remove_spaces']	=  true;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('upload'))
				{				
					$r =  $this->upload->display_errors();				
				}
				else
				{
					$r = $this->upload->data();								
					$save 				= $this->input->post();
					$save['cover'] 	= $r['file_name'];
					$this->db->insert('stations_m3a',$save);				
				}
			}
			else
			{
				$save 				= $this->input->post();				
				
				$this->db->update('stations_m3a',$save,array('idtstation' => intval($id)));	
				redirect(base_url().'dashboard/stations','location');

			}

		}
		$DATA 				= array();
		if($action == 'remove')
		{
				$this->admin->deleteTable("stations_m3a",array('idtstation' => intval($id)));	
				redirect(base_url().'dashboard/stations','location');
		}
		
		if($action == 'edit')
		{
			$DATA['edit'] 	= $this->admin->getTable("stations_m3a",array('idtstation' => intval($id)));	
		}
		$DATA['title'] 		= 'Settings - Stations';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'stations';			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/stations',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function themes()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			


			$setting_file = './assets/css/themes/'.$this->input->post("theme").'/'.$this->input->post("theme").'.conf';
			$config = array();
			if(file_exists($setting_file))
			{
				$setting_file = file_get_contents($setting_file);
				$temp = explode("\n", $setting_file );	
				foreach ($temp as $key => $value) {
					$temp2 = explode(":", $value);
					$config[$temp2[0]] = $temp2[1];
				}	
			}

			if($config['setting_theme'] !== 'false')
				redirect(base_url().'dashboard/themes_setting');
			else
				redirect(base_url().'dashboard/themes');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Themes Desktop';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function themes_mobile()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/themes_mobile');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Themes Mobile';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes_mobile';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes_mobile',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function genres()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				if(is_array($value))
					$value = implode($value, ",");			
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
				
			}			
			
			redirect(base_url().'dashboard/genres');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Genres';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'genres';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/genres',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function license()
	{		

		if($this->input->post())
		{
			if(is_ok($this->input->post("purchase_code")))
			{
				$license = json_decode(_curl("http://api.andthemusic.net/music/verifyInfo/".$this->input->post("purchase_code")."?site=".urlencode(base_url())));	 
				if(@intval($license->verify->item_id) > 0){			
					foreach ($this->input->post() as $key => $value) {
						$value 	= addslashes($value);				
						$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
					}			
				}
			}	
			else{
				echo "a";
				exit;
			}					
			redirect(base_url().'dashboard/license');
		}


		$DATA 				= array();
		$DATA['license'] 	= json_decode(_curl("http://api.andthemusic.net/music/verifyInfo/".$this->config->item("purchase_code")."?site=".urlencode(base_url())));				
		if(@intval($DATA['license']->verify->item_id) == 0 && $this->config->item("purchase_code") != '')
		{			
			$this->admin->updateTable("settings",array("value" => ''),array("var" => 'purchase_code'));
			redirect(base_url().'dashboard/license');
		}
		$DATA['title'] 		= 'Settings - License';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'license';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/license',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function page_artist()
	{
		if($this->input->post('artist'))
		{
			$this->admin->setTable('top_page_artist',array('cover' => $this->input->post('cover'),'artist' => $this->input->post('artist')));			
		}
		if($this->input->post('idremove'))
		{
			$this->admin->deleteTable('top_page_artist',array('id' => intval($this->input->post('idremove'))));			
		}

		$DATA 				= array();				
		$DATA['title'] 		= 'Page - Top Artist';
		$DATA['active']		= 'pages';						 
		$DATA['active2']	= 'page_artist';						
		$DATA['page']		= $this->admin->getTable('top_page_artist');
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/page_artist',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function list_pages()
	{
		$DATA 				= array();				
		$DATA['title'] 		= 'Page - List';
		$DATA['active']		= 'pages';				
		$DATA['active2']	= 'list_pages';				
		$DATA['pages']		= $this->admin->getTable("pages",false,"title");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/list_pages',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function page( $id= 0)
	{
		$DATA 				= array();	
		if($this->input->post("id") >= 0 && $this->input->post("title",true) != '')
		{
			$title 		= $this->input->post("title",true);
			$content 	= $this->input->post("content",FALSE);					
			if(intval($this->input->post("id")) > 0)
			{
				$this->admin->updateTable("pages",array("title" => $title, "content" => $content),array("idpage" => intval($this->input->post("id") )));
			}
			else
			{
				$this->admin->setTable("pages",array("title" => $title, "content" => $content));
				redirect(base_url().'dashboard/list_pages');
			}
			

		}
		$DATA['editpages'] = false;
		if(intval($id) > 0)
		{
		
				$DATA['editpages']	= $this->admin->getTable("pages",array("idpage" => intval($id)),"title");	
		}

					
		$DATA['title'] 		= 'Page - new Page';
		$DATA['active']		= 'pages';				
		$DATA['active2']	= 'page';				
		$DATA['pages']	= $this->admin->getTable("pages",false,"title");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/page',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}











	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."dashboard/login");
	}
	public function module($module)
	{		

		// Check Evato
		
		if($module != 'upgrade')
		{
			$data = false;
			if($module == 'dashboard')
			{
				$data['users'] 		= $this->admin->getCountTable("users");
				$data['playlist'] 	= $this->admin->getCountTable("playlist");
				$data['users_today']= $this->admin->usersToday();
				$data['history']	= $this->admin->getRegisteredUsersByMonth();
			}
			if($module == 'users')
			{
				$data['users'] 		= $this->admin->getTable("users",false,"id");	
	
			}
			if($module == 'license')
			{
				
				$DATA['license'] 	= json_decode(_curl("http://api.andthemusic.net/music/verifyInfo/".$this->config->item("purchase_code")."?site=".urlencode(base_url())));				
	
			}
			if($module == 'pages')
			{
				if($this->input->post("id") >= 0 && $this->input->post("title",true) != '')
				{
					$title 		= $this->input->post("title",true);
					$content 	= $this->input->post("content",FALSE);					
					if(intval($this->input->post("id")) > 0)
					{
						$this->admin->updateTable("pages",array("title" => $title, "content" => $content),array("idpage" => intval($this->input->post("id") )));
					}
					else
					{
						$this->admin->setTable("pages",array("title" => $title, "content" => $content));
					}
					

				}
				$data['editpages'] = false;
				if(intval($this->input->post("id_page")) > 0)
				{
					if($this->input->post("remove") == '1')	
					{
						$this->admin->deleteTable("pages",array("idpage" => intval($this->input->post("id_page"))));
					}
					else
						$data['editpages']	= $this->admin->getTable("pages",array("idpage" => intval($this->input->post("id_page"))),"title");	
				}
				$data['pages']	= $this->admin->getTable("pages",false,"title");
			}

			$temp 	= $this->session->userdata('purchase_code');
			if($temp == '1' || $temp == '')
			{
				$temp 	= _curl("http://api.andthemusic.net/music/verify/".$this->config->item("purchase_code"));		
			}			
			if($temp == '1')
			{		
				$this->session->set_userdata("purchase_code",$temp);
				//$this->load->view('dashboard/'.$module,$data);	
			}
			else
			{				
				$data['error'] = $temp;
				$this->load->view('dashboard/purchase',$data);	
			}

		}
		else
		{
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
							echo $this->db->last_query()."<br>";	
						}						
					}				
					$this->db->query("UPDATE settings SET value = '$MD5' WHERE var='md5updated';");					
					$this->session->sess_destroy();					
					//echo $this->db->last_query()."<br>";
				}
				else
				{
					echo "You have the last version!";
				}
				
			}
			else
			{
				echo ":)";
			}			

			echo "<script>location.reload();</script>";
		}
		
	}
	public function purchase()
	{
		$key			 		= addslashes($this->input->post("licence",TRUE));	
		$temp 					= _curl("http://api.andthemusic.net/music/verify/".$key);	
		$data['purchase_code'] 	= $key;			
		if($temp == '1')
		{
			$data['error'] 		= "<div class='alert alert-success'><strong>Thank You!</strong> Purchase Code Valid</div>";
			$this->session->set_userdata("purchase_code",$temp);		
			$this->admin->updateTable("settings",array("value" => $key),array("var" => "purchase_code"));
		}
		else
		{
			$data['error'] = $temp;
		}		
		$this->load->view('dashboard/purchase',$data);	

	}
	public function saveSetting()
	{		
		$target = addslashes($this->input->post("target",TRUE));
		$value 	= str_ireplace("xcript", "script", addslashes(urldecode($this->input->post("value",TRUE))));
		$this->admin->updateTable("settings",array("value" => $value),array("var" => $target));
	}

	public function removeUser()
	{
		if(intval($this->input->post("id")) <=0)
			return fakse;
		$this->admin->deleteTable("users",array("id" => intval($this->input->post("id"))));
	}
	
	public function makeAdmin()
	{
		if(intval($this->input->post("id")) <=0)
			return fakse;
		$this->admin->updateTable("users",array("is_admin" => '1'),array("id" => intval($this->input->post("id"))));
	}



	public function updateUser()
	{		
		$password 	= sha1($this->input->post("pwd",TRUE));
		$password2 	= sha1($this->input->post("pwd2",TRUE));
		$passwordC 	= sha1($this->input->post("pwdc",TRUE));
		$email 		= $this->input->post("email",TRUE);
	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Email not Valid!";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}
		if($password != $password2)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Password doesn\'t match!";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		if(strlen($password) < 4)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Password need min 5 characters";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}
		$user 		= $this->admin->getTable("users",array('username' => $this->session->userdata('username'), 'password' => $passwordC, 'is_admin' => '1'));
		if($user->num_rows == 0)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Current Password doesn\'t match";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		$this->admin->updateTable("users",array("password" => $password,"username" => $email),array("username" => $this->session->userdata('username'),"password" => $passwordC));

		$json['title'] 		= "Update";
		$json['content'] 	= "Account Updated!";		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
		return;
	}

	public function facebook_setting()
	{
			        
    	if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/facebook_setting');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Facebook Login';
		$DATA['active']		= 'facebook';									
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/facebook_settings',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);   
    
	}

	public function spotify()
	{
			        
    	if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/spotify');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Spotify';
		$DATA['active']		= 'spotify';									
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/spotify',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);   
    
	}


	public function search_artist()
	{
		$artist = json_decode(searchArtist($this->input->get('q')));
		
		foreach ($artist->results->artistmatches->artist as $key => $value) {
			$data[] = array('text' => $value->name,'id' => $value->name);
		}
		$json['artist'] = $data;
		$this->output->set_content_type('application/json')->set_output(json_encode($json));

	}
	public function search_song()
	{
		$song = json_decode(searchLastFm($this->input->get('q')));
		
		
		foreach ($song->results->trackmatches->track as $key => $value) {
			$data[] = array('text' => $value->artist." - ".$value->name ,'id' =>  $value->name);
		}
		$json['songs'] = $data;
		$this->output->set_content_type('application/json')->set_output(json_encode($json));

	}

	public function sitemap()
	{
		$this->load->model('sitemap/mdl_sitemap');
		$DATA 				= array();
		$DATA['artist'] 	= $this->mdl_sitemap->get_artist();
		$DATA['tracks'] 	= $this->mdl_sitemap->get_tracks();
		$DATA['pages'] 		= $this->mdl_sitemap->get_pages();
		$DATA['users'] 		= $this->mdl_sitemap->get_users();
		$DATA['stations'] 	= $this->mdl_sitemap->get_stations();
		
		$tags 			= $this->config->item("genres");
		$tags_array 	= explode(",",$tags);
		$tags 			= $this->config->item("custom_genres");
		$tags_array2 	= explode(",",$tags);
		
		$DATA['tags'] 	= array_merge($tags_array,$tags_array2);

		$DATA['total'] 	= intval(count($DATA['tags']))+intval($DATA['artist']->num_rows())+intval($DATA['tracks']->num_rows())+intval($DATA['pages']->num_rows())+intval($DATA['users']->num_rows())+intval($DATA['stations']->num_rows());
		
		$DATA['title'] 		= 'Sitemap';
		$DATA['active']		= 'sitemap';									
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/sitemap',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);  

	}



}

