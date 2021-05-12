<?php echo common("functions");?>
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Identifier')) . (metadata('item', array('Dublin Core', 'Title')) ? " - " . metadata('item', array('Dublin Core', 'Title')) : ""); ?></h1>

<p class="folktale-description" style="border:0; color:grey">Een <?php echo metadata('item', array('Item Type Metadata', 'Subgenre'), array('no_filter' => true)); ?> (<?php echo metadata('item', array('Dublin Core', 'Type'), array('no_filter' => true)); ?>), <?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>

<div id="primary">
    
    <?php fire_plugin_hook('public_items_show_top', array('view' => $this, 'item' => $item)); ?>
    
    <?php if (metadata('item', 'Item Type Name') == "Volksverhaal"): ?>
        <?php if (metadata('item', 'has files')): ?>
            <div id="image-fold" class="image-fold" style="height:180px; overflow:hidden; margin: 0px; padding: 0px">
                <center>
                    <?php echo files_for_item(array('showFilename' => false, 
                                                     'linkToMetadata' => true,
                                                     'linkAttributes' => array('rel'=>'lightbox', 'class'=>'lightboxlink'),
                                                     'imageSize'=> 'square_thumbnail',
                                                     'attributes' => array('style'=>'float:left'),
                                                     'icons' => array('application/pdf'=>img('pdf-icon.png'),
                                                                     'audio/mpeg'=>img('audio-file-xxl.png'),
                                                                     'video/quicktime'=>img('video-file-xxl.png'),
                                                                     'video/mp4'=>img('video-file-xxl.png'))
                                             ));?>
                  </center>
              </div>
              <div style="position: relative; margin-top:-80px; z-index:9999; height:80px; background: -webkit-gradient(linear, left top, left bottom, color-stop(1000%,rgba(255,255,255,1)), color-stop(0%,rgba(125,185,232,0)));">
                  <center><a id='showimages' href='#'><img src="<?php echo url("themes/verhalenbank/images/down.gif"); ?>"></a></center>
              </div>
          <?php endif; ?>

          <div class="element-set">
              <div class="element">
                  <h3>Hoofdtekst</h3>
                  <div class="element-text">
                    <?php echo metadata('item', array('Item Type Metadata', 'Text')); ?>
                  </div>
              </div>
          </div>
          <?php echo all_element_texts('item'); ?>
        <?php else: ?>
            <?php echo all_element_texts('item'); ?>
    <?php endif; ?>

</div><!-- end primary -->

<aside id="sidebar">

    <!-- To add divs under the collection div. -->
    <?php fire_plugin_hook('public_items_show_sidebar_ultimate_top', array('view' => $this, 'item' => $item)); ?>

    <!-- To add divs under the collection div. -->
    <?php fire_plugin_hook('public_items_show_sidebar_top', array('view' => $this, 'item' => $item)); ?>
    
    
    <!-- The following returns all of the files associated with an item. -->
    <?php if (metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <div id="item-images">
        
        <?php echo files_for_item(array('showFilename' => false, 
                                         'linkToMetadata' => true,
                                         'linkAttributes' => array('rel'=>'lightbox'),
                                         'imageSize'=>'square_thumbnail',
                                         'icons' => array('application/pdf'=>img('pdf-icon.png'),
                                                         'audio/mpeg'=>img('audio-file-xxl.png'),
                                                         'video/quicktime'=>img('video-file-xxl.png'),
                                                         'video/mp4'=>img('video-file-xxl.png'))
                                 ));?>
        </div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string_solr('item', '/solr-search?q=&facet='); ?></div>
    </div>
    <?php endif;?>

    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
    
</aside>

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>
