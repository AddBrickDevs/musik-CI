<?php

$playlist = $playlist->result();
$playlist = $playlist[0];
$nickname = getNickNameUser($playlist->iduser);
$pl = json_decode($playlist->json);  
$editable = false;
if($playlist->iduser ==  intval( $this->session->userdata('id')))
	$editable = true;
?>




<section class="hbox stretch col-xs-12" style="overflow:none">
	<aside class="aside-lg bg-light lter b-r">
		<section class="vbox">
			<section >
				<div class="wrapper">
					<div class="text-center m-b m-t">					
						<img src="<?php echo getAvatarUser(false,$playlist->iduser); ?>" class="img-responsive btn-profile" data-user="<?php echo $nickname; ?>" style="width:100%">
					</div>
					<div class="h3 m-t-xs m-b-xs text-center btn-profile" data-user="<?php echo $nickname; ?>"><?php echo $nickname; ?></div>  
					<?php echo getFollowButton($playlist->iduser,$nickname); ?>		
					<br>
					<?php if($editable){ ?>
					<button onclick="updatePlaylistDB(<?php echo intval($playlist->idplaylist); ?>)" class="btn btn-success btn-block"><?php echo ___("label_update_playlist"); ?></button>
					<?php } ?>
					<br>
					<button onclick="$('.song-pl').click();" class="btn btn-primary btn-block"><?php echo ___("label_add_all"); ?></button>
				</div>                		

				
	                 
	        </section>
	    </section>
	</aside>
	<aside class="bg-white" style="overflow:none">
		<section class="vbox">
			<header class="header bg-light lt">
				<ul class="nav nav-tabs nav-white">
					<li class="active"><a href="#folders" data-toggle="tab"><?php echo $playlist->name; ?></a></li>                        
				</ul>
			</header>
			<section class="scrollable hover">
				<div class="tab-content ">
					<div class="tab-pane active" id="folders">                        
						<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border" id="list-items">
							
								<?php 
								foreach ($pl as $key => $value) { ?>
								<li class="list-group-item item-<?php echo $key; ?>" data-track="<?php echo addslashes($value->track); ?>" data-artist="<?php echo addslashes($value->artist); ?>" data-cover="<?php echo addslashes($value->cover); ?>">
									<i style="cursor:pointer" onclick="addPlayList('<?php echo addslashes($value->track); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $value->cover; ?>',true);" title="<?php echo ___("label_playnow"); ?>" class="icon-control-play text"></i> <?php echo $value->track; ?> 
									<span class="text-muted"><?php echo $value->artist; ?></span>
									<a href="#">
										<i style="cursor:pointer" class="pull-right song-pl song-pl-<?php echo $playlist->idplaylist; ?>" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->track); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $value->cover; ?>');"><i class="fa fa-plus text"></i></i>                                         
									</a>
									<?php if($editable){ ?>
									<a href="#" >
										<i style="cursor:pointer;margin-right:10px" class="pull-right" onclick="$('.item-<?php echo $key; ?>').remove();"><i class="fa fa-trash-o text"></i></i>                                         
									</a>
									<?php } ?>
								</li>
								<?php } ?>
							
						</ul>
						<div class="clearfix"></div>
						<br>
						<br>
					</div>
				</div>
			</section>
		</section>
	</aside> 
</section>

	         

<?php if($editable){ ?>
<script>
$( "#list-items" ).sortable(
{
	update: function( event, ui ) {savePlayList();},
	items: "li:not(.active)"
});
</script>
<?php } ?>