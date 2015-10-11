 <div class="row">
 	<div class="col-xs-12">
	 	<div class="box box-primary">
	 	 	<form role="form" method="POST">
		 		<div class="box-body">
		 			 	<div class="row">
							<div class="col-xs-12">																
						 				<table class="table table-striped table-hover ">
						 					<tr>
						 						<td><strong><i class="fa fa-sitemap"></i> Total Links Sitemap</strong></td>
						 						<td><strong><a href="<?php echo base_url(); ?>sitemap"><?php echo number_format(intval($total),0); ?></a></strong></td>
						 						
						 					</tr>	

						 					<tr>
						 						<td><strong><i class="fa fa-google"></i> Total Links Indexed Google</strong></td>
						 						<td><strong><a href="//google.com.co/#q=site:<?php echo base_url(); ?>"><?php echo number_format(getGoogleLinks(base_url())); ?></a></strong></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Artist Crawled</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap"><?php echo number_format($artist->num_rows()); ?></a></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Tracks Crawled</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap"><?php echo number_format($tracks->num_rows()); ?><a href="<?php echo base_url(); ?>sitemap"></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Pages</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap/pages"><?php echo number_format($pages->num_rows()); ?></a></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Tags</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap/tags"><?php echo number_format(count($tags)); ?></a></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Users</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap/users"><?php echo number_format($users->num_rows()); ?></a></td>
						 					</tr>

						 					<tr>
						 						<td><strong>Total Stations</strong></td>
						 						<td><a href="<?php echo base_url(); ?>sitemap/stations"><?php echo number_format($stations->num_rows()); ?></a></td>
						 					</tr>

						 				</table>			
								
							</div>
						</div>
		 		</div>

			
				<div class="box-footer">				
			  	
				<a target="_blank" href="https://www.google.com/webmasters/tools/sitemap-list?hl=en&siteUrl=<?php echo base_url(); ?>">Check Sitemap on Google Webmaster Tools</a>				
				<br>
				<br>
				<a target="_blank" href="http://support.jodacame.com/knowledge-base/submit-sitemap-to-google">How Can Submit Sitemap to Google?</a>				
				<br>
				<br>				
				</div>
				<div class="clearfix"></div>
			</form>
		</div>	
	</div>
</div>
