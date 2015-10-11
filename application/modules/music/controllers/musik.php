<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* [name] Musik Extend Module [/name] */
/* [description] Template with exclusive features [/description] */

class Musik extends MY_Controller {


	function followUser()
	{
		$username = $this->input->post('user',true);
		$this->admin->followUser($username);
	}
	function unFollowUser()
	{
		$username = $this->input->post('user',true);
		$this->admin->unFollowUser($username);
	}

	function searchUsers()
	{		
		$user 	= trim(secure($this->input->post("user",true)));
		if(strlen($user)<3)
			$data['users'] =  $this->admin->getTable('users',false,false,false,12,0,array('nickname' => $user));    		
		else
			$data['users'] =  $this->admin->getTable('users',false,false,false,false,false,array('nickname' => $user));    		
		$data['user'] =  $user;
		$this->load->view(getTemplate('users'),$data);
	}

	function getusersOnline()
	{
		if(!is_logged())
			show_error('',403);
		$rest =  time() - 600; //one hour
		//$DATA['users'] 		= $this->admin->deleteTable("ci_sessions","last_activity <= $rest");					

		$following = getFollowingOnline($this->session->userdata('id'));
		$json = array();
		if($following->num_rows() > 0)
		{
			foreach ($following->result_array() as $row) 
			{		
				$row['bio'] = more($row['bio'],20);
				$json[] = $row;	
			}
		}
		$r['online'] = $json;

		$json = array();
		$iduser 	= intval($this->session->userdata('id'));		
		$chat 		=  $this->db->query("SELECT * FROM chat,users WHERE (idfriend = $iduser )  and seen ='0000-00-00' and users.id=chat.iduser order by date ASC ");    								

		foreach ($chat->result_array() as $row) 
		{		
			$a[$this->session->userdata('id')] 	= 'me';
			$a[$friend] 						= 'friend';
			$row['own'] 						= $a[$row['iduser']];
			$json[] = $row;	
		}
		$r['chat'] = $json;

		$json = array();
		$notifications 		=  $this->db->query("SELECT users.*,notifications.date,notifications.id as idnotification FROM notifications,users WHERE (iduserf = $iduser )  and seen ='0000-00-00' and users.id=notifications.iduser order by date ASC limit  5");    								
		foreach ($notifications->result_array() as $row) 
		{		
			
			$row['date'] 	= ago(strtotime($row['date']));
			$row['label'] 	= ___("msg_followed_you");			
			$json[] = $row;	
		}
		$r['notifications'] = $json;


		$this->output->set_content_type('application/json')->set_output(json_encode($r));
	}

	function setSeen()
	{
		$id = $this->input->post('id');
		if($id != '')
		{
			$id = explode(",",$id);
			foreach ($id as $key => $value) {
				if(intval($value)>0)
				{
					$this->admin-> updateTable('notifications',array('seen' => date('Y-m-d H:i:s')),array('id' => $value));					
				}
			}
		}
	}

	function getChat()
	{
		$friend 	= getIdUser(trim(secure($this->input->post("nickname",true))));
		$iduser 	= intval($this->session->userdata('id'));		
		$chat 		=  $this->db->query("SELECT * FROM chat WHERE (iduser = $iduser and idfriend = $friend) or (iduser = $friend and idfriend = $iduser) order by date DESC limit 50 ");    		
		$date 		= date('Y-m-d H:i:s');
		    		
		foreach ($chat->result_array() as $row) 
		{		
			$a[$this->session->userdata('id')] 	= 'left';
			$a[$friend] 						= 'right';
			$row['new'] 						= '0';
			if($row['seen'] == '0000-00-00')
				$row['seen'] = '0000-00-00 00:00:00';
			if($row['seen'] == '0000-00-00 00:00:00' && $row['iduser'] == $friend)
				$row['new'] 					= '1';
			$row['own'] 						= $a[$row['iduser']];
			$row['hash'] 						= sha1($row['message'].$row['date']);
			$pos = strpos($row['message'],"[shorcode type");
			if($pos !== false)
			{
				$message = html_entity_decode($row['message']);
				$message = str_ireplace('"]', '" ]',$message);				
				$atts = array();
		        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
		        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $message);
		        if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
		            foreach ($match as $m) {
		                if (!empty($m[1]))
		                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
		                elseif (!empty($m[3]))
		                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
		                elseif (!empty($m[5]))
		                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
		                elseif (isset($m[7]) and strlen($m[7]))
		                    $atts[] = stripcslashes($m[7]);
		                elseif (isset($m[8]))
		                    $atts[] = stripcslashes($m[8]);
		            }
		        } else {
		            $atts = ltrim($text);
		        }

		        switch ($atts['type']) {
		        	case 'artist':
		        		$row['message']  = "<br><div style='width:100%' class='btn-artist-info cursor-pointer shortcode' data-artist='{$atts['artist']}'> 		        									
		        								<i class='fa fa-user' style='margin-right:5px'></i>
		        									<strong>{$atts['artist']}</strong>	  		        								   									
		        							</div>";
		        		break;		        	

		        	case 'track':
		        		$row['message']  = "<br><div style='width:100%;' class='btn-track-info cursor-pointer shortcode' data-artist='{$atts['artist']}' data-track='{$atts['track']}'> 				        								
		        									<img src='{$atts['cover']}' class='pull-right' style='width:40px;height:40px;margin-right:5px;margin-left:5px;margin-top:0px'>
		        									<h5 class='text-ellipsis'><strong>{$atts['track']}</strong></h5>
		        									<h6 class='text-ellipsis'>{$atts['artist']}</h6>	
		        							</div>";
		        		break;		        	
		        	 case 'lyric':
		        			$row['message']  = "<br><div style='width:100%' class='btn-lyric-info cursor-pointer shortcode' data-artist='{$atts['artist']}'  data-track='{$atts['track']}'> 		        									
		        									<i class='fa fa-align-center' style='margin-right:5px'></i>
		        									<strong>{$atts['track']}</strong>	  		        								   									
		        									<span> by {$atts['artist']}</span>	  		        								   									
		        								</div>";
		        		break;		        	

		        		break;		

		        	default:
		        		# code...
		        		break;
		        }

		        
		        
			}
			
			$row['message'] = emoticons($row['message']);
			$row['date'] = ago(strtotime($row['date2']));
			$json[] = $row;	
		}

		$this->db->query("UPDATE chat SET seen='$date' WHERE iduser = $friend and idfriend = $iduser  and seen ='0000-00-00'");
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	function sendChat()
	{
		$friend 	= getIdUser(trim(secure($this->input->post("nickname",true))));
		$iduser 	= intval($this->session->userdata('id'));
		$msg 		= htmlentities($this->input->post("msg",true), ENT_QUOTES, "UTF-8");
		$json = array();
		if(!checkOnline($friend))
		{
			$json['alert'] = ___('msg_user_offline');
			$json['class'] = 'offline';
		}

		if(!isPublicChat($friend))
		{
			if(isFollowMe($friend))
			{
				$this->admin->setTable('chat',array('iduser' => $iduser,'idfriend' => $friend,'message' => $msg,'date2' => date('Y-m-d H:i:s')));		
			}
			else
			{
				$json['alert'] = ___('msg_user_not_follow_you');
				$json['class'] = 'danger';
			}
		}
		else
		{
			$this->admin->setTable('chat',array('iduser' => $iduser,'idfriend' => $friend,'message' => $msg,'date2' => date('Y-m-d H:i:s')));		
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}



}