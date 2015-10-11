<div class="row row-sm padder-lg ">

<div class="clearfix"></div>
<?php if($this->config->item("ads_refresh") == '1'){ ?>
<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
<?php } ?>
<div style="clearfix"></div>
<br>

  <div class="btn-group">
      <button onclick="$('#lyrics-result').slideToggle();" class="btn btn-xs btn-default" id="lyrics-search-btn" style="display:none"><?php echo ___("label_lyrics"); ?> <span class="badge badge-sm  badge-danger">0</span></button>
      <button onclick="$('#stations-result').slideToggle();" class="btn btn-xs btn-default" id="stations-search-btn" style="display:none"><?php echo ___("label_stations"); ?> <span class="badge badge-sm  badge-danger">0</span></button>
      <button onclick="$('#playlist-result').slideToggle();" class="btn btn-xs btn-default" id="playlist-search-btn" style="display:none"><?php echo ___("label_playlist"); ?> <span class="badge badge-sm  badge-danger">0</span></button>
  </div>

<div class="pull-right">

  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-share-square"></i> <?php echo ___("label_share"); ?>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
      <li><a href="#" onClick="custom_share('fb','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
          <li><a href="#" onClick="custom_share('tw','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
          <li><a href="#" onClick="custom_share('gp','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
          <li><a href="#" onClick="custom_share('c','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   

  </ul>
</div>
<?php
$stations = search_stations($query);
if($stations->num_rows > 0)
{
?>
  <script>
  $("#stations-search-btn").show();
  $("#stations-search-btn span").text('<?php echo number_format($stations->num_rows()); ?>');
  </script>

<div id="stations-result" style="display:none;padding:0px">
<h2 class="font-thin m-b"><?php echo ___("label_stations"); ?> </h2>
<?php
 foreach ($stations->result() as $row) 
{   
 $image = base_url()."uploads/stations/".$row->cover;
                ?>
<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 btn-start-station" data-id="<?php echo $row->idtstation; ?>" data-cover="<?php echo $image; ?>" data-title="<?php echo $row->title; ?>" data-station="<?php echo $row->m3u; ?>">
    <div class="item">
        <div class="pos-rlt">                    
            <div class="item-overlay opacity r r-2x bg-black">
                <div class="center text-center m-t-n">
                    <a href="#"><i class="icon-control-play i-2x"></i></a>
                </div>                      
            </div>
            <a href="#">
                <div class="r r-2x img-full" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                    <div style="height:180px;overflow:hidden;"></div>
                </div>
            </a>
        </div>
        <div class="padder-v">
            <a href="#" class="text-ellipsis"><?php echo $row->title; ?></a>
           
        </div>
    </div>
</div>
    <?php
    }
?>
</div>
<div class="clearfix"></div>
<?php
} ?>

<?php
$playlist = search_playlist($query);
if($playlist->num_rows() > 0)
{

  ?>
  <script>
  $("#playlist-search-btn").show();
  $("#playlist-search-btn span").text('<?php echo number_format($playlist->num_rows()); ?>');
  </script>
  <div id="playlist-result" style="display:none;padding:0px">
  <h2 class="font-thin m-b"><?php echo ___("label_playlist"); ?> </h2>

  <?php 
     $picture = base_url()."assets/images/no-cover.png";
   foreach ($playlist->result() as $row) 
    {  ?>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 btn-edit-playlist" data-id="<?php echo $row->idplaylist; ?>">
            <div class="item">
                <div class="pos-rlt">                    
                    <div class="item-overlay opacity r r-2x bg-black">
                        <div class="center text-center m-t-n">
                            <a href="#"><i class="fa fa-list-ul i-2x"></i></a>
                        </div>                      
                    </div>
                    <a href="#">
                        <div class="r r-2x img-full" style="background:url('<?php echo $row->avatar; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                            <div style="height:180px;overflow:hidden;"></div>
                        </div>
                    </a>
                </div>
                <div class="padder-v">
                    <a href="#" class="text-ellipsis"><?php echo $row->name; ?></a>
                    <a href="#" class="text-ellipsis text-muted"><i class="fa fa-user"></i> <?php echo $row->nickname; ?></a>
                   
                </div>
            </div>
        </div>

                      <?php 
    }
    ?>  </div><div class="clearfix"></div><?php 
}

?>
<?php
$lyrics = search_lyrics($query);
if($lyrics->num_rows() > 0)
{

  ?>
  <script>
  $("#lyrics-search-btn").show();
  $("#lyrics-search-btn span").text('<?php echo number_format($lyrics->num_rows()); ?>');
  </script>
  <div id="lyrics-result" style="display:none;padding:0px">
  <h2 class="font-thin m-b"><?php echo ___("label_lyrics"); ?> </h2>
  <ul class="list-group list-group-lg">
  <?php 
     $picture = base_url()."assets/images/no-cover.png";
   foreach ($lyrics->result() as $row) 
    {  ?>
                  <li class="list-group-item">
                        <div class="pull-right m-l">                          
                          <a href="#" class="m-r-sm btn-play"  data-track="<?php echo addslashes($row->track); ?>" data-artist="<?php echo addslashes($row->artist); ?>" data-cover="<?php echo $picture; ?>" ><i class="icon-plus"></i></a>                          
                          <a href="#" class="jp-play-me m-r-sm pull-left btn-song-info" data-track="<?php echo addslashes($row->track); ?>" data-artist="<?php echo addslashes($row->artist); ?>">
                          <i class="fa fa-align-center text"></i>                          
                        </a>
                        </div>
                        <a href="#" class="jp-play-me m-r-sm pull-left btn-play-now" data-track="<?php echo addslashes($row->track); ?>" data-artist="<?php echo addslashes($row->artist); ?>" data-cover="<?php echo $picture; ?>">
                          <i class="icon-control-play text"></i>                          
                        </a>
                        

                        <div class="clear text-ellipsis">
                          <span class="cursor-pointer btn-track-info" data-artist="<?php echo addslashes($row->artist); ?>" data-track="<?php echo addslashes($row->track); ?>"><?php echo $row->track; ?></span>
                          <span class="text-muted btn-artist-info cursor-pointer" data-artist="<?php echo addslashes($row->artist); ?>">  - <?php echo $row->artist; ?></span>
                          
                        </div>
                      </li>

                      <?php 
    }
    ?>  </ul></div><div class="clearfix"></div><?php 
}
?>


<h2 class="font-thin m-b"><?php echo ___("label_search"); ?>: <?php echo decode($query); ?>  <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
  <span class="bar1 a1 bg-primary lter"></span>
  <span class="bar2 a2 bg-info lt"></span>
  <span class="bar3 a3 bg-success"></span>
  <span class="bar4 a4 bg-warning dk"></span>
  <span class="bar5 a5 bg-danger dker"></span>
</span>


</h2>
<br>




<div  itemscope itemtype="http://schema.org/MusicGroup">
<?php
if($this->config->item("search") != 'Modern')
{
  ?><ul class="list-group list-group-lg"><?php
}
?>
 
    <?php 
    if(count($search->results->trackmatches->track) == 0)
    {
        ?>
        <div class="alert alert-info">
            <strong><?php echo $query ?></strong>  No Found!
        </div>
        <?php
    }   
    if(count($search->results->trackmatches->track)>1)
        $search_a = $search->results->trackmatches->track;
    if(count($search->results->trackmatches->track)==1)
        $search_a[0] = $search->results->trackmatches->track;


    foreach ($search_a as $key => $value) {
        $picture = $value->image[3]->text;
        if($picture == '')
           $picture = base_url()."assets/images/no-cover.png";
       if($value->name != '')
        {
               if($this->config->item("search") == 'Modern')
               {
                $radius = '';
                if($this->config->item("cover_search") == 4)
                    $radius = 'border-radius:50%;';

                
                ?>

                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2" itemprop="tracks" itemscope itemtype="http://schema.org/MusicRecording">
                         <meta itemprop="duration" content="PT4M<?php echo rand(10,59); ?>S" />
                        <div class="item">
                          <div class="pos-rlt">                            
                            <div class="item-overlay opacity r r-2x bg-black">

                             <div class="top padder m-t-sm">
                                
                                <a  class="btn-download-mp3" href="#" data-artist="<?php echo addslashes($value->artist); ?>" data-track="<?php echo addslashes($value->name); ?>" data-cover="<?php echo $picture; ?>">
                                  <i class="fa fa-cloud-download"></i>
                                </a>
                              </div>
                            

                            
                              <div class="center text-center m-t-n">
                                <a itemprop="audio" href="<?php echo base_url(); ?>?artist=<?php echo $value->artist; ?>&track=<?php echo $value->name; ?>" class="removehref" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>',true);" href="#"><i class="icon-control-play i-2x"></i></a>
                              </div>
                              <div class="bottom padder m-b-sm">
                                <a onclick="start_radio('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>')" href="#" class="pull-right">
                                  <i class="fa fa-rss"></i>
                                </a>
                                <a  href="#" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>');">
                                  <i class="fa fa-plus-circle"></i>
                                </a>
                              </div>
                            </div>
                            <a href="#">                              
                              <div class="r r-2x img-full" style="<?php echo $radius; ?>background:url('<?php echo $picture; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                               <div style="height:180px;overflow:hidden;">                              
                              </div>
                              </div>
                              </a>
                          </div>
                          <div class="padder-v">
                            <span class="hide" itemprop="name" ><?php echo $value->name; ?></span>
                            <a href="<?php echo base_url(); ?>?artist=<?php echo $value->artist; ?>&track=<?php echo $value->name; ?>" class="text-ellipsis btn-track-info removehref" itemprop="url" data-artist="<?php echo ($value->artist); ?>" data-track="<?php echo ($value->name); ?>"><?php echo $value->name; ?></a>
                            <a href="<?php echo base_url(); ?>artist/<?php echo encode2($value->artist); ?>" itemprop="inAlbum" class="removehref text-ellipsis text-xs text-muted"  onClick="getArtistInfo('<?php echo $value->artist; ?>');" title=<?php echo ___("label_get_artist_info"); ?>><?php echo $value->artist; ?></a>
                          </div>
                        </div>
                    </div>


               
                <?php
                    
                }
                else
                {

                    ?>

                     <li class="list-group-item">
                        <div class="pull-right m-l">                          
                          <a href="#" class="m-r-sm btn-play"  data-track="<?php echo addslashes($value->name); ?>" data-artist="<?php echo addslashes($value->artist); ?>" data-cover="<?php echo $picture; ?>" ><i class="icon-plus"></i></a>                          
                        </div>
                        <a href="#" class="jp-play-me m-r-sm pull-left btn-play-now" data-track="<?php echo addslashes($value->name); ?>" data-artist="<?php echo addslashes($value->artist); ?>" data-cover="<?php echo $picture; ?>">
                          <i class="icon-control-play text"></i>                          
                        </a>
                        <div class="clear text-ellipsis">
                          <span class="cursor-pointer btn-track-info" data-artist="<?php echo addslashes($value->artist); ?>" data-track="<?php echo addslashes($value->name); ?>"><?php echo $value->name; ?></span>
                          <span class="text-muted btn-artist-info cursor-pointer" data-artist="<?php echo addslashes($value->artist); ?>">  - <?php echo $value->artist; ?></span>
                        </div>
                      </li>
            
                 <?php
                }
            }
    }
    ?> 
</div>
<?php
if($this->config->item("search") != 'Modern')
{
  ?></ul><?php
}
?>

</div>
<script>
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>?s=<?php echo ($query); ?> ");
$(function () {
  $(".removehref").attr("href","#");
});
try{
$(".removehref").attr("href","#");
}catch(e){}

</script>