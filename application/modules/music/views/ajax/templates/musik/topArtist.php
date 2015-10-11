<div class="row-sm padder-lg " >
    <?php echo $this->load->view("templates/common/_carousel",false,true); ?>
    <?php if($this->config->item("ads_refresh") == '1'){ ?>
    <div class="adsblock text-center"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></div><br><br>
    <?php } ?>
    <h2 class="font-thin m-b"><?php echo ___("label_top_artist"); ?> <?php echo getCountry(); ?> 
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
    foreach ($top->artists->artist as $key => $value) 
    {
        if($key >= $this->config->item("items_top"))
            return false;
        $image = $value->image[4]->text;
        if($image == '')
            $image = $value->image[3]->text;
        if($image == '')
            $image = base_url()."assets/images/no-cover.png";
    ?>    
    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
        <div class="item">
            <div class="pos-rlt">
                <div class="item-overlay opacity r r-2x bg-black btn-artist-info" data-artist="<?php echo addslashes($value->name); ?>">
                    <div class="text-info padder m-t-sm text-sm">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="center text-center m-t-n">
                        <a  href="#"><i class="icon-info i-2x"></i></a>
                    </div>
                    <div class="bottom padder m-b-sm hide">
                        <a href="#" class="pull-right">
                            <i class="fa fa-heart-o"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <a href="#">
                    <div class="r r-2x img-full" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                        <div style="height:180px;overflow:hidden;"></div>
                    </div>
                </a>
            </div>
            <div class="padder-v">
                <a href="<?php echo base_url(); ?>artist/<?php echo $value->name; ?>" class="text-ellipsis btn-artist-info removehref" data-artist="<?php echo $value->name; ?>"><?php echo $value->name; ?></a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<div class="clearfix"></div>

<script>
$(function () {
$(".removehref").attr("href","#");
});
try{
$(".removehref").attr("href","#");
}catch(e){}
</script>