<?php

function custom_next_previous()
{
    //Starts a conditional statement that determines a search has been run
    if ($search = $_GET['search']) {
        // Sets the current item ID to the variable $current
        $current = item('id');
 
        // Get an array of all the items from the search, and all the IDs
        $list = get_items(array('search'=>$search),total_results());
        foreach ($list as &$value) {
            $itemIds[] = $value->id;
        }
 
        // Find where we currently are in the result set
        $key = array_search($current, $itemIds);
 
        // If we aren't at the beginning, print a Previous link
        if ($key > 0) {
            $previousItem = $list[$key - 1];
            $previousUrl = item_uri('show', $previousItem) . '?' . $_SERVER['QUERY_STRING'];
            echo '<li><a href="' . $previousUrl . '">Previous Item</a></li>';
        }
 
        // If we aren't at the end, print a Next link
        if ($key < count($list) - 1) {
            $nextItem = $list[$key + 1];
            $nextUrl = item_uri('show', $nextItem) . '?' . $_SERVER['QUERY_STRING'];
            echo '<li class="next"><a href="' . $nextUrl . '">Next Item</a></li>';
        }
    } else {
        // If a search was not run, then the normal next/previous navigation is displayed.
        echo '<li>'.link_to_previous_item('Previous Item').'</li>';
        echo '<li class="next">'.link_to_next_item('Next Item').'</li>';
    }
}

/**
 * Return a tag string given an Item, Exhibit, or a set of tags.
 *
 * @package Omeka\Function\View\Tag
 * @param Omeka_Record_AbstractRecord|array $recordOrTags The record to retrieve
 * tags from, or the actual array of tags
 * @param string|null $link The URL to use for links to the tags (if null, tags
 * aren't linked)
 * @param string $delimiter ', ' (comma and whitespace) is the default tag_delimiter option. Configurable in Settings
 * @return string HTML
 */
function tag_string_solr($recordOrTags = null, $link = 'items/browse', $delimiter = null)
{
    // Set the tag_delimiter option if no delimiter was passed.
    if (is_null($delimiter)) {
        $delimiter = get_option('tag_delimiter') . ' ';
    }

    if (!$recordOrTags) {
        $tags = array();
    } else if (is_string($recordOrTags)) {
        $tags = get_current_record($recordOrTags)->Tags;
    } else if ($recordOrTags instanceof Omeka_Record_AbstractRecord) {
        $tags = $recordOrTags->Tags;
    } else {
        $tags = $recordOrTags;
    }

    if (empty($tags)) {
        return '';
    }

    $tagStrings = array();
    foreach ($tags as $tag) {
        $name = $tag['name'];
        if (!$link) {
            $tagStrings[] = html_escape($name);
        } else {
            $tagStrings[] = '<a href="' . html_escape(url($link . 'tag:"' . $name . '"')) . '" rel="tag">' . html_escape($name) . '</a>';
        }
    }
    return join(html_escape($delimiter), $tagStrings);
}
?>