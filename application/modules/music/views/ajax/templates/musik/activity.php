<div class="row row-sm padder-lg ">
 
                  <div class="timeline col-xs-12">
                    <?php if($activity->num_rows() > 0){ ?>
                        
                                 <?php foreach ($activity->result() as $key => $row) {           
                                    $icon[$row->action]['color'] = "orange";                 
                                    if($row->id == $this->session->userdata('id'))
                                        $icon[$row->action]['color'] = "blue";
                                    ?>
                                    <article class="timeline-item <?php if($key % 2 == 0) { echo 'alt';} ?>">
                                        <div class="timeline-caption">
                                          <div class="panel panel-default">
                                            <div class="panel-body">
                                                <img src="<?php echo $row->picture; ?>" class="thumbnail pull-right" style="max-height:64px">
                                              <span class="arrow <?php if($key % 2 == 0) { echo 'right';}else{echo'left';} ?>"></span>
                                              <span class="timeline-icon"><i class="fa fa-music time-icon bg-primary"></i></span>
                                              <span class="timeline-date"><?php echo ago(strtotime($row->date)); ?></span>                                              
                                              <strong>                                
                                                <a class="removehref" href="<?php echo base_url(); ?>user/<?php echo $row->nickname; ?>" onClick='profile("<?php echo $row->nickname; ?>");'><?php echo $row->nickname; ?></a>
                                              </strong>
                                              <div class="text-sm">
                                                  <a href="<?php echo base_url(); ?>artist/<?php echo econde($row->artist); ?>" class="artistInfo removehref truncate" onClick="getArtistInfo('<?php echo addslashes($row->artist); ?>');" title="<?php echo ___("label_get_artist_info"); ?>"><?php echo $row->artist; ?></a>      
                                                  <a href="<?php echo base_url(); ?>?artist=<?php echo encode($row->artist); ?>&track=<?php echo encode($row->track); ?>" class="removehref text-muted cursor-pointer"   onclick="getSongInfo('<?php echo addslashes($row->artist); ?>','<?php echo addslashes($row->track); ?>');"> - <?php echo $row->track; ?></a>
                                                   
                                              </div>
                                                <div >
                                                <br>
                                                    <i style="cursor:pointer" class="icon-control-play text"  onclick="addPlayList('<?php echo addslashes($row->track); ?>','<?php echo addslashes($row->artist); ?>','<?php echo base_url(); ?>assets/images/no-cover.png',true);"></i>                                                                                
                                                    <i style="cursor:pointer;margin-left:10px"  class="icon-feed text" onclick="start_radio('<?php echo addslashes($row->track); ?>','<?php echo addslashes($row->artist); ?>','<?php echo base_url(); ?>assets/images/no-cover.png')"></i>                                                                                                        
                                                </div>
                                              
                                            </div>       
                                          </div>
                                        </div>
                                    </article>                                    
                                    <?php
                                 }
                                 ?>
                                  
                              

                        </div>
                        <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    Not Activity Found
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <script>
                        timerActivity = setTimeout(function() {showActivity()}, 20000);
                        $(".removehref").attr("href","#");
                        </script>

                     
                    
                    
                    
                  </div>
                  </div>
                        



    
