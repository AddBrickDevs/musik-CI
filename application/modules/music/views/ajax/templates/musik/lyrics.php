<div class="row-sm padder-lg text-center">
	<?php if($this->config->item("ads_refresh") == '1'){ ?>
	<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
	<?php } ?>
	<div class="page-header">
	 	<h1 ><?php echo ___("label_lyrics"); ?> - <?php echo $title; ?>'</h1>
	 </div> 
	
		<div class="col-xs-12">	  
		  <p><?php echo $lyrics->lyric; ?></p>
		</div>

</div>
<div class="clearfix"></div>