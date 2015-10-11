<?php
$image = $song->track->album->image[3]->text;
if($image == '')
  $image = $song->track->album->image[2]->text;
if($image == '')
  $image = $song->track->album->image[1]->text;
if($image == '')
  $image = base_url()."assets/images/no-cover.png";
?>
<?php if($this->config->item("ads_refresh") == '1'){ ?>
<div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
<?php } ?>
<section class="hbox stretch bg-black dker" id="song-info">
              <!-- side content -->
              <aside class="col-sm-4 no-padder">
                <section class="vbox animated fadeInUp">
                  <section class="scrollable">
                    <div class="m-t-n-xxs item pos-rlt">


                      <div class="top text-right">                           


                        <span class="musicbar animate bg-success bg-empty inline m-r-lg m-t" style="width:25px;height:30px">
                          <span class="bar1 a3 lter"></span>
                          <span class="bar2 a5 lt"></span>
                          <span class="bar3 a1 bg"></span>
                          <span class="bar4 a4 dk"></span>
                          <span class="bar5 a2 dker"></span>
                        </span>
                      </div>
                      <div class="bottom gd bg-info wrapper-lg">
                        <span class="pull-right text-sm">


                          <div class="btn-group btn-group-justified m-b">

                      
                          <a onclick="start_radio('<?php echo addslashes($lyrics->track); ?>','<?php echo addslashes($lyrics->artist); ?>','<?php echo $image; ?>')" class="btn btn-dark btn-rounded" >
                           
                              <i class="fa fa-rss"></i>
                                                   
                          </a> <a onclick="$('#panel2a').slimScroll({ scrollTo:  $('#comment').offset().top, animate: true });"  class="btn btn-dark btn-rounded" >
                           
                              <i class="fa fa-comment"></i>
                                                   
                          </a>

                        <div class="btn-group">
                          <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" style="width:100%"  data-toggle="dropdown">
                            <i class="fa fa-share-square"></i> 
                            
                          </button>
                          <ul class="dropdown-menu">
                              <li><a href="#" onClick="custom_share('fb','<?php echo base_url()."?artist=".addslashes(encode2($lyrics->artist))."&track=".addslashes(encode2($lyrics->track)); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
                                  <li><a href="#" onClick="custom_share('tw','<?php echo base_url()."?artist=".addslashes(encode2($lyrics->artist))."&track=".addslashes(encode2($lyrics->track)); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
                                  <li><a href="#" onClick="custom_share('gp','<?php echo base_url()."?artist=".addslashes(encode2($lyrics->artist))."&track=".addslashes(encode2($lyrics->track)); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
                                  <li><a href="#" onClick="custom_share('c','<?php echo base_url()."?artist=".addslashes(encode2($lyrics->artist))."&track=".addslashes(encode2($lyrics->track)); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   
                          </ul>
                        </div>

                      
                      




                          <a class="btn btn-dark btn-rounded "  onclick="addPlayList('<?php echo addslashes($lyrics->track); ?>','<?php echo addslashes($lyrics->artist); ?>','<?php echo $image; ?>',true);">
                          <i class="fa fa-play"></i> 
                          </a> 

                            <a data-artist="<?php echo addslashes($lyrics->artist); ?>"  data-cover="<?php echo $image; ?>" data-track="<?php echo addslashes($lyrics->track); ?>" class="btn btn-dark btn-rounded btn-download-mp3" >
                             <i class="fa fa-cloud-download"></i>
                            </a>
                          
                        </div>
                   
                        </span>
                        <span class="h2 font-thin"><?php echo ($lyrics->track); ?></span>
                      </div>
                      <img class="img-full" src="<?php echo $image; ?>" alt="...">
                    </div>
                    <ul class="list-group list-group-lg no-bg auto m-b-none m-t-n-xxs">
                      <?php
                        $x=0;
                        foreach ($artist->artist->similar->artist as $key => $value) {
                          $image = $value->image[3]->text;
                            if($image == '')
                              $image = base_url()."assets/images/no-cover.png";
                          if($value->name != '' && $x<10)
                          {
                            $x++;
                          ?>    
                        

                            <li class="list-group-item clearfix" onClick="getArtistInfo('<?php echo $value->name; ?>');">
                              <a href="<?php echo base_url(); ?>artist/<?php echo econde($value->name); ?>" class="jp-play-me pull-right m-t-sm m-l text-md removehref">
                                <i class="icon-info text"></i>
                                
                              </a>
                              <a href="#" class="pull-left thumb-sm m-r">
                                <div  style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                                  <div style="height:40px;width:40px;overflow:hidden;">
                                      
                                    </div>
                                </div>
                              </a>
                              <a class="clear" href="#">
                                <span class="block text-ellipsis"><?php echo $value->name; ?></span>
                                <small class="text-muted"><?php echo ___("label_artist_info"); ?></small>
                              </a>
                            </li>
                        <?php
                          }
                        }
                        ?>
                  
                    </ul>
                   
                  </section>
                </section>
              </aside>
              <!-- / side content -->
              <section class="col-sm-6 no-padder bg  hidden-md">
                <section class="vbox" >
                  <section class="scrollable hover" >
                   <ul class="list-group list-group-lg no-radius no-border no-bg m-t-n-xxs m-b-none auto" id="panel2a">


                      <?php
                      foreach ($toptracks->toptracks->track as $key => $value) {
                        $image = $value->image[3]->text;
                        if($image == '')
                          $image = $value->image[2]->text;
                        if($image == '')    
                          $image = $value->image[1]->text;
                        if($image == '')
                          $image = base_url()."assets/images/no-cover.png";
                        if($value->name != '')
                        {
                        ?>    
                         <li class="list-group-item">                            
                            <div class="pull-right m-l">                              
                              <a href="#" class="m-r-sm"  onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>');"><i class="icon-plus"></i></a>                              
                            </div>
                            <a href="<?php echo base_url(); ?>?artist=<?php echo $value->artist->name; ?>&track=<?php echo $value->name; ?>" onClick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);" class="jp-play-me m-r-sm pull-left removehref">
                              <i class="icon-control-play text"></i>                              
                            </a>
                       

                          
                             <div class="pull-right m-l" >                                                           
                              <a href="#" data-artist="<?php echo ($value->artist->name); ?>"  data-cover="<?php echo $image; ?>" data-track="<?php echo ($value->name); ?>" class="m-r-sm btn-download-mp3" >
                                  <i class="fa fa-cloud-download"></i>
                              </a>
                            </div>  
                       

                            <div class="clear text-ellipsis" onclick="getSongInfo('<?php echo addslashes($value->artist->name); ?>','<?php echo addslashes($value->name); ?>');">
                              <span><?php echo $value->name; ?></span>
                            </div>
                          </li>
                        
                       
                      <?php
                        }
                      }
                      ?>                
                    
                    </ul>
                      <div class="col-xs-12" id="comment">
                        <?php echo comments('songinfo'); ?>
                        </div>
                  </section>
                </section>
              </section>
              <?php if( strpos($lyrics->lyric, 'alert') === false || strpos($lyrics->lyric, '|') !== false)  { ?>
               <section class="col-sm-4 no-padder bg">
                <section class="vbox">
                  <section class="scrollable hover text-center">
                  <br>
                   <?php echo $lyrics->lyric; ?>

                  </section>
                </section>
              </section>
              <?php } ?>
            </section>
            <script>
$(window).load(function() {
  <?php if (!$this->input->is_ajax_request()) { ?>
    start_radio('<?php echo addslashes($lyrics->track); ?>','<?php echo addslashes($lyrics->artist); ?>','<?php echo $image; ?>');
  <?php } ?>
  $(".removehref").attr("href","#");
});
try{
  $(".removehref").attr("href","#");
}
catch(e)
{

}

</script>