<div class="row row-sm padder-lg ">
<?php if($this->config->item("ads_refresh") == '1'){ ?>
<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
<?php } ?>

<!--<a href="#" class="pull-right text-muted m-t-lg" data-toggle="class:fa-spin" ><i class="icon-refresh i-lg  inline" id="refresh"></i></a>-->
<h2 class="font-thin m-b"><?php echo ___("label_music_folder"); ?> <?php echo getCountry(); ?> <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
  <span class="bar1 a1 bg-primary lter"></span>
  <span class="bar2 a2 bg-info lt"></span>
  <span class="bar3 a3 bg-success"></span>
  <span class="bar4 a4 bg-warning dk"></span>
  <span class="bar5 a5 bg-danger dker"></span>
</span></h2>
<br>


  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			    <div class="item">
			      <div class="pos-rlt">
			      	<div class="top">                        
                      </div>
			        <div class="bottom">			          
			        </div>
			        <div class="item-overlay opacity r r-2x bg-black">
			       
			          <div class="center text-center m-t-n">
			            <a onClick="$('#savePlaylistModal').modal('show');"  href="#"><i class="icon-plus i-2x"></i></a>
			          </div>
			          <div class="bottom padder m-b-sm ">
			     
			            
			          </div>
			        </div>
			        <a href="#">
			          
			          <div class="r r-2x img-full" style="background:url('<?php echo base_url(); ?>assets/images/no-cover.png') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
			           <div style="height:180px;overflow:hidden;">
			          
			          </div>
			          </div>
			          </a>
			      </div>
			      <div class="padder-v">
			        <a href="#" class="text-ellipsis"><?php echo ___("label_new_playlist"); ?></a>
			        <!--<a href="#" class="text-ellipsis text-xs text-muted">Miaow</a>-->
			      </div>
			    </div>
			  </div>

	

	<?php
	$x=0;
	if ($myplaylist->num_rows() > 0)
	{
	   foreach ($myplaylist->result() as $row)
	   {
	   	$x++;
	   	 $image = base_url()."assets/images/no-cover.png";
	   	$json = json_decode($row->json);
	   	if($json[0]->cover != '')
	   		 $image = $json[0]->cover;

	   	?>				   	
	   		<script type="text/javascript">
					var json<?php echo $x; ?> = "<?php echo str_ireplace('"','\"',$row->json); ?>";
			</script>
			  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			    <div class="item">
			      <div class="pos-rlt">
			      	<div class="bottom">
                        <span class=" m-b-sm m-l-sm badge bg-info"><?php echo count($json); ?> </span>
                      </div>
			        <div class="bottom">
			          <!--<span class="badge bg-info m-l-sm m-b-sm">03:20</span>-->
			        </div>
			        <div class="item-overlay opacity r r-2x bg-black">
			       
			          <div class="center text-center m-t-n">
			            <a onClick="loadPlayListDB(json<?php  echo $x ?>)" href="#"><i class="icon-control-play i-2x"></i></a>
			          </div>
			          <div class="top padder m-t-sm  ">
			            <span class="pull-right">
						         <i  style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo ___("label_share"); ?>">
						    		<i class="fa fa-share-square text"></i>
						    	 </i>
						  		<ul class="dropdown-menu pull-right" role="menu">					   
						    		<li><a href="#" onClick="custom_share('fb','<?php echo base_url()."?playlist=".sha1($this->config->item("encryption_key").intval($row->idplaylist)); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
			                        <li><a href="#" onClick="custom_share('tw','<?php echo base_url()."?playlist=".sha1($this->config->item("encryption_key").intval($row->idplaylist)); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
			                        <li><a href="#" onClick="custom_share('gp','<?php echo base_url()."?playlist=".sha1($this->config->item("encryption_key").intval($row->idplaylist)); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>                              
			                        <li><a href="#" onClick="custom_share('c','<?php echo base_url()."?playlist=".sha1($this->config->item("encryption_key").intval($row->idplaylist)); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>  
						  		</ul>
			            </span>
			          
			          </div>
     				<div class="bottom padder m-b-sm ">
			         
			            <span class="pull-right">
			              <i class="dropdown-toggle" data-toggle="dropdown">
			              	<i class="fa fa-gears"></i>
			              </i>
							  <ul class="dropdown-menu pull-right" role="menu">					   
							    <li  onClick='loadPlayListDB(json<?php  echo $x ?>,true)'><a href="#"><?php echo ___("label_load_append_folder"); ?></a></li>					   	
							    <li onClick='addToPlayListDB(<?php echo intval($row->idplaylist); ?>);'><a href="#"><?php echo ___("label_save_current_into"); ?></a></li>					   						   						    
							    <li data-id="<?php echo intval($row->idplaylist); ?>" class="btn-edit-playlist"><a href="#"><?php echo ___("label_edit_playlist"); ?></a></li>					   						   						    
							    <li class="divider"></li>
							    <li onClick='removeFolder(<?php echo intval($row->idplaylist); ?>);'><a style="color:#FF4F4F !important" href="#"><?php echo ___("label_remove_folder"); ?></a></li>
							  </ul>
					
			            </span>
			          </div>
			        </div>
			        <a href="#">
			          
			          <div class="r r-2x img-full" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
			           <div style="height:180px;overflow:hidden;">
			          
			          </div>
			          </div>
			          </a>
			      </div>
			      <div class="padder-v">
			        <a href="#" class="text-ellipsis"><?php echo $row->name; ?></a>
			        <!--<a href="#" class="text-ellipsis text-xs text-muted">Miaow</a>-->
			      </div>
			    </div>
			  </div>




		
	      	      
	      <?php
	   }
	}
	?>
</div>

