<nav id="admin-bar">

<?php 
//admin bar setup
if($user = current_user()) {
    $item = get_view()->item;
    $collection = get_view()->collection;
    $simple_pages_page = get_view()->simple_pages_page;
    $exhibit_page = get_view()->exhibit_page;
    
    if(isset($item)) {
        $record = $item;
        $aclRecord = $item;
    }

    if(isset($collection)) {
        $record = $collection;
        $aclRecord = $collection;
    }

    if(isset($simple_pages_page)) {
        $record = $simple_pages_page;
        $aclRecord = 'SimplePages_Page';
    }

    if(isset($exhibit_page)) {
        $record = $exhibit_page;
        $aclRecord = $exhibit;
    }                

    if(isset($record)) {
        if(isset($item)) {
            $item_links['Annotate'] = array(
                'label' => __('Annotate'),
                'uri' => admin_url('annotation/annotation/edit/id/' . $record->id)
            );
        }
        if(is_allowed($aclRecord, 'edit')) {
            if(get_class($record) == 'ExhibitPage') {
                $edit_url = admin_url('exhibits/edit-page-content/' . $record->id);
                $show_url = admin_url('exhibits/show/' . $record->id);
            } elseif(get_class($record) == 'Collection') {
                $edit_url = admin_url('collections/edit/' . $record->id);
                $show_url = admin_url('collections/show/' . $record->id);
            } else {
                $edit_url = admin_url('items/edit/' . $record->id);
                $show_url = admin_url('items/show/' . $record->id);
            }
            //want to place it first in the navigation, so do an array merge
            $item_links['Edit Link'] = array(
                    'label'=>__('Classic edit'),
                    'uri'=> $edit_url
                    );
            $item_links['Show Link'] = array(
                    'label'=>__('Show in Admin'),
                    'uri'=> $show_url
                    );
//            revert_theme_base_url();
    //        $navLinks = array_merge($editLinks, $navLinks);
        }
    }
    $user_links = array(
        array(
            'label' => __('Profile'),
            'uri' => admin_url('/users/edit/'.$user->id)
        ),
        array(
            'label' => __('Enter Admin'),
            'uri' => admin_url('/')
        ),
        array(
            'label' => __('User favorites'),
            'uri' => url('/users/favorites')
        ),
        array(
            'label' => __('Log Out'),
            'uri' => url('/users/logout')
        )
    );
} 
else {
//    $item_links = array();
    $user_links = array();
}

?>

<ul class="topnav" id="item" style='display:inline;'>
    <?php if (isset($item_links)): ?>
        <li><a href="#"><?php echo __("Item"); ?></a>
            <?php echo nav($item_links); ?>
            <div class="clear"></div>
        </li>
    <?php endif; ?>
    <?php if (isset($user_links)): ?>
        <?php if ($user = current_user()): ?>
            <?php
                $userLink = html_escape($user->name);
            ?>
            <li><a href="#"><?php echo __('Welcome, %s', $userLink); ?></a>
                <?php echo nav($user_links, 'public_navigation_admin_bar'); ?>
            </li>
        <?php else:?>
            <li><a href="#"><?php echo __("Users"); ?></a>
                <?php echo nav($user_links, 'public_navigation_admin_bar'); ?>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>
</nav>

<script>
// hover property will help us set the events for mouse enter and mouse leave
jQuery('.topnav li').hover(
	// When mouse enters the .navigation element
	function () {
		//Fade in the navigation submenu
		jQuery('ul', this).fadeIn(); 	// fadeIn will show the sub cat menu
	}, 
	// When mouse leaves the .navigation element
	function () {
		//Fade out the navigation submenu
		jQuery('ul', this).fadeOut();	 // fadeOut will hide the sub cat menu		
	}
);
/*    jQuery( "#item" ).menu();
    jQuery( "#user" ).menu();*/
</script>