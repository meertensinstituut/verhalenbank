<?php
    $fileTitle = metadata('file', array('Dublin Core', 'Title')) ? strip_formatting(metadata('file', array('Dublin Core', 'Title'))) : metadata('file', 'original filename');

    if ($fileTitle != '') {
        $fileTitle = ': &quot;' . $fileTitle . '&quot; ';
    } else {
        $fileTitle = '';
    }
    $fileTitle = __('File #%s', metadata('file', 'id')) . $fileTitle;
?>
<?php echo head(array('title' => $fileTitle, 'bodyclass'=>'files show primary-secondary')); ?>

<h1><?php echo $fileTitle; ?></h1>

<div id="primary">
    <h2><?php echo $fileTitle; ?></h2>
    <?php echo file_markup($file, array('imageSize'=>'fullsize')); ?>
    <?php echo all_element_texts('file'); ?>
</div>

<aside id="sidebar">
    
    <div id="item-metadata" class="panel">
        <h2><?php echo __('Item'); ?></h2>
        <p><?php echo link_to_item(metadata($file->getItem(), array('Dublin Core', 'Identifier')), array(), 'show', $file->getItem()); ?></p>
    </div>
    
    <div id="format-metadata">
        <h2><?php echo __('Format Metadata'); ?></h2>
        <div id="original-filename" class="element">
            <h3><?php echo __('Original Filename'); ?></h3>
            <div class="element-text"><?php echo metadata('file', 'Original Filename'); ?></div>
        </div>
    
        <div id="file-size" class="element">
            <h3><?php echo __('File Size'); ?></h3>
            <div class="element-text"><?php echo __('%s bytes', metadata('file', 'Size')); ?></div>
        </div>

        <div id="authentication" class="element">
            <h3><?php echo __('Authentication'); ?></h3>
            <div class="element-text"><?php echo metadata('file', 'Authentication'); ?></div>
        </div>
    </div><!-- end format-metadata -->
    
    <div id="type-metadata" class="section">
        <h2><?php echo __('Type Metadata'); ?></h2>
        <div id="mime-type-browser" class="element">
            <h3><?php echo __('Mime Type'); ?></h3>
            <div class="element-text"><?php echo metadata('file', 'MIME Type'); ?></div>
        </div>
        <div id="file-type-os" class="element">
            <h3><?php echo __('File Type / OS'); ?></h3>
            <div class="element-text"><?php echo metadata('file', 'Type OS'); ?></div>
        </div>
    </div><!-- end type-metadata -->
</div>

</aside>
<?php echo foot();?>
