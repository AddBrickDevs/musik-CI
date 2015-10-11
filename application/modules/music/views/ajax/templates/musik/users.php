<div class="row padder-lg " style="padding-top:20px">
	<?php 
	if($users->num_rows()>0)
	{
		foreach ($users->result() as $row) {
			?>
			<div class="col-md-4">
					<section class="panel panel-info">
                        <div class="panel-body">
                          <a href="#" class="thumb pull-right m-l m-t-xs avatar btn-profile" data-user="<?php echo $row->nickname; ?>">
                            <img src="<?php echo $row->avatar; ?>" alt="...">                            
                          </a>
                          <div class="clear">
                            <a href="#" class="text-info btn-profile" data-user="<?php echo $row->nickname; ?>"><?php echo $row->nickname; ?></a>
                            <small class="block text-muted truncate"><?php echo more($row->bio,200); ?></small>
                            <?php echo getFollowButton($row->id,$row->nickname,'xs'); ?>
                          </div>
                        </div>
                      </section>
             </div>
			<?php
		}
	}
	else
	{
		?>
		<div class="alert alert-info">
		<strong><?php echo $user; ?></strong> <?php echo ___("msg_no_found_users"); ?>
		</div>
		<?php
	}
	?>
</div>