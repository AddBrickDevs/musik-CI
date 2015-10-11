 <div class="row">
 	<div class="col-xs-12">
	 	<div class="box box-primary">
	 	 	<form role="form" method="POST">
		 		<div class="box-body">
		 		

					   <div class="form-group col-md-12">
					    <label ><?php echo ___("admin_cover_frame"); ?></label>
					    <select  name="cover_search" class="form-control select-img">
					    <?php
					    
					    for($x=1;$x<=9;$x++){		    	
					    	?>
					    	<option data-img-src='<?php echo base_url(); ?>assets/images/bg-cover<?php echo $x; ?>.png' <?php if($x == $this->config->item("cover_search")){ echo "selected";} ?> value="<?php echo $x; ?>"><?php echo "Cover ".$x; ?></option>
					    	<?php			    		 	
					    }		    
					    ?>
					    </select>
					  </div>


					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_start"); ?></label>
					    <select  name="start" class="form-control select2">
					    	<option <?php if($this->config->item("start") == 'TopArtist'){ echo "selected"; } ?> value="TopArtist"><?php echo ___("label_top_artist"); ?> - Last.fm</option>
					    	<option <?php if($this->config->item("start") == 'TopArtistCustom'){ echo "selected"; } ?> value="TopArtistCustom"><?php echo ___("label_top_artist"); ?> - Custom</option>
					    	<option <?php if($this->config->item("start") == 'TopTracks'){ echo "selected"; } ?> value="TopTracks"><?php echo ___("label_top_tracks"); ?> - Last.fm</option>
					    	<option <?php if($this->config->item("start") == 'TopTracksItunes'){ echo "selected"; } ?> value="TopTracksItunes"><?php echo ___("label_top_tracks"); ?> - iTunes</option>					    						    	
					    	<option <?php if($this->config->item("start") == 'TopTracksActivity'){ echo "selected"; } ?> value="TopTracksActivity"><?php echo ___("label_top_tracks"); ?> - Activity</option>					    	
					    	<option <?php if($this->config->item("start") == 'Activity'){ echo "selected"; } ?> value="Activity"><?php echo ___("label_activity"); ?></option>
					    	<option <?php if($this->config->item("start") == 'SearchBox'){ echo "selected"; } ?> value="SearchBox">Search Box</option>
					    	<optgroup label="Pages">
					    	<?php foreach ($pages->result() as  $row) {
					    		?>
					    		<option  <?php if($this->config->item("start") == "page::{$row->idpage}"){ echo "selected"; } ?> value="page::<?php echo $row->idpage; ?>"><?php echo $row->title; ?></option>
					    		<?php
					    	}
					    	?>
					    	</optgroup>
					    	<optgroup label="Stations">
					    	<?php
					    			$stations = getStations();
									foreach ($stations->result() as $row) {
										$value = $row->idtstation;
										?>
										<option <?php if($this->config->item("start") == "station::$value"){ echo "selected"; } ?>   value="station::<?php echo $value; ?>"><?php echo $row->title; ?></option>
										<?php
									}
									?>
					    	</optgroup>

					    	<optgroup label="Genres">
					    	<?php
					    			$tags 			= json_decode(getTags());
									$tags_current 	= explode(",",$this->config->item("genres"));

									foreach ($tags->toptags->tag as $key => $value) {
										$tmp[] = $value->name;
									}
									sort($tmp);
									foreach ($tmp as $key => $value) {
										?>
										<option <?php if($this->config->item("start") == "genres::$value"){ echo "selected"; } ?>   value="genres::<?php echo $value; ?>"><?php echo ucwords(decode($value)); ?></option>
										<?php
									}
									?>
					    	</optgroup>
					    	<?php
					    	$custom = explode(",", $this->config->item("custom_genres"));
					    	?>
					    	<optgroup label="Custom Genres">
							<?php
							foreach ($custom as $key => $value) {
								?>

								<option  <?php if($this->config->item("start") == "genres::$value"){ echo "selected"; } ?>  value="genres::<?php echo $value; ?>"><?php echo ucwords($value); ?></option>
								<?php
							}
							?></optgroup>
					    </select>
					  </div>

					 <div class="form-group col-md-4">
					    <label >Top Tracks Link</label>
					    <select  name="top_tracks_link" class="form-control">					    	
					    	<option <?php if($this->config->item("top_tracks_link") == 'TopTracks'){ echo "selected"; } ?> value="TopTracks"><?php echo ___("label_top_tracks"); ?> - Last.fm</option>
					    	<option <?php if($this->config->item("top_tracks_link") == 'TopTracksItunes'){ echo "selected"; } ?> value="TopTracksItunes"><?php echo ___("label_top_tracks"); ?> - iTunes</option>					    						    	
					    	<option <?php if($this->config->item("top_tracks_link") == 'TopTracksActivity'){ echo "selected"; } ?> value="TopTracksActivity"><?php echo ___("label_top_tracks"); ?> - Activity</option>					    	
					    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label >Brand Title Link</label>
					     <select  name="brand_link" class="form-control select2">
					    	<option <?php if($this->config->item("brand_link") == 'TopArtist'){ echo "selected"; } ?> value="TopArtist"><?php echo ___("label_top_artist"); ?> - Last.fm</option>
					    	<option <?php if($this->config->item("brand_link") == 'TopArtistCustom'){ echo "selected"; } ?> value="TopArtistCustom"><?php echo ___("label_top_artist"); ?> - Custom</option>
					    	<option <?php if($this->config->item("brand_link") == 'TopTracks'){ echo "selected"; } ?> value="TopTracks"><?php echo ___("label_top_tracks"); ?> - Last.fm</option>
					    	<option <?php if($this->config->item("brand_link") == 'TopTracksItunes'){ echo "selected"; } ?> value="TopTracksItunes"><?php echo ___("label_top_tracks"); ?> - iTunes</option>					    						    	
					    	<option <?php if($this->config->item("brand_link") == 'TopTracksActivity'){ echo "selected"; } ?> value="TopTracksActivity"><?php echo ___("label_top_tracks"); ?> - Activity</option>					    	
					    	<option <?php if($this->config->item("brand_link") == 'Activity'){ echo "selected"; } ?> value="Activity"><?php echo ___("label_activity"); ?></option>
					    	<option <?php if($this->config->item("brand_link") == 'SearchBox'){ echo "selected"; } ?> value="SearchBox">Search Box</option>
					    	<optgroup label="Pages">
					    	<?php foreach ($pages->result() as  $row) {
					    		?>
					    		<option  <?php if($this->config->item("brand_link") == "page::{$row->idpage}"){ echo "selected"; } ?> value="page::<?php echo $row->idpage; ?>"><?php echo $row->title; ?></option>
					    		<?php
					    	}
					    	?>
					    	</optgroup>
					    	<optgroup label="Genres">
					    	<?php
					    			$tags 			= json_decode(getTags());
									$tags_current 	= explode(",",$this->config->item("genres"));

									foreach ($tags->toptags->tag as $key => $value) {
										$tmp[] = $value->name;
									}
									sort($tmp);
									foreach ($tmp as $key => $value) {
										?>
										<option <?php if($this->config->item("brand_link") == "genres::$value"){ echo "selected"; } ?>   value="genres::<?php echo $value; ?>"><?php echo ucwords(decode($value)); ?></option>
										<?php
									}
									?>
					    	</optgroup>
					    	<?php
					    	$custom = explode(",", $this->config->item("custom_genres"));
					    	?>
					    	<optgroup label="Custom Genres">
							<?php
							foreach ($custom as $key => $value) {
								?>

								<option  <?php if($this->config->item("brand_link") == "genres::$value"){ echo "selected"; } ?>  value="genres::<?php echo $value; ?>"><?php echo ucwords($value); ?></option>
								<?php
							}
							?></optgroup>

					    </select>
					  </div>




					  <div class="form-group col-md-4">
					    <label >Left Menu (Only Musik Template)</label>
					    <select name="musik_left_menu" class="form-control">
					    	<option <?php if($this->config->item("musik_left_menu") == 'nav-xs'){ echo "selected"; } ?> value="nav-xs">Close</option>
					    	<option <?php if($this->config->item("musik_left_menu") != 'nav-xs'){ echo "selected"; } ?> value="0">Open</option>		    	
					    </select>
					  </div>  
					  <div class="form-group col-md-4">
					    <label >Sidebar  (Only Musik Template)</label>
					    <select name="musik_sidebar" class="form-control">
					    	<option <?php if($this->config->item("musik_sidebar") == 'hide'){ echo "selected"; } ?> value="hide">Close</option>
					    	<option <?php if($this->config->item("musik_sidebar") != 'hide'){ echo "selected"; } ?> value="">Open</option>		    	
					    </select>
					  </div>     

					  <div class="form-group col-md-4">
					    <label >Force User Register</label>
					    <select name="force_register" class="form-control">
					    	<option <?php if($this->config->item("force_register") == '1'){ echo "selected"; } ?> value="1">Yes</option>
					    	<option <?php if($this->config->item("force_register") == '0'){ echo "selected"; } ?> value="0">No</option>		    	
					    </select>
					  </div>    

					  <div class="form-group col-md-4">
					    <label >Download Mp3 Button</label>
					    <select name="download_button" class="form-control">
					    	<option <?php if($this->config->item("download_button") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("download_button") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>  
					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_export_playlist"); ?></label>
					    <select name="export_playlist" class="form-control">
					    	<option <?php if($this->config->item("export_playlist") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("export_playlist") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_lyrics"); ?></label>
					    <select name="lyrics_button" class="form-control">
					    	<option <?php if($this->config->item("lyrics_button") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("lyrics_button") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_volume"); ?></label>
					    <select name="volume_control" class="form-control">
					    	<option <?php if($this->config->item("volume_control") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("volume_control") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_youtube_button"); ?></label>
					    <select name="youtube_button" class="form-control">
					    	<option <?php if($this->config->item("youtube_button") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("youtube_button") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_random"); ?></label>
					    <select name="random_button" class="form-control">
					    	<option <?php if($this->config->item("random_button") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("random_button") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_search"); ?></label>
					    <select name="search"  class="form-control">
					    	<option <?php if($this->config->item("search") == 'Modern'){ echo "selected"; } ?> value="Modern">Modern</option>
					    	<option <?php if($this->config->item("search") == 'Classic'){ echo "selected"; } ?> value="Classic">Classic</option>		    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label >Start Youtube Video Player</label>
					    <select name="start_youtube"  class="form-control">
					    	<option <?php if($this->config->item("start_youtube") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("start_youtube") == '0'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>   
					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_user_change_lang"); ?></label>
					    <select name="user_change_lang"  class="form-control">
					    	<option <?php if($this->config->item("user_change_lang") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("user_change_lang") == '0'){ echo "selected"; } ?> value="0">Off</option>		    	
					    </select>
					  </div>

					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_items_search"); ?></label>
					    <select name="items_search"  class="form-control">
					    	<?php for($x=1;$x<=30;$x++){ ?>
					    	<option <?php if($this->config->item("items_search") == $x){ echo "selected"; } ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
					    	<?php } ?>
					    	
					    </select>
					  </div> 

					  <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_limit_nplaylist"); ?></label>
					    <select name="nplaylist"  class="form-control">
					    	<?php for($x=1;$x<=5;$x++){ ?>
					    	<option <?php if($this->config->item("nplaylist") == $x){ echo "selected"; } ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
					    	<?php } ?>
					    	
					    </select>
					  </div> 

					   <div class="form-group col-md-4">
					    <label ><?php echo ___("admin_items_top"); ?></label>
					    <select name="items_top"  class="form-control">
					    	<?php for($x=1;$x<=50;$x++){ ?>
					    	<option <?php if($this->config->item("items_top") == $x){ echo "selected"; } ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
					    	<?php } ?>
					    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label >Youtube Video Quality </label>
					    <i class="fa fa-info-circle pull-right" style="cursor:help" title="If quality is not available for the video, then the quality will be set to the next lowest level that is available"></i>
					    <select name="youtube_quality"  class="form-control">
					    	<option <?php if($this->config->item("youtube_quality") == 'small'){ echo "selected"; } ?> value="small">Small</option>					    	
					    	<option <?php if($this->config->item("youtube_quality") == 'medium'){ echo "selected"; } ?> value="medium">Medium</option>					    	
					    	<option <?php if($this->config->item("youtube_quality") == 'large'){ echo "selected"; } ?> value="large">Large</option>					    	
					    	<option <?php if($this->config->item("youtube_quality") == 'hd720'){ echo "selected"; } ?> value="hd720">HD</option>					    	
					    	<option <?php if($this->config->item("youtube_quality") == 'default'){ echo "selected"; } ?> value="default">Auto</option>					    						    	
					    </select>
					  </div>

					   <div class="form-group col-md-4">
					    <label >Youtube Video Controls</label>
					    <select name="youtube_controls"  class="form-control">
					    	<option <?php if($this->config->item("youtube_controls") == '1'){ echo "selected"; } ?> value="1">Show</option>
					    	<option <?php if($this->config->item("youtube_controls") == '0'){ echo "selected"; } ?> value="0">Hide</option>		    	
					    </select>
					  </div>

					  <div class="form-group col-md-4">
					    <label >Popup Guest</label>
					    <select name="popup_guest"  class="form-control">
					    	<option <?php if($this->config->item("popup_guest") == '1'){ echo "selected"; } ?> value="1">Show</option>
					    	<option <?php if($this->config->item("popup_guest") == '0'){ echo "selected"; } ?> value="0">Hide</option>		    	
					    </select>
					  </div>
					  <div class="form-group col-md-4">
					    <label >Box Home Info Guest</label>
					    <select name="box_guest_info"  class="form-control">
					    	<option <?php if($this->config->item("box_guest_info") == '1'){ echo "selected"; } ?> value="1">Show</option>
					    	<option <?php if($this->config->item("box_guest_info") == '0'){ echo "selected"; } ?> value="0">Hide</option>		    	
					    </select>
					  </div>



					


		 		</div>
				<div class="clearfix"></div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary" style="width:100%">Save</button>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>	
	</div>
</div>
 
 <script src="<?php echo base_url(); ?>assets/plugins/image-picker.js"></script>
 

<script>
$(function () {
	$(".select-img").imagepicker();
});
</script>