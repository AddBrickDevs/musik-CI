<?php
$editable 	= false;
$followers = getFollowers($user->id);
if($user->id == $this->session->userdata('id'))
	$editable = true
?>
<section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="text-center m-b m-t">
                          <a onClick="$('#imgInp').click();"  href="#" class="thumb-lg">
                            <img src="<?php echo $user->avatar; ?>" class="img-circle">
                          </a>
                          <?php if($editable){ ?>		
		<p class="help-block">360x360 Recommended</p>
		<center><span id="avatarLoading"></span></center>
		

		
	
		<form id="form1" class="hide" style="display:none" action="<?php echo base_url(); ?>music/uploadAvatar" method="post"  enctype="multipart/form-data" >      
		   <input type='file' required id="imgInp" name="upload" />
		   <img id="blah" src="#" alt="your image" />
		</form>
		<?php } ?>
                          <div>
                            <div class="h3 m-t-xs m-b-xs"><?php echo $user->nickname; ?>                            
                            <?php if($editable){ ?>
		  				<button class="btn btn-default btn-xs" onClick="$(this).hide();$('#nickname').fadeIn(500);"><i class="fa fa-pencil"></i></button>
		  				<input id="nickname" maxlength="30" placeholder="Max 30 Char / Not Special Characters" style="display:none" class="form-control" style="width:200px" type="text">
		  				<?php } ?>
                            </div>  
                           	<small class="text-muted"><?php echo ___("label_user_badges"); ?></small><br><br>
                            <?php get_badges($user->id); ?>
                          </div>                
                        </div>
                        <div class="panel wrapper">
                          <div class="row text-center">
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs h4 block"><?php echo number_format($activity->num_rows(),0); ?></span>
                                <small class="text-muted"><?php echo ___("social_activity"); ?></small>
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs h4 block"><?php echo number_format($playlist->num_rows(),0); ?></span>
                                <small class="text-muted"><?php echo ___("label_profile_music_folder"); ?></small>
                              </a>
                            </div>
                          </div>
                        </div>
	                      	<?php echo getFollowButton($user->id,$user->nickname); ?>
	                      	<br>
                        <div>
                          
                          <small class="text-uc text-xs text-muted"><?php echo ___("label_bio"); ?></small>
                          <?php if($editable){ ?>
			  				<button class="btn btn-default btn-xs" onClick="$(this).hide();$('#bio').fadeIn(500);"><i class="fa fa-pencil"></i></button>
			  				<textarea id="bio" maxlength="200" style="display:none"  class="form-control col-xs-12"></textarea>
			  				<?php } ?>
                          <p><?php echo $user->bio; ?></p>

                          <?php if($editable){ ?>
                          <div class="form-group">
                          	<label class="control-label"><?php echo ___("social_activity_public"); ?></label>
				  				<select id="publicS" class="form-control m-b">
				  					<option value="" selected disabled></option>
				  					<option <?php if($user->activity_global == '1' || $user->activity_global == 'S'){echo "selected";} ?> value="1">On</option>
				  					<option <?php if($user->activity_global == '0'){echo "selected";} ?> value="0">Off</option>
				  				</select> 
				  			</div>
		  				<?php } ?>



		  				<?php if($editable){ ?>
                          <div class="form-group">
                          	<label class="control-label"><?php echo ___("label_public_chat"); ?></label>
				  				<select id="public_chat" class="form-control m-b">
				  					<option value="" selected disabled></option>
				  					<option <?php if($user->public_chat == '1' || $user->activity_global == 'S'){echo "selected";} ?> value="1">Yes</option>
				  					<option <?php if($user->public_chat != '1'){echo "selected";} ?> value="0">No</option>
				  				</select> 
				  			</div>
		  				<?php } ?>

		  				   <?php if($editable){ ?>
                          <div class="form-group">
                          	<label class="control-label"><?php echo ___("label_biography_lang"); ?></label>
				  				<select id="biography_lang" class="form-control m-b">
				  					<option <?php if($user->biography_lang == 'zh'){ echo "selected"; } ?> value="zh">Chinese</option>
							    	<option <?php if($user->biography_lang == 'de'){ echo "selected"; } ?> value="de">German</option>
							    	<option <?php if($user->biography_lang == 'fr'){ echo "selected"; } ?> value="fr">French</option>
							    	<option <?php if($user->biography_lang == 'it'){ echo "selected"; } ?> value="it">Italian</option>
							    	<option <?php if($user->biography_lang == 'pt'){ echo "selected"; } ?> value="pt">Portuguese</option>
							    	<option <?php if($user->biography_lang == 'ru'){ echo "selected"; } ?> value="ru">Russian</option>
							    	<option <?php if($user->biography_lang == 'es'){ echo "selected"; } ?> value="es">Spanish</option>
							    	<option <?php if($user->biography_lang == 'en'){ echo "selected"; } ?> value="en">English</option>
				  				</select> 
				  			</div>
		  				<?php } ?>

                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light lt">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><?php echo ___("social_activity"); ?></a></li>
                        <li class=""><a href="#folders" data-toggle="tab"><?php echo ___("label_profile_music_folder"); ?></a></li>                        
                        <li class=""><a href="#comments" data-toggle="tab"><?php echo ___("label_profile_comments"); ?></a></li>                        
                        <li class=""><a href="#followers" data-toggle="tab"><?php echo ___("label_profile_followers"); ?> <span class="badge badge-sm  badge-danger"><?php echo number_format($followers->num_rows(),0);?></span></a></li>                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane" id="followers">
                        	<?php
                        	if($followers->num_rows()>0)
                        	{
                        		foreach ($followers->result() as $row) {
                        			?>
                        			<div class="panel clearfix col-md-6">
				                        <div class="panel-body">
				                          <a href="#" class="thumb pull-left m-r">
				                            <img src="<?php echo $row->avatar; ?>" class="img-circle">
				                          </a>
				                          <div class="clear">
				                            <a href="#" class="text-info btn-profile" data-user="<?php echo $row->nickname; ?>">@<?php echo $row->nickname; ?></a>
				                            <small class="block text-muted"><?php echo substr($row->bio,0,50); ?>...</small>
				                            <?php 
				                            	echo getFollowButton($row->id,$row->nickname,'xs');
				                            ?>
				                            
				                          </div>
				                        </div>
				                      </div>

				                    
				                     <?php
                        		}
                        	}
                        	?>                        	
                        </div>
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <?php foreach ($activity->result() as $row) { ?>
                            <li class="list-group-item">
                              <span class="thumb-sm pull-left m-r-sm">
                                <img src="<?php echo $row->picture; ?>" class="img-circle" style="max-width:35px">
                              </span>
                              <span class="clear">
                                <small class="pull-right"><?php echo ago(strtotime($row->date)); ?></small>
                                <strong class="block">
                                	<a style="color:#6C6C6C" href="<?php echo base_url(); ?>?artist=<?php echo encode($row->artist); ?>&track=<?php echo encode($row->track); ?>" class="removehref text-muted cursor-pointer"   onclick="getSongInfo('<?php echo addslashes($row->artist); ?>','<?php echo addslashes($row->track); ?>');"><i class="fa fa-music"></i> <?php echo $row->track; ?></a>
                                </strong>
                                <small><a style="color:#000000" href="<?php echo base_url(); ?>artist/<?php echo econde($row->artist); ?>" class="artistInfo removehref truncate" onClick="getArtistInfo('<?php echo addslashes($row->artist); ?>');" title="<?php echo ___("label_get_artist_info"); ?>"><?php echo $row->artist; ?></a>      </small>
                              </span>
                            </li>
                            <?php } ?>
                           
                          </ul>
                        </div>
                        <div class="tab-pane" id="comments"> 
	                        <div class="col-md-12">

			  			<?php echo comments('profile'); ?>
			  			</div>
                        </div>
                        <div class="tab-pane" id="folders">
                        
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                              <?php foreach ($playlist->result() as $row) { 
								  	$pl = json_decode($row->json);  
								  	?>
								  	 
										   <li class="list-group-item" >
										   
										        <span style="cursor:pointer" data-toggle="collapse" data-parent="#accordion" href="#pl-<?php echo $row->idplaylist; ?>">
										        	<span class="thumb-sm pull-left m-r-sm">
												      <img class="img-circle" style="max-width:35px" src="<?php echo addslashes($pl[0]->cover); ?>">
												     </span>
												     <span class="clear">
							                                <small class="pull-right">
							                                	<button class="btn btn-default pull-right btn-xs" onclick="$('.song-pl-<?php echo $row->idplaylist; ?>').click();"><i class="fa fa-plus"></i> <?php echo ___("label_add_all"); ?> &nbsp;&nbsp; <span class="badge alert-default"><?php echo count($pl); ?></span></button>
							                                </small>
							                                <strong class="block">
							                                	<a style="color:#6C6C6C" href="#" class="text-muted" ><?php echo $row->name; ?></a>
							                                </strong>
							                                <small><a style="color:#000000" href="#" class="truncate" > <?php echo number_format(count($pl)); ?> <?php echo ___("social_songs"); ?></a>      </small>
							                          </span>
							                     </span>

										       
										   <div class="clearfix"></div>
									
										    <div id="pl-<?php echo $row->idplaylist; ?>" class="panel-collapse collapse" style="margin-top:10px">
												      <?php 
												      
												      foreach ($pl as $key => $value) { ?>
												      	  <span class="list-group-item">
												      	  <i style="cursor:pointer" onclick="addPlayList('<?php echo addslashes($value->track); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $value->cover; ?>',true);" title="<?php echo ___("label_playnow"); ?>" class="icon-control-play text"></i> <?php echo $value->track; ?> 
												      	  <span class="text-muted"><?php echo $value->artist; ?></span>
												      	  <i style="cursor:pointer" class="pull-right song-pl-<?php echo $row->idplaylist; ?>" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->track); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $value->cover; ?>');"><i class="fa fa-plus text"></i></i>                                         
												      	  </span>
												      <?php } ?>
										    </div>
										    </li>
										
								  <?php } ?>	
								 </ul>
                          </div>
                        
                      
                      </div>
                    </section>
                  </section>
                </aside>          
              </section>

              <script>
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>user/<?php echo encode2($user->nickname); ?>");


<?php if($editable){ ?>
function readURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
       
        img = new Image();
        img.onload = function () {
            if(input.files[0].size > 300000)
            {
            	alert("Pls upload picture < 300kB size");
            	
            }
            else
            {
            $('#avatar').attr('src', e.target.result);        
			show_loading('avatarLoading');
			/*$.post(base_url+"music/saveAvatar", {avatar:e.target.result}, function(data, textStatus) {
				$("#avatarLoading").html('');
			});  */
			$("#form1").submit();
            }
        };
        img.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
}
}

$("#imgInp").change(function(){
	//readURL(this);
	$("#form1").submit();
});
$("#nickname").keyup(function(event) {
	$(this).val($(this).val().replace(/[^\w\s]/gi, ''));
	$(this).val($(this).val().replace(" ", ''));
	$(this).val($(this).val().replace(".", ''));
});
$("#nickname").blur(function(event) {
	var nickname = $(this).val();	
	if(nickname == '')
		return false;
	show_loading();
	$.post(base_url+'music/SaveDataUser', {nickname: nickname}, function(data, textStatus, xhr) {
		if(data == "1")
		{
			var stateObj = { foo: "bar" };
			history.pushState(stateObj, "", "<?php echo base_url(); ?>user/"+nickname);	
			
		}
		else
		{
			alert(data);
		}
		location.reload();
		
	});
});

$("#bio").blur(function(event) {
	var bio = $(this).val();	
	if(bio == '')
		return false;
	show_loading();
	$.post(base_url+'music/SaveDataUser', {bio: bio}, function(data, textStatus, xhr) {
		if(data == "1")
		{
			var stateObj = { foo: "bar" };
			history.pushState(stateObj, "", "<?php echo base_url(); ?>user/<?php echo encode2($user->nickname); ?>");			
		}
		else
		{
			alert(data);
		}
		location.reload();
	});
});

$("#publicS").change(function(event) {
	var publicS = $(this).val();	
	if(publicS == '')
		return '0';
	show_loading();
	$.post(base_url+'music/SaveDataUser', {publicS: publicS,publicST:'1'}, function(data, textStatus, xhr) {
		if(data == "1")
		{
			var stateObj = { foo: "bar" };
			history.pushState(stateObj, "", "<?php echo base_url(); ?>user/<?php echo encode2($user->nickname); ?>");
			
		}
		else
		{
			if(data != '')
				alert(data);
		}
		location.reload();
		
	});
});
$("#public_chat").change(function(event) {
	var public_chat = $(this).val();	
	if(public_chat == '')
		return '0';

	show_loading();
	$.post(base_url+'music/SaveDataUser', {public_chat: public_chat,public_chat_save:'1'}, function(data, textStatus, xhr) {
		if(data == "1")
		{
			var stateObj = { foo: "bar" };
			history.pushState(stateObj, "", "<?php echo base_url(); ?>user/<?php echo encode2($user->nickname); ?>");
			
		}
		else
		{
			if(data != '')
				alert(data);
		}
		location.reload();
		
	});
});

$("#biography_lang").change(function(event) {
	var biography_lang = $(this).val();	
	if(biography_lang == '')
		return '0';

	show_loading();
	$.post(base_url+'music/SaveDataUser', {biography_lang: biography_lang,biography_lang_save:'1'}, function(data, textStatus, xhr) {
		if(data == "1")
		{
			var stateObj = { foo: "bar" };
			history.pushState(stateObj, "", "<?php echo base_url(); ?>user/<?php echo encode2($user->nickname); ?>");
			
		}
		else
		{
			if(data != '')
				alert(data);
		}
		location.reload();
		
	});
});

<?php } ?>

</script>

<script>
$(".nav-sidebar li").removeClass("active");
$("#MyProfile").addClass('active');

$(window).load(function() {
  $(".removehref").attr("href","#");
});
try{
  $(".removehref").attr("href","#");
}
catch(e)
{

}

</script>