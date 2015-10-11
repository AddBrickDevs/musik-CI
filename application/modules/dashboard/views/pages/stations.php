<?php 
$items = getStations(); 
if($edit)
{
	$edit = $edit->result_array();
	$edit = $edit[0];
}

?>
 <div class="row">
 	<div class="col-md-12">
	 	<div class="box box-warning">	 	 	
	 	 		<div class="box-header">
	 	 			<h3 class="box-title"><i class="fa fa-picture-o"></i> New Station Streaming</h3>
	 	 		</div>
		 		<div class="box-body">		 
                <?php if(file_exists('./application/modules/music/controllers/musik.php')){ ?>			
		 			<form role="form" enctype="multipart/form-data"  method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required name="title" class="form-control" id="title" value="<?php echo $edit['title']; ?>" placeholder="">
                            </div>

                             <div class="form-group">
                                <label for="m3u">M3U Url</label>
                                <input type="text" required name="m3u" class="form-control" id="m3u" value="<?php echo $edit['m3u']; ?>"  placeholder="">
                            </div>

                           <div class="form-group">
                                <label for="description">Description</label>
                                <textarea  name="description" class="form-control tinymce" value=""  id="description" placeholder=""><?php echo $edit['description']; ?></textarea>
                            </div>

                            <div class="form-group">
							    <label >Keywords Search</label>
							    <i class="fa fa-info-circle pull-right" style="cursor:help" title="This is not visible, is used to when users search"></i>
							    <input  data-role="tagsinput" name="keywords" type="text" value="<?php echo $edit['keywords']; ?>" class="form-control" placeholder="Artists Name, Tracks Names, Albums Name, etc.." value="">
							  </div>


                   

							<?php if(!$edit) { ?>
                            <div class="form-group">
                                <label for="cover">Cover</label>
                                <input name="upload" class="file" data-show-preview="true" data-show-upload="false" accept="image/png, image/jpeg, image/jpg" type="file" id="cover">
                                <p class="help-block text-success">Recomended: 300x200 Pixels</p>
                            </div>      
                            <?php } ?>
                             

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </div>
                    </form>
                    <?php }else{ ?>
                    <br>
                    <div class="alert alert-danger">
                        <strong>Module Require:</strong> Musik Extend For Youtube Music Engine
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
				</div>
		</div>
	</div>
</div>		 	

<div class="row">
	<?php foreach ($items->result() as $row) {
		?>
		<div class="col-md-3 col-xs-6">
		    <div class="thumbnail">
		      <img src="<?php echo base_url(); ?>uploads/stations/<?php echo $row->cover; ?>">
		      <div class="caption text-center">
		      
		        <h3><?php echo $row->title; ?></h3>		      
		        
		        <p>
		        
		        <a href="<?php echo base_url(); ?>dashboard/stations/remove/<?php echo $row->idtstation; ?>" class="btn btn-danger btn-block" role="button"><i class="fa fa-trash-o"></i> Delete</a>                
		        <a href="<?php echo base_url(); ?>dashboard/stations/edit/<?php echo $row->idtstation; ?>" class="btn btn-info btn-block" role="button"><i class="fa fa-pencil"></i> Edit</a>                
		        </p>		        
		        <div class="clearfix"></div>
		      </div>
		    </div>
	  </div>
	  <?php
	}
	?>

</div>

