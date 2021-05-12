<?php
//"Identifier", "Title", "Subject", "Description"
// Settings from the verhalenbank plugin
$medium_commonly_searched_fields = explode(",", get_option('mediumsearchablefields'));
#$medium_commonly_searched_fields = array(43, 50, 49); #TEMPORARY

$collections_search_options = array(1 => "Nederlandse volksverhalen", null => __("Complete website"));

$selected_collection = @$_REQUEST['collection'] ? @$_REQUEST['collection'] : 1; 

$all_table_options = get_table_options('Element', null, array(
    'record_types' => array('Item', 'All'),
    'sort' => 'alphaBySet')
);

$merged_table_options = $all_table_options["Dublin Core"] + $all_table_options["Itemtype metadata"];

if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>

<form <?php echo tag_attributes($formAttributes);?>>
    <ul>
        <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
        <INPUT TYPE="button" onClick="parent.location='<?php echo url('items/search')?>'"value="<?php echo __('Reset form'); ?>" />
    </ul>
    <div class="field">
        <?php echo $this->formLabel('collection-search', __('Search By Collection')); ?>
        <div class="inputs">
        <?php
            echo $this->formRadio(
                'collection',
                $selected_collection,
                array('id' => 'collection-search'),
                $collections_search_options
            );
        ?>
        </div>
    </div>
    <div id="search-keywords" class="field">
<!--        <?php echo $this->formLabel('keyword-search', __('Search for Keywords')); ?>
        <div class="inputs">
        <?php
            echo $this->formText(
                'search',
                @$_REQUEST['search'],
                array('id' => 'keyword-search', 'size' => '40')
            );
        ?>
        </div>-->
        <?php echo $this->formLabel('tag-search', __('Search By Tags')); ?>
        <div class="inputs">
        <?php
            echo $this->formText('tag', @$_REQUEST['tag'],
                array('size' => '40', 'id' => 'tag-search')
            );
        ?>
        </div>
    </div>
    
<!-- This is where the alternative search form starts -->
    <div id="search-by-certain-fields" class="field">
        <?php
        if (!empty($_GET['advanced'])) {
            $search = $_GET['advanced'];
/*            print "<pre>";
            print_r($search);
            print "</pre>";*/
        } else {
            $search = array();
        }
        ?>
        <div class="label"><?php echo __('Narrow by Specific Fields'); ?></div>
        <center>
        <table width=90%>
        <?php
        foreach ($medium_commonly_searched_fields as $i => $table_option):?>
            <tr>
            <td>
                <div><?php echo $merged_table_options[$table_option];?></div>
            </td>
            <?php 
            $basename = "advanced[$i]";
            $basenameC = "advanced\\\\[$i\\\\]";
            $basenameID = "advanced-$i";
            
            $hidden_element_id = $this->formHidden(
                $basename . "[element_id]",
                $table_option,
                array('hidden' => true));
//            echo $hidden_element_id; ############ TEMP
            
            $hidden_type = $this->formHidden(
                $basename . "[type]",
                "contains",
                array('hidden' => true));
//            echo $hidden_type;
            ?>
            <td name="<?php echo $basename ?>" id="<?php echo $basenameID ?>"></td>
            <td><?php
            echo $this->formText(
                $basename . "[terms]",
                array_key_exists($i, $search) ? $search[$i]["terms"] : "",
                array("style" => "margin-bottom:0;")
            );?></td>
            </tr>
            <script>
                function addRestFields() {
                    jQuery( 'input#<?php echo $basenameID; ?>-element_id' ).remove();
                    jQuery( 'input#<?php echo $basenameID; ?>-type' ).remove();
                    if (jQuery('input#<?php echo $basenameID; ?>-terms').val()){
                        jQuery('td#<?php echo $basenameID; ?>').append( '<?php echo $hidden_element_id; ?>' );
                        jQuery('td#<?php echo $basenameID; ?>').append( '<?php echo $hidden_type; ?>' );
                    }
                }
                jQuery('#<?php echo $basenameID; ?>-terms').change(addRestFields);
                if (jQuery('#<?php echo $basenameID; ?>-terms').val().length > 0) {
                    addRestFields();
                }
            </script>
        <?php endforeach; ?>
        </table>
    </div>


    <?php if(is_allowed('Users', 'browse')): ?>
    <div class="field">
    <?php
        echo $this->formLabel('user-search', __('Search By User'));?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'user',
                @$_REQUEST['user'],
                array('id' => 'user-search'),
                get_table_options('User')
            );
        ?>
        </div>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_search', array('view' => $this)); ?>
    
    <div>
        <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
        <INPUT TYPE="button" onClick="parent.location='<?php echo url('items/search')?>'"value="<?php echo __('Reset form'); ?>" />
    </div>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
        jQuery(window).bind("pageshow", function() {
//            console.log(jQuery('#advanced-search-form'));
            jQuery('#advanced-search-form')[0].reset();
        });
    });
</script>
