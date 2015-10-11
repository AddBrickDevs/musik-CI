<div class="row padder-lg ">
                <div class="col-sm-12">
                  <div class="panel wrapper-lg">
                    <div class="row">
                      <div class="col-sm-12">

								<?php if($this->config->item("ads_refresh") == '1'){ ?>
								<center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></center><br><br>
								<?php } ?>
								<div class="row">
									<div class="col-md-3">
										<img class="img-responsive thumbnail" style="width:100%;" src="<?php echo $artist->artist->image[3]->text; ?>">
									</div>
									<div class="col-md-9">
										<h2 class="font-thin m-b"><?php echo $artist->artist->name; ?></h2>
										<p><?php echo str_ireplace("</a","</span",str_ireplace("<a", "<span", $artist->artist->bio->content)); ?></p>
										<?php foreach ($artist->artist->tags->tag as $key => $value) {
											?>
											<span  onClick="getTopTags('<?php echo $value->name; ?>');" class="label label-primary artistInfo cursor-pointer"><?php echo $value->name; ?></span>
											<?php
										}
										?>
										<div class="clearfix"></div>
										<br>
										<button class="btn btn-info" onclick="getArtistInfo('<?php echo addslashes($artist->artist->name); ?>')">Top Tracks</button>		
									</div>
								</div>
								<div class="page-header">
								 	<h1 class="font-thin m-b">Top Albums</h1>
								 </div>
								<div class="row">
								<?php
								foreach ($albums->topalbums->album as $key => $value) {
									$image = $value->image[3]->text;
										if($image == '')
											$image = base_url()."assets/images/no-cover.png";
									?>		


									<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
										    <div class="item">
										      <div class="pos-rlt">
										        <div class="bottom">
										          <!--<span class="badge bg-info m-l-sm m-b-sm">03:20</span>-->
										        </div>
										        <div class="item-overlay opacity r r-2x bg-black">
										        
										             
												          <div class="center text-center m-t-n">
												            <a   onclick="getTracksAlbum('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>');" href="#"><i class="icon-info i-2x"></i></a>
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
										        <a href="#" class="text-ellipsis"  onclick="getTracksAlbum('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>');"><?php echo $value->name; ?></a>
										        <a href="#" class="text-ellipsis text-xs text-muted"  onClick="getArtistInfo('<?php echo $value->artist->name; ?>');" title=<?php echo ___("label_get_artist_info"); ?>><?php echo $value->artist->name; ?></a>
										      </div>
										    </div>
										</div>





								<?php
								}
								?>
								</div>
							</div>
					</div>
				</div>
			</div>
</div>
