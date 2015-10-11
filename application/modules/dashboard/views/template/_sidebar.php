 <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo $this->session->userdata('avatar'); ?>" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Welcome</p>

            <a href="<?php echo base_url(); ?>dashboard/logout" title="Logout"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('nickname'); ?></a>
            <br>            
        </div>

    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li <?php if($active == 'dashboard'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
      
        <li class="treeview <?php if($active == 'settings'){ echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if($active2 == 'website'){ echo 'class="active"'; } ?> ><a href="<?php echo base_url(); ?>dashboard/website"><i class="fa fa-gears"></i> Website</a></li>
                <li <?php if($active2 == 'ads'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/ads"><i class="fa fa-money"></i> Advertising</a></li>
                <li <?php if($active2 == 'gui'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/gui"><i class="fa fa-cubes"></i> GUI</a></li>
                <li <?php if($active2 == 'themes'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/themes"><i class="fa fa-desktop"></i> Themes - Desktop</a></li>
                <li <?php if($active2 == 'themes_mobile'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/themes_mobile"><i class="fa fa-eye"></i> Themes - Mobile</a></li>
                <li <?php if($active2 == 'genres'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/genres"><i class="fa fa-list"></i> Genres</a></li>
                <li <?php if($active2 == 'email'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/smtp"><i class="fa fa-envelope-o"></i> SMTP Server (Email)</a></li>
                <li <?php if($active2 == 'newsletter'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/newsletter"><i class="fa fa-paper-plane-o"></i> Newsletter</a></li>
                 <li <?php if($active2 == 'comments'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/comments"><i class="fa fa-comments-o"></i> Social Network</a></li>                                
                <li <?php if($active2 == 'carousel'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/carousel"><i class="fa fa-picture-o"></i> Carousel</a></li>                                
                <li <?php if($active2 == 'stations'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/stations"><i class="fa fa-music"></i> Stations</a></li>                                
                <li <?php if($active2 == 'badges'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/badges"><i class="fa fa-trophy"></i> Badges</a></li>                                
            </ul>
        </li>

          <li class="treeview <?php if($active == 'pages'){ echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-pencil-square"></i>
                <span>Custom Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if($active == 'pages'){ echo 'active'; } ?>">
                <li <?php if($active2 == 'list_pages'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/list_pages"><i class="fa fa-angle-right"></i> My Pages</a></li>
                <li <?php if($active2 == 'page'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/page"><i class="fa fa-angle-right"></i> New Page</a></li>
                <li <?php if($active2 == 'page_artist'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/page_artist"><i class="fa fa-angle-right"></i> Top Artist</a></li>                
               
            </ul>
        </li>

         <li <?php if($active == 'downloads'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url(); ?>dashboard/downloads">
                <i class="fa fa-cloud-download"></i> <span>Downloads</span>
            </a>
        </li>  

          <li <?php if($active == 'users'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url(); ?>dashboard/users">
                <i class="fa fa-users"></i> <span>Users</span>
            </a>
        </li>      
        <?php if( $this->config->item("use_db_language") == '1')
        { ?>
        <li <?php if($active == 'language'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url(); ?>dashboard/language">
               <i class="fa fa-language"></i> <span>Languages</span>
            </a>
        </li>   
        <?php } ?>
        <?php if( $this->config->item("module_user_online") == '1')
        {
            ?>
            <li <?php if($active == 'online'){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?>dashboard/online">
                    <i class="fa fa-dot-circle-o"></i> <span>Users Online</span>
                </a>
            </li>    
            <?php
        }
        ?>

        <?php if( $this->config->item("local_lyrics") == '1')
        {
            ?>

            <li class="treeview  <?php if($active == 'lyrics'){ echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-align-center"></i>
                <span>Lyrics</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if($active == 'pages'){ echo 'active'; } ?>">
                <li <?php if($active2 == 'lyrics'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/lyrics"><i class="fa fa-angle-right"></i> My Lyrics</a></li>
                <li <?php if($active2 == 'lyric'){ echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>dashboard/lyric"><i class="fa fa-angle-right"></i> New Lyric</a></li>
                
               
            </ul>
        </li>
           
            <?php
        }
        ?>
        <?php
        $extra = $this->admin->getTable('extra_menus');
        foreach ($extra->result() as $row) {
            ?>
            <li <?php if($active == $row->keyname ){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?><?php echo $row->route; ?>">
                    <i class="<?php echo $row->icon; ?>"></i> <span><?php echo $row->title; ?></span>
                </a>
            </li>      
            <?php
        }
        ?>

        
    </ul>
</section>