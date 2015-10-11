 <div class="row">
 	<div class="col-xs-12">
	 	<div class="box box-primary">
	 	 	<form role="form" method="POST">
		 		<div class="box-body">
		 			 	<div class="row">
							<div class="col-xs-12">								
									  <?php if(@intval($license->verify->item_id) > 0){ ?>
									  <div class="alert alert-success">Purchase Code is Valid!</div>
									  <?php }else{ ?>
						 				<div class="alert alert-danger">Purchase Code Not is Valid!</div>
						 				<?php } ?>
						 				<table class="table table-striped table-hover ">
						 					<tr>
						 						<td><strong>Item Name</strong></td>
						 						<td><?php echo @$license->verify->item_name; ?></td>
						 					</tr>
						 					<tr>
						 						<td><strong>Purchase Code</strong></td>
						 						<td class="text-success"><?php echo @$this->config->item("purchase_code"); ?></td>
						 					</tr>
						 					<tr>
						 						<td><strong>Purchase Date</strong></td>
						 						<td><?php echo @$license->verify->created_at; ?></td>
						 					</tr>
						 					<tr>
						 						<td><strong>Buyer</strong></td>
						 						<td><?php echo @$license->verify->buyer; ?></td>
						 					</tr>
						 					<tr>
						 						<td><strong>License</strong></td>
						 						<td><?php echo @$license->verify->licence; ?></td>
						 					</tr>
						 					<tr>
						 						<td><strong>Server</strong></td>
						 						<td><?php echo $this->input->server('SERVER_ADDR'); ?> - <?php echo $this->input->server('SERVER_SOFTWARE'); ?>  </td>
						 					</tr>
						 					<tr>
						 						<td><strong>Need Support?</strong></td>
						 						<td><a href="http://support.jodacame.com">http://support.jodacame.com</a></td>
						 					</tr>
						 				</table>			
								
							</div>
						</div>
		 		</div>

			
				<div class="box-footer">
					
			  	<?php echo $error; ?>	
				<input maxlength="150" type="text" required name="purchase_code" class="form-control"  style="width:100%" placeholder="Purchase Code">
				<br>
				<a target="_blank" href="http://support.jodacame.com/knowledge-base/where-i-can-get-envato-purchase-code">Where's my CodeCanyon "Item Purchase Code"?</a>				
				<br>
				<br>
				<button type="submit" class="btn btn-primary" style="width:100%">Save</button>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>	
	</div>
</div>
