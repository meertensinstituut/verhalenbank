<?php
$pageTitle = __('Search Items');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>

<h1><?php echo $pageTitle; ?></h1>
<?php 

if (!empty($_GET['style'])) {
    $search_style = $_GET['style'];
} else {
    $search_style = "advanced";
}
?>

<nav class="items-nav navigation secondary-nav">
    <ul id="section-nav" class="navigation">
        <li class="<?php if (isset($_GET['style']) &&  $_GET['style'] == 'advanced') {echo 'navigation_current';} ?>">
            <a href="<?php echo html_escape(url('items/search?style=advanced')); ?>"><?php echo __('Advanced Search'); ?></a>
        </li>
        <li class="<?php if (isset($_GET['style']) && $_GET['style'] == 'veryadvanced') {echo 'navigation_current';} ?>">
            <a href="<?php echo html_escape(url('items/search?style=veryadvanced')); ?>"><?php echo __('VERY advanced Search'); ?></a>
        </li>
    </ul>
</nav>

<?php 
if ($search_style == "advanced"){
    echo $this->partial('items/search-form.php', array('formAttributes' =>
                        array('id'=>'advanced-search-form')));
}
elseif ($search_style == "veryadvanced"){
    echo $this->partial('items/search-form-hard.php', array('formAttributes' =>
                        array('id'=>'advanced-search-form')));
}?>

<?php echo foot(); ?>
