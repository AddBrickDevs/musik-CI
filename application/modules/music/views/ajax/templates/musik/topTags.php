<section class="hbox stretch" >
	<aside class="aside bg-light dk" >
		<section class="vbox animated fadeInUp">		
			<section class="scrollable hover">			
				<div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">

				<?php if($this->config->item("genres") != '')
				{
					$tags = explode(",", $this->config->item("genres")); 
					natcasesort($tags);                          
					foreach ($tags as $key => $value) 
					{
					?>
					<a href="<?php echo base_url(); ?>tag/<?php echo econde($value); ?>" onclick="getTopTags('<?php echo encode($value); ?>');"  class="list-group-item removehref">
						<?php echo ucwords(decode($value)); ?>
					</a>                     
					<?php 
					}
				}?>
				</div>
			</section>
		</section>
	</aside>
	<!-- / side content -->
	<section>
		<section class="vbox">
			<section class="scrollable hover padder-lg">
				<h2 class="font-thin m-b"><?php echo $title; ?> 
					<?php
					$item 	= rand(0,count($top->toptracks->track ));
					$name 	= $top->toptracks->track[$item]->name;
					$image 	=  $top->toptracks->track[$item]->image[3]->text;
					if($image == '')
						$image = base_url()."assets/images/no-cover.png";
					?>
					<button onclick="start_radio('<?php echo addslashes($top->toptracks->track[$item]->name); ?>','<?php echo addslashes($top->toptracks->track[$item]->artist->name); ?>','<?php echo $image; ?>')" class="btn btn-xs btn-info pull-right"><i class="fa fa-rss"></i> <?php echo ___('label_start_radio'); ?></button>
				</h2>
				<div class="row row-sm">
					<?php
					foreach ($top->toptracks->track as $key => $value) 
					{
						$image = $value->image[3]->text;
						if($image == '')
							$image = base_url()."assets/images/no-cover.png";
					?>		
					<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" >
						<div class="item">
							<div class="pos-rlt">
								<div class="item-overlay opacity r r-2x bg-black">
									<div class="center text-center m-t-n">
										<a onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);" href="<?php echo base_url(); ?>artist/<?php echo econde($value->artist->name); ?>" class="removehref"><i class="icon-control-play i-2x"></i></a>
									</div>
									<div class="bottom padder m-b-sm">
										<a href="#"  onclick="start_radio('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>')" class="pull-right">
											<i class="fa fa-rss"></i>
										</a>
										<a href="#" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',false);">
											<i class="fa fa-plus-circle"></i>
										</a>
									</div>
								</div>
								<a href="#" >
									<div  style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
										<div style="height:180px;overflow:hidden;"></div>
									</div>
								</a>
							</div>
							<div class="padder-v">
								<a href="#" class="text-ellipsis"><?php echo $value->name; ?></a>
								<a href="#" onClick="getArtistInfo('<?php echo addslashes($value->artist->name); ?>');" data-replace="true" class="text-ellipsis text-xs text-muted"><?php echo $value->artist->name; ?></a>
							</div>
						</div>
					</div>                      
					<?php
					}
					?>  
				</div>               
			</section>                    
		</section>
	</section>
</section>
<script>
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>tag/<?php echo encode($title); ?>");
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