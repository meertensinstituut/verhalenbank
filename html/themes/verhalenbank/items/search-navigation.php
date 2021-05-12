<nav id="section-nav" class="navigation vertical">
<?php
    
    $navArray = array(
        'Folktales' => array('label'=>__('Folktales'), 'uri'=>url('search/index') ),
        'Other content' => array('label'=>__('Other content'), 'uri'=>url('items/search-veryadvanced') )
        );
    
    echo nav($navArray, 'annotation_navigation');
?>
</nav>