<?php
$temp = $page->result_array();
$p = $temp[0];
?>
<div class="row row-sm padder-lg " style="margin-top:20px;">
	<?php if($this->config->item("ads_refresh") == '1'){ ?>
	<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
	<?php } ?>

		<div class="col-xs-12">
			 <div class="blog-post">                   
                <div class="post-item">		
    	      		<div class="caption wrapper-lg">
        	      		<h2 class="post-title"><?php echo $p["title"]; ?></h2>                    		 
						<?php echo processShortCode($p['content']); ?>
					</div>
				</div>				
			</div>		
		</div>
	
</div>
<?php if($this->input->is_ajax_request()){ ?>
<script>
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>page/<?php echo $p['idpage']; ?>-<?php echo encode2($p['title']); ?>");
</script>
<?php } ?>