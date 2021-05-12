<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));

?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="navigation items-nav secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>
<br>
<h3> Top 100 </h3>

<?php 
    $most_tags = get_records('Tag',
                        array(
                             'sort_field'=>'count',
                             'sort_dir'=>'d'),
                        100);
    echo tag_cloud($most_tags, 'items/browse', $maxClasses = 15);
    
    if (!empty($_GET['sort_field'])) {
        print "<h3> Alphabetisch </h3>";
        $alpha_tags = get_records('Tag',
                            array('sort_field'=>'name',
                                  'sort_dir'=>'a'),
                                  100000);
        echo tag_cloud($alpha_tags, 'items/browse', $maxClasses = 15);
    } else { ?>
            <br>
            <a href="<?php echo html_escape(url('items/tags?sort_field=name')); ?>"><?php echo __('Alle trefwoorden alphabetisch weergeven (laden duurt lang)'); ?></a>
            <br>
    <?php } ?>

<?php echo foot(); ?>
