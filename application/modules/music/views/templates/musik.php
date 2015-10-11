<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <?php echo $this->load->view("templates/common/_header",false,true); ?>
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/jplayer.flat.css" type="text/css" />  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/app.css" type="text/css" />  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/<?php echo $this->config->item("theme"); ?>/custom.css" type="text/css" />  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/slider/slider.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->

  <script>
  var label_chat_history  = '<?php echo ___('label_chat_history'); ?>';
  var label_chat_send     = '<?php echo ___('label_chat_send'); ?>';
  var label_unfollow_user     = '<?php echo ___('label_unfollow_user'); ?>';
  var label_follow_user     = '<?php echo ___('label_follow_user'); ?>';
  var user_avatar         = '<?php echo $this->session->userdata('avatar'); ?>';   
  </script>    

</head>
<body class="">

<div class="modal no_visibility" id="youtubeVideoModal" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close videoPlayerMusik" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_video"); ?></h4>           
          </div>
          <div class="modal-body">
               <div  id="thumbnail" class="video-container" style="position;fixed;left:99999">
                  <div id="player">  
                    <div id="ytapiplayer" >
                      <!--<span>Update Required</span>
                      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.-->
                    </div>
                  </div>
            </div>  
          </div>          
        </div>
      </div>
    </div>
    
  <section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info <?php echo $this->config->item("musik_left_menu"); ?>">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="#" class="navbar-brand text-lt">
          <i class="icon-earphones"></i>          
          <span class="hidden-nav-xs m-l-sm"><?php echo $this->config->item("brand"); ?></a></span> <!-- -->
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>      <ul class="nav navbar-nav hidden-xs">
        <li>
          <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
          </a>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search" id="frmSearch" >
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" id="btnSearch" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" class="form-control input-sm no-border rounded" id="s" placeholder="<?php echo ___("label_listen"); ?>" value="<?php echo $search; ?>">
          </div>
        </div>
      </form>
      <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">


          <?php if($this->config->item('download_button') == '1'){ ?>
          <li class="btn-download-mp3" title="<?php echo ___("label_mp3_title"); ?>" >
             <a href="#"><i class="fa fa-cloud-download"></i></a>
          </li>
          <?php } ?>
          <?php if($this->config->item('lyrics_button') == '1'){ ?>
           <li  id="lyric" title="<?php echo ___("label_lyrics_title"); ?>">
              <a href="#"><i class="fa fa-align-center"></i></a>
          </li>
          <?php } ?>

             <li class="divider"></li>


                         <li id="nowPlaying" title="<?php echo ___("label_now_playing"); ?>"><a href="#" onClick="return false;"><i class="fa fa-info-circle"></i></a></li>
                          <?php if($this->config->item("user_change_lang") == "1")
                          {
                            ?>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ___("label_language"); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu" id="tags">
                              <?php foreach ($this->config->item("langs_available") as $key => $value) {
                                ?>
                                <li><a href="?lang=<?php echo strtolower($value); ?>"><?php echo ucfirst($value); ?></a></li>
                                <?php
                              }
                              ?>
                            </ul>
                          </li>
                        <?php } ?>

          <?php   if($this->config->item('use_database') == 1 && is_logged()){ ?>

        <li class="hidden-xs">
            <a href="#" class="dropdown-toggle lt btn-noty-r" data-id="" data-toggle="dropdown">
              <i class="icon-bell"></i>
              <span class="badge badge-sm up bg-danger count notifications-count hide" style="display: inline-block;">0</span>
            </a>
            <section class="dropdown-menu aside-xl animated fadeInUp">
              <section class="panel bg-white">
                <div class="panel-heading b-light bg-light">
                  <strong><?php echo ___('label_notifications'); ?></strong>
                </div>
                <div class="list-group list-group-alt list-notifications">


                  
               
                </div>
              
              </section>
            </section>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="<?php echo $this->session->userdata('avatar'); ?>" alt="...">
              </span>
              <?php echo $this->session->userdata('nickname'); ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <span class="arrow top"></span>
                <a href="#" onClick="changePassword();"><?php echo ___("label_change_password"); ?></a>
              </li>
              <li>
                  <a href="#" onClick="profile();"><?php echo ___("label_profile"); ?></a>
              </li>
              <li>
                <a href="#" onClick="myPlaylist();"><?php echo ___("label_music_folder"); ?></a>
              </li>
               <?php
                            if($this->session->userdata('is_admin') == 1 && $this->config->item("use_database") == 1)
                            {
                              ?>
                              <li id="admin"><a href="<?php echo base_url(); ?>dashboard"><span  class="pull-right label label-danger">Admin</span>Dashboard</a></li>
                              <?php

                            }
                            ?>

              <li class="divider"></li>
              <li>
                 <a  href="<?php echo base_url(); ?>music/logout" id="navLogin"><i class="fa fa-sign-out"></i> <?php echo ___("label_logout"); ?></a>                         
              </li>
            </ul>
          </li>
          <?php }else{ ?>
              <li  id="menuLogin">
                <a  href="#" id="navLogin"><?php echo ___("label_login"); ?></a>                         
              </li>
              <li  id="menuLoginRegister">
                <a  href="#" id="navLogin"><?php echo ___("label_register"); ?></a>                         
              </li>
                
          <?php } ?>


                    

        </ul>
      </div>      
    </header>
    <section>

      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk <?php echo $this->config->item("musik_left_menu"); ?> aside hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix">
                    
                    <li>
                      <a id="topTrack" href="#">
                        <i class="icon-disc icon text-success"></i>
                        <span class="font-bold"><?php echo ___("label_track"); ?></span>
                      </a>
                    </li>
                    <li>
                      <a class="btn-top-artist" href="#">
                        <i class="icon-user icon text-success"></i>
                        <span class="font-bold"><?php echo ___("label_artist"); ?></span>
                      </a>
                    </li>

                    <li>
                      <a href="<?php echo base_url(); ?>tag/all" class="removehref" onClick="getTopTags('music')">
                        <i class="icon-music-tone-alt icon text-info"></i>
                        <span class="font-bold"><?php echo ___("label_genres"); ?></span>
                      </a>
                    </li>
                    <?php $stations = getStations() ;  ?>

                  
       
                
                   
                
                  <li class="m-b hidden-nav-xs"></li>
                  </ul>

                   <ul class="nav" data-ride="collapse">
               
                    <?php if($stations){if($stations->num_rows()>0){ ?>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                        <i class="icon-volume-2 icon text-warning-lter"></i>                        
                        <span><?php echo ___("label_stations"); ?></span>
                      </a>
                      <ul class="nav dk text-sm">

                      
                  
             
                              <?php $x=0; foreach ($stations->result() as $row) {
                                if($x<6){
                                ?>
                                <li class="btn-start-station" data-id="<?php echo $row->idtstation; ?>" data-cover="<?php echo base_url(); ?>uploads/stations/<?php echo $row->cover; ?>" data-title="<?php echo $row->title; ?>" data-station="<?php echo $row->m3u; ?>"><a href="#" ><i class="fa fa-angle-right text-xs"></i> <?php echo $row->title; ?></a></li>                                                            
                                <?php                                  
                                }
                                $x++;
                              }

                              ?>
                              
                                
                        <li>
                      <a href="#" class="removehref btn-stations" >
                        <i class="icon-volume-2 icon text-warning-lter"></i>
                        <b class="badge bg-inverse dker pull-right"> <?php echo number_format($stations->num_rows()); ?></b>
                        <span class="font-bold"><?php echo ___("label_stations_all"); ?></span>
                      </a>
                    </li>

                   
                                         
                      </ul>
                    </li>
                           <?php }} ?>
                  </ul>


                  <ul class="nav" data-ride="collapse">
               
                    <?php if($pages){if($pages->num_rows()>0){ ?>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                        <i class="icon-grid icon">
                        </i>
                        <span><?php echo ___("label_pages"); ?></span>
                      </a>
                      <ul class="nav dk text-sm">

                      
                  
             
                              <?php foreach ($pages->result() as $row) {
                                ?>
                                <li><a href="#" onClick="showPage('<?php echo $row->idpage; ?>');return false;"> <i class="fa fa-angle-right text-xs"></i> <?php echo more($row->title,20); ?></a></li>                                                            
                                <?php
                              }
                              ?>
                              
                
                   

                   
                                         
                      </ul>
                    </li>
                           <?php } } ?>
                  </ul>
                    <ul class="nav text-sm">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted btn-add-music-folder">
                      <span class="pull-right"><a href="#"><i class="icon-plus i-lg"></i></a></span>
                      <?php echo ___("label_playlist"); ?>
                    </li>    
                 

                    <li> 
                      <a href="#" class="toggleSidebar" data-target="playlist-items">
                        <i class="icon-playlist icon text-success-lter"></i>
                        <b class="badge bg-success dker pull-right numItems "></b>
                        <span><?php echo ___("label_playlist"); ?></span>
                      </a>
                    </li>                  

                  </ul>
                    <?php if(is_logged()){ ?>
                    <ul class="nav" data-ride="collapse">               
                        <?php 
                        $playlists = get_playlist($this->session->userdata('id')); ?>
                       
                        <li >
                          <a href="#" class="auto">
                            <span class="pull-right text-muted">
                              <i class="fa fa-angle-left text"></i>
                              <i class="fa fa-angle-down text-active"></i>
                            </span>
                            <i class="icon-folder-alt icon text-info-lter"></i>                            
                            <span><?php echo ___("label_music_folder"); ?></span>
                          </a>
                          <ul class="nav dk text-sm">             
                                  <?php $x=0; foreach ($playlists->result() as $row) {
                                    if($x<7){
                                    ?>
                                    <li class="btn-edit-playlist" data-id="<?php echo $row->idplaylist; ?>" ><a href="#" ><i class="icon-playlist text-xs"></i> <?php echo more($row->name,20); ?></a></li>                                                            
                                    <?php                                  
                                    }
                                    $x++;
                                  }
                                  ?>
                            <li>
                          <a href="#" class="removehref" onClick="myPlaylist();" >
                            <i class="icon-folder icon text-info-lter"></i>
                             <b class="badge bg-info dker pull-right"> <?php echo number_format($playlists->num_rows()); ?></b>
                            <span class="font-bold"><?php echo ___("label_music_folder"); ?></span>
                          </a>
                        </li>                
                      </ul>
                    </li>
                          
                  </ul>
                  <?php } ?>

                  
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                  <?php   if($this->config->item('use_database') == 1 && is_logged()){ ?> 
                  <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                        <img src="<?php echo $this->session->userdata('avatar'); ?>" class="dker" alt="...">
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">
                          <strong class="font-bold text-lt"><?php echo $this->session->userdata('nickname'); ?></strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block m-l"><?php echo $this->session->userdata('username'); ?></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">                      
                     
                        <li>
                          <span class="arrow top"></span>
                          <a href="#" onClick="changePassword();"><?php echo ___("label_change_password"); ?></a>
                        </li>
                        <li>
                            <a href="#" onClick="profile();"><?php echo ___("label_profile"); ?></a>
                        </li>
                        <li>
                          <a href="#" onClick="myPlaylist();"><?php echo ___("label_music_folder"); ?></a>
                        </li>
                         <?php
                                      if($this->session->userdata('is_admin') == 1 && $this->config->item("use_database") == 1)
                                      {
                                        ?>
                                        <li id="admin"><a href="<?php echo base_url(); ?>dashboard"><span  class="pull-right label label-danger">Admin</span>Dashboard</a></li>
                                        <?php

                                      }
                                      ?>

                        <li class="divider"></li>
                        <li>
                           <a  href="<?php echo base_url(); ?>music/logout" id="navLogin"><i class="fa fa-sign-out"></i> <?php echo ___("label_logout"); ?></a>                         
                        </li>
                      </ul>
                    </li>                  
                  </ul>
                  </div>
                  <?php } ?>
                </div>            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable  w-f-md">  
                <?php if(!is_logged() && $this->config->item("box_guest_info") == '1' ){ ?>
                 <div class="row m-t-lg m-b-lg" style="padding:10px">
                    <div class="col-sm-6">
                      <div class="bg-primary wrapper-md r btn-login">
                        <a href="#">
                          <span class="h4 m-b-xs block"><?php echo ___('msg_box_login_title'); ?></span>
                          <span class="text-muted"><?php echo ___('msg_box_login_text'); ?></span>
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="bg-black wrapper-md r btn-register">
                        <a href="#">
                          <span class="h4 m-b-xs block"><?php echo ___('msg_box_register_title'); ?></span>
                          <span class="text-muted"><?php echo ___('msg_box_register_text'); ?></span>
                        </a>
                      </div>
                    </div>
                  </div>

                    <?php } ?>
                      <!-- MAIN -->                 

                      <?php if($this->config->item("ads_refresh") == '0' && !$hide_ads && $this->config->item("ads_block") != ''){ ?>
                        <div class="clearfix"></div>                                    
                        <div class="adsblock banner text-center"><?php  echo $this->config->item("ads_block");  ?> </div>
                        <div class="clearfix"></div>                                    
                      <?php } ?>

                      <div id="target"  style="height:100%;">                  
                        <?php getPage($page); ?>
                      </div> <!-- /target -->

                        <?php if($this->config->item("ads_refresh") == '0' && !$hide_ads && $this->config->item("ads_block_footer") != ''){ ?>
                          <div class="clearfix"></div>                                    
                          <div class="adsblock banner text-center"><?php  echo $this->config->item("ads_block_footer");  ?> </div>
                          <div class="clearfix"></div>                                    
                        <?php } ?>

                    <div style="text-align:center;width:100%;margin-top:10px;margin-bottom:10px">
                        <div class="clearfix"></div> 
                      <?php echo $this->config->item("footer_text"); ?> 
                    </div> 
                  
              
                  
                 
                </section>
                <ul id="containerChat" class="containerChat">                
                </ul>
                <footer class="footer bg-dark">
                  <div id="jp_container_N">
                    <div class="jp-type-playlist">
                      <div id="jplayer_N" class="jp-jplayer hide"></div>
                      <div class="jp-gui">
                        <div class="jp-video-play hide">
                          <a class="jp-video-play-icon">play</a>
                        </div>
                        <div class="jp-interface">
                          <div class="jp-controls">
                            <div><a onClick="playBackSong();" class="jp-previous"><i class="icon-control-rewind i-lg"></i></a></div>
                            <div>
                              <a id="play" onClick="playNextSong(0)" class="jp-play"><i class="icon-control-play i-2x"></i></a>
                              <a id="pause" style="display:none" onClick="pause();" class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
                            </div>
                            <div><a onClick="playNextSong();" class="jp-next"><i class="icon-control-forward i-lg"></i></a></div>
                           


                                      <?php if($this->config->item('youtube_button') == '1'){ ?>
                                                 <div><a id="videoPlayerMusik" title="<?php echo ___("label_video"); ?>"  ><i class="icon-social-youtube i-lg"></i></a></div>              
                                        </li>
                                        <?php } ?>

                                
                            
                            
                                 <div><a class="btn-download-mp3"  title="<?php echo ___("label_download"); ?>" ><i class="icon-cloud-download i-lg"></i></a>  </div> 
                                                              
                            

                            <div id="current"  class="jp-progress hidden-xs progress-trg">
                              <div class="jp-seek-bar dk" >
                                <div class="jp-play-bar bg-info progress-bar">
                                </div>
                                <div class="jp-title text-lt">                                  
                                  <span id="artistInfo"></span>
                                  <span id="trackInfo" class="text-muted"></span>

                                </div>
                              </div>
                            </div>
                            <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted" id="tracktime"></div>
                            <div class="hidden-xs hidden-sm jp-duration text-xs text-muted" id="tracktime2"></div>
                            <div class="hidden-xs hidden-sm">
                              <span class="jp-mute" ><i class="icon-volume-2"></i></span>
                              
                            </div>
                            <div class="hidden-xs hidden-sm" >                              
                              <input style="width:50px" id="volume" slider-tooltip="hide" class="slider slider-horizontal form-control" type="text" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="10" data-slider-orientation="horizontal" >
                            </div>
                            <div>
                            <?php if($this->config->item('random_button') == '1'){ ?>                                
                                <a style="margin-left:20px" id="random" title="<?php echo ___("label_random"); ?>" title="shuffle"><i class="icon-shuffle"></i></a>  
                              <?php } ?>
                              
                             
                            </div>
                            <div>                            
                              <a  class="active" id="stopRadio" style="display:none" onClick="stop_radio();" title="<?php echo ___("label_stop_radio"); ?>"><i class="fa fa-rss text-muted"></i></a>

                               
                              
                            </div>
                            <div >
                              <a  class="text-muted btn-toggle-sidebar"  title="<?php echo ___("label_show_sidebar"); ?>" ><i class="fa fa-list"></i></a>  
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="jp-playlist dropup" id="playlist">
                        <ul class="dropdown-menu aside-xl dker">
                          <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                          <li class="list-group-item"></li>
                        </ul>
                      </div>
                      <div class="jp-no-solution">

                        

                        
                      </div>
                    </div>
                  </div>
                </footer>
              </section>
            </section>
            <!-- side content -->
            <aside class="aside-md bg-light dk hidden-xs hidden-sm <?php echo $this->config->item("musik_sidebar"); ?>"  id="sidebar"  >            
              <section class="vbox animated fadeInRight">
                <section class="w-f-md scrollable">
              
                    <div style="margin:6px;z-index:9999">
                    <div class="btn-group btn-group-justified" >


                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm toggleSidebar  toggleSidebarPlaylist btn-info" data-target="playlist-items"><i class="icon-list text"></i> <span class="badge badge-sm  badge-danger" id="numItems"></span></button>
                      </div>
                       <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm btn-clear-playlist " data-placement="bottom"  title="<?php echo ___('label_clear_playlist'); ?>"><i class="icon-trash text"></i> </button>
                      </div>

                      <?php if($this->config->item("activity_module") == '1'){ ?>
                       <div class="btn-group">
                          <button type="button" class="btn btn-default btn-sm toggleSidebar" data-target="activitySider"><i class="icon-users text"></i></button>
                        </div>
                      <?php } ?>
                         <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm toggleSidebar" data-target="chatSider"><i class="fa fa-comments-o text"></i> <span class="badge badge-sm  badge-info " ></span></button>
                      </div>
                    </div>
                    </div>
                    <div class="clearfix"></div>

                        <?php if($this->config->item("ads_refresh") == '0' && !$hide_ads && $this->config->item("ads_block_sidebar") != ''){ echo $hide_ads;?>
                        <div class="clearfix"></div>                                    
                        <div class="adsblock banner_sidebar text-center"><?php  echo $this->config->item("ads_block_sidebar");  ?> </div>
                        <div class="clearfix"></div>                                    
                      <?php } ?>


                  
                  <?php if(!is_logged()){ ?>
                    <div class="bg-info wrapper-md r btn-login" style="margin:5px">
                        <a href="#">
                          <span class="h4 m-b-xs block"><?php echo ___('box_register_title'); ?></span>
                          <span class="text-muted"><?php echo ___('box_register_text'); ?></span>
                        </a>
                      </div>
                      
                  <?php } ?>
                  <div class="bg-primary wrapper-md r notePlayList" style="margin:5px">
                        
                          <span class="h4 m-b-xs block"><?php echo ___('label_playlist'); ?></span>
                          <span class="text-muted"><?php echo ___('msg_playlist_empty'); ?></span>
                        
                      </div>



                  <div id="playlist-items" class="exclude sidebarToggle" style="margin:5px;">

                  </div>   
                  <div id="chatSider" class="exclude sidebarToggle" style="margin:5px;display:none">
                        <input type="text" class="form-control input-search-user" placeholder="<?php echo ___("label_title_search_user"); ?>">                                                
                          <h4 class="font-thin m-l-md m-t"><?php echo ___("label_users_online"); ?></h4>
                          <ul class="list-group no-bg no-borders auto m-t-n-xxs " id="usersOnline">
                          </ul>
                  </div>
                  <div style="display:none"  class="sidebarToggle" id="activitySider">                  
                  <ul class="list-group no-bg no-borders auto m-t-n-xxs " >
                 
                   
                  </ul>
                  </div>


                </section>
                <div style="position:absolute;bottom:60px;width:235px;display:none" id="station">
                      <div style="width:100%;height:20px;background-color:#222222">
                      <i class="fa fa-times pull-left" style="cursor:pointer;margin:2px;margin-left:5px"></i>
                      <small class="text-center">Title</small>
                      <i class="fa fa-search pull-right btn-info-station" style="cursor:pointer;margin:2px;margin-right:5px"></i>

                      </div>
                      
                     <img src="" class="img-responsive">
                      
                    </div>
               

                <footer class="footer footer-md bg-black">
                  <form class="" role="search" >
                    <div class="form-group clearfix m-b-none">
                      <div class="input-group m-t m-b">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-sm bg-empty text-muted btn-icon"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" class="form-control input-sm text-white bg-empty b-b b-dark no-border" id="searchPlaylist" placeholder="Search on Playlist">
                      </div>
                    </div>
                  </form>
                </footer>
              </section>              
            </aside>
            <!-- / side content -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>

<?php 
  // print_r(getMp3StreamTitle('http://streaming.radionomy.com/a-better-slow-jams-station', 19200));
   ?>
   

    <!-- MODALS -->

    <div class="modal" id="popup">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo $this->config->item("title"); ?></h4>           
          </div>
          <div class="modal-body">
                <center>
                    <?php echo $this->config->item("popup_code"); ?>
                </center>
          </div>          
        </div>
      </div>
    </div>


    <div class="modal" id="paperclip">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo $this->config->item("title"); ?></h4>           
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-4 text-center">
                      <a class="thumbnail btn-send-to-chat" href="#"  data-type="track" id="input-track">
                        <i class="fa fa-music" style="font-size:60px;color:#999999;margin-top:5px"></i>
                        <h6 ><?php echo ___('label_track'); ?></h6>
                      </a>
                  </div>

                 <div class="col-md-4 text-center">
                      <a class="thumbnail btn-send-to-chat" href="#" data-type="artist"  id="input-artist">
                        <i class="fa fa-user" style="font-size:60px;color:#999999;margin-top:5px"></i>
                         <h6 ><?php echo ___('label_artist'); ?></h6>
                      </a>
                  </div>
                <div class="col-md-4 text-center">
                      <a class="thumbnail btn-send-to-chat" href="#"  data-type="lyric" id="input-lyric">
                        <i class="fa fa-align-center" style="font-size:60px;color:#999999;margin-top:5px"></i>
                          <h6 ><?php echo ___('label_lyrics'); ?></h6>
                      </a>
                  </div>
              </div>
               <input id="chat-attachment-target" type="hidden" class="hide" style="display:none">
          </div>          
        </div>
      </div>
    </div>


 

     <div class="modal" id="importPlayList">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("msg_import_playlist"); ?></h4>           
          </div>
          <div class="modal-body">                
                <div class="alert alert-info"><?php echo ___("msg_select_json"); ?><br><strong><?php echo ___("msg_target"); ?>:</strong> <span id="pltrg"></span></div>
                <input type="file" id="files" name="files" />
          </div>          
        </div>
      </div>
    </div>

    <div class="modal" id="customShare">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_share"); ?></h4>           
          </div>
          <div class="modal-body">                     
                <textarea readonly style="width:100%;min-height;100px"></textarea>
                <p>Copy and share link</p>
          </div>          
        </div>
      </div>
    </div>

     <div class="modal" id="savePlaylistModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_new_playlist"); ?></h4>           
          </div>
          <div class="modal-body">   
                <div class="alert alert-info">
                  <?php echo ___("msg_save_playlist"); ?>
                </div>                  
             
                <div class="form-group">
                  <label for="namePlaylist"><?php echo ___("label_name_playlist"); ?></label>
                  <input type="text" class="form-control" id="namePlaylist" placeholder="<?php echo ___("label_name_playlist"); ?>">
                </div>               
                <button type="button" onClick="savePlayListDB()" class="btn btn-default pull-right"><?php echo ___("label_save_playlist"); ?></button>
                <div class="clearfix"></div>
              
          </div>          
        </div>
      </div>
    </div>

    <?php if(!is_logged())
    {
    ?>
    <div class="modal" id="loginModal" data-backdrop="static"  data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <?php if($this->config->item("force_register") == '0') {  ?>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <?php } ?>
              <h4 class="modal-title"><?php echo ___("label_login"); ?></h4>           
          </div>
          <div class="modal-body loginModal">
              <form class="form-signin" role="form">
                <div id="loginForm" >
                  <h3 class="form-signin-heading"><?php echo ___("label_sing_in"); ?></h3>
                  <input type="email" name="email" class="form-control" placeholder="<?php echo ___("label_email"); ?>" required autofocus>
                  <input type="password" name="password1" class="form-control" placeholder="<?php echo ___("label_password"); ?>" required>          
                  <a href="#" onClick="$('#recoveryForm').slideDown();$('#loginForm').slideUp();$('#registerForm').slideUp();"><?php echo ___("label_recovery_password"); ?></a>
                  <button  onClick="login();" class="btn btn-primary" style="width:100%;margin-top:10px;margin-bottom:0px" type="button"><?php echo ___("label_login"); ?></button>                          
                  <?php if($this->config->item("loginfb") == '1' && $this->config->item("fb_appId") != '' && $this->config->item("fb_secret") != '' ){ ?>                  
                  <a class="btn btn-dark" style="width:100%;margin-top:10px;margin-bottom:10px"  href="<?php echo base_url(); ?>music/facebook/login"><i class="fa fa-fw fa-facebook"></i> <?php echo ___("label_login_facebook"); ?></a>                          
                  <?php } ?>
                </div>
                <div id="registerForm" style="display:none" >
                 <?php echo $this->load->view("templates/common/_form_register",false,true); ?>
                </div>

                <div id="recoveryForm" style="display:none" >
                  <h3 class="form-signin-heading"><?php echo ___("label_recovery_password"); ?></h3>
                  <input type="email" name="email" class="form-control" placeholder="<?php echo ___("label_email"); ?>" required autofocus>                  
                  <button  onClick="recoveryPassword();" class="btn btn-danger" style="width:100%" type="button"><?php echo ___("label_sendme_password"); ?></button>
                  <hr>
                </div>


                <button onClick="$('#recoveryForm').slideUp();$('#loginForm').slideDown();$('#registerForm').slideUp();$('.btnregister').fadeIn(500);$('.btnlogin').fadeOut(500);"  class="btn btn-primary btnlogin" style="width:100%;display:none" type="button"><?php echo ___("label_login"); ?></button>
                <button onClick="$('#recoveryForm').slideUp();$('#loginForm').slideUp();$('#registerForm').slideDown();$('.btnregister').fadeOut(500);$('.btnlogin').fadeIn(500);" class="btn btn-info pull-right btnregister" style="width:100%" type="button"><?php echo ___("label_register"); ?></button>
                <div class="clearfix"></div>
              </form>
              
          </div>          
        </div>
      </div>
    </div>
    <?php }else{
      ?>
       <div class="modal" id="chPasswordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_change_password"); ?></h4>           
          </div>
          <div class="modal-body loginModal">
              <form class="form-signin" role="form">
                <div id="changePasswordForm" >
                  <h3 class="form-signin-heading"><?php echo ___("label_change_password"); ?></h3>                  
                  <input type="password" name="password1" class="form-control" placeholder="<?php echo ___("label_password"); ?>" required>          
                  <input type="password" name="password2" class="form-control" placeholder="<?php echo ___("label_password_repeat"); ?>" required>                            
                  <button  onClick="change();" class="btn btn-primary" style="width:100%;margin-top:10px;margin-bottom:10px" type="button"><?php echo ___("label_change_password_button"); ?></button>                          
                </div>

                
                <div class="clearfix"></div>
              </form>
              
          </div>          
        </div>
      </div>
    </div>
      <?php
      } ?>




  <form method="POST" id="export" action="<?php echo base_url(); ?>music/exportPlayList" class="hide" target="_blank">
        <textarea name="list"></textarea>
        <button type="submit"></button>
    </form>

  <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/bootstrap.js"></script>
  <!-- App -->
  <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/app.js"></script>  
  <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/app.plugin.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap3-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-slider.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap3-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/notify.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sort.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/menu.js"></script>    
    <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/slider/bootstrap-slider.js"></script>
  

   
  <script src="<?php echo base_url(); ?>assets/js/custom.js?v=2.1-<?php echo date("Ymd"); ?>"></script>
  <script src="<?php echo base_url(); ?>assets/js/themes/<?php echo $this->config->item("theme"); ?>/custom.js?v=2.1-<?php echo date("Ymd"); ?>"></script>
    <?php echo $this->load->view("templates/common/_footer",false,true); ?>

    <script>
     $(function() {
        /*if(!$("#s").val() =='')            
            $("#btnSearch").click();*/

         <?php
      
          if($this->input->get("playlist",true))
          {
            ?>loadPlayListShare('<?php echo $this->input->get("playlist",true); ?>');<?php
          }
          ?>
    });
     </script>

</body>
</html>