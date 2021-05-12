<?php
$pageTitle = __('Search Omeka ') . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();

$bg_colors["File"] = "#DAFCFF";
$bg_colors["Lexicon item"] = "#DAFFDF";
$bg_colors["Volksverhaaltype"] = "#FFDCDC";
$bg_colors["Textedition"] = "#EBEBEB";
$bg_colors["Volksverhaal"] = "white";
$bg_colors["Persoon"] = "#FFFFDC";

?>
<?php echo search_filters(); ?>

<?php if ($total_results): ?>
<div id="search-filters" style="display:inline; float:none;">
<ul><li><?php echo __('Total results: ');?> <?php echo $total_results; ?></li></ul>
</div>

<?php echo pagination_links(); ?>

<!-- ############################# TEST PLACE -->
<?php foreach (loop('search_texts') as $searchText): ?>
<?php endforeach; ?>
<!-- ################################### -->

<table id="search-results">
</table>

    <?php foreach (loop('search_texts') as $searchText): ?>
        <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
        <?php $this->item = $record;?>

        <?php if ($searchRecordTypes[$searchText['record_type']] == __("File")):?>
            <?php $itemtypename = "File"; ?>
            <div class="item hentry" style = "background-color:<?php echo $bg_colors[$itemtypename] ?>">
            <h2><a href="<?php echo record_url($record, 'show'); ?>">
                <i style = "color:<?php echo $verhalenbank_file_color?>"><?php echo __($itemtypename) . "</i> - " . metadata($record, array('Dublin Core', 'Identifier')) ?></a>
            </h2>
            
            <div class="item-meta">            
                <div class="item-img">
                    <?php echo file_markup($record, array('imageSize'=>'thumbnail')); ?>
                </div>
            </div>
            
            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($searchRecordTypes[$searchText['record_type']] == "Item"):?>
            <?php $itemtypename = metadata($record, 'Item Type Name') ? metadata($record, 'Item Type Name') : "";?>
            <div class="item hentry" style = "background-color:<?php echo $bg_colors[$itemtypename] ?>">
        
            <h2><a href="<?php echo record_url($record, 'show'); ?>"><?php echo __($itemtypename) . ((metadata($record, array('Dublin Core', 'Identifier'))) ? " - " . metadata($record, array('Dublin Core', 'Identifier')) : "")
                                    . ($searchText['title'] ? " - " . $searchText['title'] : " - " . __("[Untitled]")); ?></a>
            </h2>

            <div class="item-meta">            
            <?php if (metadata('item', 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('square_thumbnail')); ?>
                </div>
            <?php endif; ?>
            
            <?php 
                //TEMPORARY FIX FOR DATES
                add_filter(array('Display', 'Item', 'Dublin Core', 'Date'),                         'present_dates_as_language', 20); 
                if ($subgenre = metadata('item', array('Item Type Metadata', 'Subgenre'))): ?>
                <div class="item-description">
                <h4 style = "display:inline;"><?php echo $subgenre; ?></h4>
                <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
                    <div style = "display:inline-block; float:right;" class="item-date">
                        <?php echo $date; ?>
                    </div>
                <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
        
            <?php if (metadata('item', 'has tags')): ?>
            <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                <?php echo tag_string('items'); ?></p>
            </div>
            <?php endif; ?>
                </div>
        <?php endif; ?>
        
        </div>
    <?php endforeach; ?>

<?php echo pagination_links(); ?>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results.');?></p>
</div>
<?php endif; ?>
<?php echo foot(); ?>