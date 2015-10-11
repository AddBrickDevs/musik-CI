 <div class="row">
 	<div class="col-xs-12">
	 	<div class="box box-primary">
	 	 	<form role="form" method="POST">
		 		<div class="box-body">
					  <div class="form-group col-md-4">
					    <label >Comment Type</label>
					     <select  name="comment_type" class="form-control">
					    	<option <?php if($this->config->item("comment_type") == 'facebook'){ echo "selected"; } ?> value="facebook">Facebook</option>
					    	<option <?php if($this->config->item("comment_type") == 'disqus'){ echo "selected"; } ?> value="disqus">Disqus</option>					    	
					    </select>
					  </div> 	

					  <div class="form-group col-md-4">
					    <label >Facebook ID Admin</label>
					    <small class="pull-right" > <a href="http://findmyfacebookid.com/">Get My Facebook ID</a></small>
					 
					   	<input name="comment_fb_id" data-role="tagsinput"  type="text" class="form-control" placeholder="Facebook Admin ID" value="<?php echo $this->config->item("comment_fb_id"); ?>">	
					  </div> 
					   <div class="form-group col-md-4">
					    <label >Facebook APP ID</label><small class="pull-right" > <a href="https://developers.facebook.com/apps">Get My App ID</a></small>
					   	<input name="comment_fb_app_id"   type="text" class="form-control" placeholder="Facebook Admin ID" value="<?php echo $this->config->item("comment_fb_app_id"); ?>">	
					  </div>

					  <div class="form-group col-md-4">
					    <label >Disqus Shortname</label>
					    <small class="pull-right" > <a href="https://help.disqus.com/customer/portal/articles/466208-what-s-a-shortname-">What are my shortnames?</a></small>
					   
					   	<input name="comment_disqus_id"   type="text" class="form-control" placeholder="Disqus Shortname" value="<?php echo $this->config->item("comment_disqus_id"); ?>">	
					  </div> 

					  <div class="form-group col-md-4">
					    <label >Comments Box Profile</label>
					     <select  name="comment_profile" class="form-control">
					    	<option <?php if($this->config->item("comment_profile") == '1'){ echo "selected"; } ?> value="1">Yes</option>
					    	<option <?php if($this->config->item("comment_profile") == '0'){ echo "selected"; } ?> value="0">No</option>					    	
					    </select>
					  </div> 

					    <div class="form-group col-md-4">
					    <label >Comments Box Song</label>
					     <select  name="comment_songinfo" class="form-control">
					    	<option <?php if($this->config->item("comment_songinfo") == '1'){ echo "selected"; } ?> value="1">Yes</option>
					    	<option <?php if($this->config->item("comment_songinfo") == '0'){ echo "selected"; } ?> value="0">No</option>					    	
					    </select>
					  </div> 	

					   <div class="form-group col-md-4">
					    <label >Comments Box Artist</label>
					     <select  name="comment_artist" class="form-control">
					    	<option <?php if($this->config->item("comment_artist") == '1'){ echo "selected"; } ?> value="1">Yes</option>
					    	<option <?php if($this->config->item("comment_artist") == '0'){ echo "selected"; } ?> value="0">No</option>					    	
					    </select>
					  </div> 	

					    <div class="form-group col-md-4">
					    <label >Facebook Color Scheme</label>
					     <select  name="comment_facebook_colors" class="form-control">
					    	<option <?php if($this->config->item("comment_facebook_colors") == 'light'){ echo "selected"; } ?> value="light">Light</option>
					    	<option <?php if($this->config->item("comment_facebook_colors") == 'dark'){ echo "selected"; } ?> value="dark">Dark</option>					    	
					    </select>
					  </div> 	

					    <div class="form-group col-md-4">
					    <label >Facebook Fanpage URL</label></small>
					    <input  name="facebook_fanpage" type="text" class="form-control" placeholder="" value="<?php echo $this->config->item("facebook_fanpage"); ?>">					    
					  </div> 

					   <div class="form-group col-md-4">
					    <label >Twitter Username</label></small>
					    <input  name="twitter_username" type="text" class="form-control" placeholder="" value="<?php echo $this->config->item("twitter_username"); ?>">					    
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