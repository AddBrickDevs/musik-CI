<div class="row padder-lg ">
                <div class="col-sm-12">
                  <div class="panel wrapper-lg">
                    <div class="row">
                      <div class="col-sm-12">

<?php
$itemRand = rand(0,count($album->album->tracks->track));
  $image =$album->album->image[3]->text;
  if($image == '')
    $image = base_url()."assets/images/no-cover.png";
?>
<?php if($this->config->item("ads_refresh") == '1'){ ?>
<center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></center><br><br>
<?php } ?>

<div class="row" >
  <div class="col-md-2">
  <img class="img-responsive thumbnail" style="width:100%;" src="<?php echo $image; ?>">
  </div>
  <div class="col-md-10">
    <h2 class="font-thin m-b artistInfo cursor-pointer" onClick="getArtistInfo('<?php echo $album->album->artist; ?>');"><?php echo $album->album->artist; ?></h2>
    <h3><i class="fa fa-folder-o"></i> <?php echo $album->album->name; ?></h3>    
    <?php foreach ($album->album->toptags->tag as $key => $value) {
      ?>
      <span onClick="getTopTags('<?php echo $value->name; ?>');" class="label label-primary  cursor-pointer artistInfo"><?php echo $value->name; ?></span>
      <?php
    }
    ?>
    <div class="clearfix"></div>
    <br>
    <button class="btn btn-primary" onclick="start_radio('<?php echo addslashes($album->album->tracks->track[$itemRand]->name); ?>','<?php echo addslashes($album->album->artist); ?>','<?php echo $image; ?>')"><i class="fa fa-rss"></i> <?php echo ___("label_start_radio"); ?></button>    
  </div>  
</div>


 	<h1 class="font-thin m-b">Tracks <button class="btn btn-info btn-xs pull-right" onclick="addAlltoPlaylist()"><i class="fa fa-plus"></i> <?php echo ___("label_add_all"); ?></button></h1>

<div class="row">
<ul class="list-group list-group-lg">
<?php
foreach ($album->album->tracks->track as $key => $value) {

	?>		
  <!--<div class="col-xs-12 col-md-4 col-lg-3">
    <div class="thumbnail" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
    	<div style="height:180px;overflow:hidden;">
      		
      	</div>
      <div class="caption">
        <h4 class="truncate"><?php echo $value->name; ?></h4>      
        <p class="artistInfo" onClick="getArtistInfo('<?php echo $value->artist->name; ?>');" title=<?php echo ___("label_get_artist_info"); ?>><?php echo $value->artist->name; ?></p>      
        <p>
        	<button class="btn btn-primary addTrg" style="width:45%" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>');"><i class="fa fa-plus"></i></button>                                         
            <button class="btn btn-primary pull-right" style="width:45%" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);"><i class="fa fa-play"></i></button>                                         
        </p>
      </div>
    </div>
  </div>-->
   <div onClick="return false;" class="list-group-item">
      <a href="#" class="btn-track-info" data-artist="<?php echo $album->album->artist; ?>" data-track="<?php echo $value->name; ?>"><?php echo $value->name; ?></a>

     <div class="pull-right m-l">                             
        <a href="#" class="m-r-sm addTrg" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>');"><i class="icon-plus"></i></a>                             
      </div>

      <div class="pull-right m-l">                              
              <a href="#" class="m-r-sm"  onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);"><i class="icon-control-play text"></i></a>                             
            </div>


    </div>	
<?php
}
?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>


