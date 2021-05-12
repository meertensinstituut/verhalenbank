<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));

$bg_colors["File"] = "#DAFCFF";
$bg_colors["Lexicon item"] = "#DAFFDF";
$bg_colors["Volksverhaaltype"] = "#FFDCDC";
$bg_colors["Textedition"] = "#EBEBEB";
$bg_colors["Volksverhaal"] = "white";
$bg_colors["Persoon"] = "#FFFFDC";
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation" id="secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo pagination_links();
#echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Narration Date')] = 'Dublin Core,Date';
$sortLinks[__('Subgenre')] = 'Item Type Metadata,Subgenre';
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Identifier')] = 'Dublin Core,Identifier';

$wrapper_tags = array('link_tag' => 'option value="col"', 'list_tag' => 'select');
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
<?php $itemtypename = metadata('item', 'Item Type Name') ? metadata('item', 'Item Type Name') : "";?>
<div class="item hentry" style = "background-color:<?php echo $bg_colors[$itemtypename] ?>">
    <h2><a href="<?php echo record_url('item', 'show'); ?>"><?php echo __($itemtypename) . ((metadata('item', array('Dublin Core', 'Identifier'))) ? " - " . metadata('item', array('Dublin Core', 'Identifier')) : "")
                            . (metadata('item', array('Dublin Core', 'Title')) ? " - " . metadata('item', array('Dublin Core', 'Title')) : " - " . __("[Untitled]")); ?></a>
    </h2>
    
    <div class="item-meta">
    <?php if (metadata('item', 'has thumbnail')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>

    <div class="item-description" style = "display:inline;">
        <?php if ($subgenre = metadata('item', array('Item Type Metadata', 'Subgenre'))): ?>
        <h4 style = "display:inline;"><?php echo $subgenre; ?></h4>
        <?php endif; ?>

        <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
        <div style = "display:inline; float:right;" class="item-date">
            <?php echo $date; ?>
        </div>
        <?php endif; ?>
        
    </div>
    
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

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
