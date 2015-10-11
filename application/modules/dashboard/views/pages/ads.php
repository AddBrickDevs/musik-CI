 <div class="row">
 	<div class="col-xs-12">
	 	<div class="box box-primary">
	 	 	<form role="form" method="POST">
		 		<div class="box-body">
		 			 <div class="form-group col-md-6">
					    <label ><?php echo ___("admin_popup_advertising"); ?></label>
					    <select name="popup" class="form-control">
					    	<option <?php if($this->config->item("popup") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("popup") != '1'){ echo "selected"; } ?> value="0">Off</option>
					    </select>
					  </div>
					  <div class="form-group col-md-6">
					    <label ><?php echo ___("admin_ads_refresh"); ?></label>
					    <select name="ads_refresh" class="form-control">
					    	<option <?php if($this->config->item("ads_refresh") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("ads_refresh") != '1'){ echo "selected"; } ?> value="0">Off</option>
					    </select>
					  </div>

					   <div class="form-group col-md-12">
					    <label ><?php echo ___("admin_popup_advertising_code"); ?></label>
					    <textarea  rows="3" name="popup_code" class="form-control"><?php echo $this->config->item("popup_code"); ?></textarea>
					  </div>
					    <div class="form-group col-md-12">
					    <label >Advertising Header Code</label>
					    <textarea rows="3" name="ads_block" class="form-control"><?php echo $this->config->item("ads_block"); ?></textarea>
					  </div>
					    <div class="form-group col-md-12">
					    <label >Advertising Footer Code</label>
					    <textarea rows="3" name="ads_block_footer" class="form-control"><?php echo $this->config->item("ads_block_footer"); ?></textarea>
					  </div>  

					   <div class="form-group col-md-12">
					    <label >Advertising Sidebar (Only Musik Module)</label>
					    <textarea rows="3" name="ads_block_sidebar" class="form-control"><?php echo $this->config->item("ads_block_sidebar"); ?></textarea>
					  </div>

					  <div class="form-group col-md-6">
					    <label ><?php echo ___("admin_audio_ads"); ?></label>
					    <input name="audio_ads"  data-role="tagsinput" type="text" class="form-control" placeholder="Youtube Video ID" value="<?php echo $this->config->item("audio_ads"); ?>">
					    <span class="inline-helper">
					    	Example: https://www.youtube.com/watch?v=<span class='text-danger'>pDj8QYigFnw</span>
					    </span>
					  </div> 	

					  <div class="form-group col-md-6">
					    <label >Hide ADS To Registered Users</label>
					    <select name="hide_ads_registered" class="form-control">
					    	<option <?php if($this->config->item("hide_ads_registered") == '1'){ echo "selected"; } ?> value="1">On</option>
					    	<option <?php if($this->config->item("hide_ads_registered") != '1'){ echo "selected"; } ?> value="0">Off</option>		    	
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
