<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url("//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");
    queue_css_url('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file('normalize');
    queue_css_file('style');
    queue_css_file('logo');
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php 
    queue_js_file('vendor/modernizr');
    queue_js_file('vendor/selectivizr');
    queue_js_file('jquery-extra-selectors');
    queue_js_file('vendor/respond');
    queue_js_file('globals'); 
    queue_js_file('images'); 
    ?>
    
    <?php echo head_js(); ?>
    
    <style>
    .ui-menu {
      width: 140px;
    }
    </style>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-59302345-1', 'auto');
      ga('send', 'pageview');

    </script>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header>
            <?php fire_plugin_hook('public_header'); ?>
            <div id="site-title">
                <?php 
                    $q = array_key_exists("q", $_REQUEST) ? $_REQUEST["q"] : "";
                    $facet = array_key_exists("facet", $_REQUEST) ? $_REQUEST["facet"] : "";
                 ?>

                <div id="logowrapper">
                    <div class="logos" id="vkLogo">
                 	    <span class="icon-Verhalenkaart"></span><a href=" <?php echo url("") . "visuals/map?q=";# . urlencode($q) . "&facet=" . urlencode($facet) ?> "><strong>Kaart</strong></a>
                    </div>
                    <div class="logos" id="vbLogo">
                	    <span class="icon-book3"></span>&nbspNederlandse Volksverhalen<a href="<?php echo url(""); ?>" style="padding-left:0px;"><strong>Bank</strong></a>
                	</div>
                </div>
                <?php #echo link_to_home_page(theme_logo()); ?>
            </div>
            <div id="search-container">
                <div><?php echo search_form(array('show_advanced' => true)); ?></div>
                <div id="advanced-search-link"><?php 
                    if (plugin_is_active("SolrSearch")){
                        echo SolrSearch_Helpers_View::link_to_advanced_search(__('Advanced Search')); 
                    }
                ?></div><!-- ADDED BY IWE-->
            </div>
        </header>

        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
            <?php fire_plugin_hook('public_content_top'); ?>
