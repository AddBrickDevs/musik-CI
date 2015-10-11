<div class="row row-sm padder-lg ">    
    <?php if($this->config->item("ads_refresh") == '1'){ ?>
    <div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
    <?php } ?> 
    <h2 class="font-thin m-b"><?php echo ___("label_station"); ?>  
        <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
            <span class="bar1 a1 bg-primary lter"></span>
            <span class="bar2 a2 bg-info lt"></span>
            <span class="bar3 a3 bg-success"></span>
            <span class="bar4 a4 bg-warning dk"></span>
            <span class="bar5 a5 bg-danger dker"></span>
        </span>
    </h2>
    <br>
  
    <?php
        
        if($stations->num_rows > 0)
        {
            foreach ($stations->result() as $row) 
            {             
                
                
                $image = base_url()."uploads/stations/".$row->cover;
             
                        ?>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 btn-start-station" data-id="<?php echo $row->idtstation; ?>" data-cover="<?php echo $image; ?>" data-title="<?php echo $row->title; ?>" data-station="<?php echo $row->m3u; ?>">
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
        }
    ?>

</div>
<script>
$(".nav-sidebar li").removeClass("active");
$("#topTrack").addClass('active');
</script>