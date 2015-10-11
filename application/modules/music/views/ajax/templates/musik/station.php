<?php 
$row = $station->row();
?>
<div class="row row-sm padder-lg ">    
    <?php if($this->config->item("ads_refresh") == '1'){ ?>
    <div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
    <?php } ?> 

 <div class="blog-post" id="radio-station-open">                   
                <div class="post-item">     
                    <div class="caption wrapper-lg">
                    <?php
                        
                         
                                
                                $url    = getStationLink($row->m3u);
                                $data   = getMp3StreamTitle($url,19200);
                                $title  = $data['title'];
                                $image = base_url()."uploads/stations/".$row->cover;
                                $search = json_decode(searchLastFm($title));
                                        ?>
                                    <div class="col-md-4">
                                        <img src="<?php echo $image; ?>" class="img-reponsive" style="width:100%">
                                    </div>
                                    <div class="col-md-8">
                                                <h2 class="font-thin m-b"><?php echo $row->title;  ?>  
                                                <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
                                                    <span class="bar1 a1 bg-primary lter"></span>
                                                    <span class="bar2 a2 bg-info lt"></span>
                                                    <span class="bar3 a3 bg-success"></span>
                                                    <span class="bar4 a4 bg-warning dk"></span>
                                                    <span class="bar5 a5 bg-danger dker"></span>
                                                </span>
                                            </h2>
                                            <h3 class="post-title"><?php echo  $title; ?></h3>            
                                            <p><?php echo  $data['description']; ?></p>
                                            <button class="btn btn-primary btn-start-station" data-station="<?php echo  $url; ?>" data-title="<?php echo $row->title; ?>" data-cover="<?php echo $image; ?>" data-id="<?php echo $row->idtstation;  ?>"><i class="icon-volume-2 icon"></i> <?php echo ___('label_start_radio_station'); ?></button>           

                                            <div class="btn-group">
                                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                      <i class="fa fa-share-square"></i> <?php echo ___("label_share"); ?>
                                                      <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" onClick="custom_share('fb','<?php echo base_url(); ?>station/<?php echo encode2($row->title);  ?>-<?php echo $row->idtstation;  ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
                                                            <li><a href="#" onClick="custom_share('tw','<?php echo base_url(); ?>station/<?php echo encode2($row->title);  ?>-<?php echo $row->idtstation;  ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
                                                            <li><a href="#" onClick="custom_share('gp','<?php echo base_url(); ?>station/<?php echo encode2($row->title);  ?>-<?php echo $row->idtstation;  ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
                                                            <li><a href="#" onClick="custom_share('c','<?php echo base_url(); ?>station/<?php echo encode2($row->title);  ?>-<?php echo $row->idtstation;  ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   

                                                    </ul>
                                                    </div>
                                            
                                    </div>
                                  

                                
                                    <div class="clearfix"></div>
                     </div>
                </div>
                
    </div>

                                   
                                                                
                                                    <ul class="list-group list-group-lg">
                                                    <?php 
                                                    
                                                    if(count($search->results->trackmatches->track)>1)
                                                        $search_a = $search->results->trackmatches->track;
                                                    if(count($search->results->trackmatches->track)==1)
                                                        $search_a[0] = $search->results->trackmatches->track;
                                                     foreach ($search_a as $key => $value) 
                                                     {
                                                        $picture = $value->image[3]->text;

                                                        if($picture == '')
                                                            $picture = $value->image[2]->text;
                                                        if($picture == '')
                                                            $picture = base_url()."assets/images/no-cover.png";
                                                           if($value->name != '')
                                                            {
                                                                  
                                                                    $radius = '';
                                                                    if($this->config->item("cover_search") == 4)
                                                                        $radius = 'border-radius:50%;';

                                                                    
                                                            ?>

                                                                 <li class="list-group-item">
                                                                    <div class="pull-right m-l">                          
                                                                      <a href="#" class="m-r-sm btn-play"  data-track="<?php echo addslashes($value->name); ?>" data-artist="<?php echo addslashes($value->artist); ?>" data-cover="<?php echo $picture; ?>" ><i class="icon-plus"></i></a>                          
                                                                    </div>

                                                                    <div class="pull-right m-l">                                  
                                                                      <a href="#" class="m-r-sm btn-download-mp3" data-artist="<?php echo addslashes($value->artist); ?>" data-track="<?php echo addslashes($value->name); ?>" data-cover="<?php echo $picture; ?>"><i class="icon-cloud-download"></i></a>                               
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
                                                ?> 
                                                </ul>
                                                <div class="clearfix"></div>
                                                  <div class="col-md-12">                                            
                                                        <?php echo processShortCode($row->description); ?>                                            
                                                </div>
                                    
                                        <div class="clearfix"></div>


</div>
<script>
$(".nav-sidebar li").removeClass("active");
$("#topTrack").addClass('active');
</script>
<script>
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>station/<?php echo encode2($row->title);  ?>-<?php echo $row->idtstation;  ?> ");
</script>