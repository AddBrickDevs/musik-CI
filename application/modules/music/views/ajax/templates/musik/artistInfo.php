<?php

	$itemRand = rand(0,count($toptracks->toptracks->track));

	if(count($toptracks->toptracks->track) == 0)
	{
		?>
		<div class="alert alert-info">
			<strong><?php echo ___("label_artist"); ?>!</strong>  No Found!
		</div>
		<?php		
	}
	if(count($toptracks->toptracks->track) == 1)
	{
		$image = @$toptracks->toptracks->track->image[3]->text;
		$top = $toptracks->toptracks->track;
	}
	else
	{
		$image = @$toptracks->toptracks->track[$itemRand]->image[3]->text;
		$top = $toptracks->toptracks->track[$itemRand];
	}
	if($image == '')
		$image = base_url()."assets/images/no-cover.png";

?>
<br>
<br>
   <?php if($this->config->item("ads_refresh") == '1'){ ?>
<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
<?php } ?>

<?php
if(count($toptracks->toptracks->track) > 0)
{
?>

<div class="row padder-lg " itemscope itemtype="http://schema.org/MusicGroup">
                <div class="col-sm-12">
                  <div class="panel wrapper-lg">
                    <div class="row">
                      <div class="col-md-5">
                        <img  itemprop="logo" src="<?php echo $artist->artist->image[3]->text; ?>" class="img-full m-b">
                      </div>
                      <div class="col-sm-7">
                        <h2 class="m-t-none text-black" itemprop="name"><?php echo $artist->artist->name; ?></h2>                        
                        <div class="m-b-lg">
                          		<button class="btn btn-primary" onclick="start_radio('<?php echo addslashes($top->name); ?>','<?php echo addslashes($artist->artist->name); ?>','<?php echo $image; ?>')"><i class="fa fa-rss"></i> <?php echo ___("label_start_radio"); ?></button>
                          		<button class="btn btn-primary btn-playlist-artist" data-artist="<?php echo addslashes($artist->artist->name); ?>" ><i class="fa fa-music"></i> <?php echo ___("label_artist_playlist"); ?></button>
								<!--<button class="btn btn-default" onclick="getAlbums('<?php echo addslashes($artist->artist->name); ?>')"><i class="fa fa-folder-o"></i> <?php echo ___("label_album"); ?></button>-->
								<button class="btn btn-default" onclick="getEvents('<?php echo addslashes($artist->artist->name); ?>')"><i class="fa fa-bullhorn"></i> <?php echo ___("label_events"); ?></button>
								<button class="btn btn-default btn-albums" data-artist="<?php echo addslashes($artist->artist->name); ?>"><i class="fa fa-folder-o"></i> <?php echo ___("label_album"); ?></button>
								<div class="btn-group">
								    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								      <i class="fa fa-share-square"></i> <?php echo ___("label_share"); ?>
								      <span class="caret"></span>
								    </button>
								    <ul class="dropdown-menu">
								       	<li><a href="#" onClick="custom_share('fb','<?php echo base_url()."artist/".addslashes(encode2($artist->artist->name)); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
						               	<li><a href="#" onClick="custom_share('tw','<?php echo base_url()."artist/".addslashes(encode2($artist->artist->name)); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
						               	<li><a href="#" onClick="custom_share('gp','<?php echo base_url()."artist/".addslashes(encode2($artist->artist->name)); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
						               	<li><a href="#" onClick="custom_share('c','<?php echo base_url()."artist/".addslashes(encode2($artist->artist->name)); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   
								    </ul>
								  </div>
                        </div>
                        <div>                          
                          <?php foreach ($artist->artist->tags->tag as $key => $value) {
							?>
								<a href="<?php echo base_url(); ?>tag/<?php echo $value->name; ?>" onClick="getTopTags('<?php echo $value->name; ?>');" class="badge bg-light removehref"><?php echo $value->name; ?></a>
								<?php
							}
							?>
                        </div>
                        <br>
                        <div class="m-t" itemscope itemtype="http://schema.org/Review">
                        <p itemprop="about" >

                        	<?php echo str_ireplace("</a","</span",str_ireplace("<a", "<span", $artist->artist->bio->content)); ?>
                        </p>
                        </div>
                      </div>
                    </div>

                    
              
                   <h4 class="m-t-lg m-b"><?php echo ___("label_related_artist"); ?></h4>
                   <div class="row">
                    
                    <?php
							$x=0;							

							foreach ($artist->artist->similar->artist as $key => $value) {
								$image = $value->image[3]->text;
									if($image == '')
										$image = base_url()."assets/images/no-cover.png";
								if($value->name != '' && $x<10)
								{
									$x++;
								?>		
					
								<div class="col-md-4">
							   		<article class="media">
				                        <a href="#" class="pull-left thumb-md m-t-xs">
				                          <div class="thumbnail" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
								    			<div style="height:40px;overflow:hidden;">
								      		
								      			</div>
							      			</div>
				                        </a>
				                        <div class="media-body">                        
				                          <a href="<?php echo base_url(); ?>artist/<?php echo econde($value->name); ?>"  onClick="getArtistInfo('<?php echo $value->name; ?>');" class="font-semibold removehref"><?php echo $value->name; ?></a>
				                          <div class="text-xs block m-t-xs"><a  onClick="getArtistInfo('<?php echo $value->name; ?>');" href="#"><?php echo ___("label_artist_info"); ?></a></div>
				                        </div>
				                      </article>
				                   </div>

							<?php
								}
							}
						?>
                  
             
               	</div>

            
                    <h4 class="m-t-lg m-b"><?php echo ___("label_top_tracks"); ?> <button class="btn btn-success btn-xs pull-right" onclick="addAlltoPlaylist()"><i class="fa fa-plus"></i> <?php echo ___("label_add_all"); ?></button> </h4>

                    <ul class="list-group list-group-lg">

                    <?php
                    	$x=0;
						foreach ($toptracks->toptracks->track as $key => $value) {
							$x++;
							$image = $value->image[3]->text;
							if($image == '')
								$image = $value->image[2]->text;
							if($image == '')		
								$image = $value->image[1]->text;
							if($image == '')
								$image = base_url()."assets/images/no-cover.png";
							if($value->name != '')
							{
								$duration = intval(count($toptracks->toptracks->track)+intval(count($toptracks->toptracks->track)+$x/2))+$x;
								if($duration <10)
									$duration = '0'.$duration;

								if($duration)
							?>	
							<li class="list-group-item" itemprop="tracks" itemscope itemtype="http://schema.org/MusicRecording">			
								
							  <a href="<?php echo base_url(); ?>?artist=<?php echo $value->artist->name; ?>&track=<?php echo $value->name; ?>"  onClick="return false;" class=" removehref hide"  itemprop="url"><span  itemprop="name"><?php echo $value->name; ?></span></a>
							  	<div class="pull-right m-l">		                          
		                          <a href="#" class="m-r-sm btn-download-mp3" data-artist="<?php echo addslashes($value->artist->name); ?>" data-track="<?php echo addslashes($value->name); ?>" data-cover="<?php echo $image; ?>"><i class="icon-cloud-download"></i></a>		                          
		                        </div>

		                        <div class="pull-right m-l">		                          
		                          <a href="#" class="m-r-sm addTrg" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>');"><i class="icon-plus"></i></a>		                          
		                        </div>
		                        <div class="pull-right m-l">		                          
		                          <a href="#" class="m-r-sm" onclick="getSongInfo('<?php echo addslashes($value->artist->name); ?>','<?php echo addslashes($value->name); ?>');"><i class="icon-info"></i></a>		                          
		                        </div>
		                        <a  href="<?php echo base_url(); ?>?artist=<?php echo $value->artist->name; ?>&track=<?php echo $value->name; ?>"   itemprop="audio" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);" class="removehref jp-play-me m-r-sm pull-left">
		                          <i class="icon-control-play text"></i>		                          
		                        </a>
		                        <div class="clear text-ellipsis">
		                        	<meta itemprop="duration" content="PT3M<?php echo $duration; ?>S" />
		                          <span><?php echo $value->name; ?></span>		                          
		                        </div>
		                      </a>
		                      </li>
				
						 
						<?php
							}
						}
						?>                    
                    </ul>
                    
                    <section>
                       <article>
                      		<?php echo comments('artist'); ?>
                      	</article>
                    </section>                  
              
                  </div>
                </div>
              
              </div>
</div>
<?php } ?>
<script>
$(function () {
$(".removehref").attr("href","#");	
});
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>artist/<?php echo encode2($artist->artist->name); ?>");
try{
	$(".removehref").attr("href","#");
}catch(e)
{

}
</script>
