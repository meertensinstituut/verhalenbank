<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Contribution
 */

queue_js_file('contribution-public-form');
$contributionPath = get_option('contribution_page_path');
if(!$contributionPath) {
    $contributionPath = 'contribution';
}
queue_css_file('form');

//load user profiles js and css if needed
if(get_option('contribution_user_profile_type') && plugin_is_active('UserProfiles') ) {
    queue_js_file('admin-globals');
    queue_js_file('tiny_mce', 'javascripts/vendor/tiny_mce');
    queue_js_file('elements');
    queue_css_string("input.add-element {display: block}");
}

$head = array('title' => 'Contribute',
              'bodyclass' => 'contribution');
echo head($head); ?>
<script type="text/javascript">
// <![CDATA[
enableContributionAjaxForm(<?php echo js_escape(url($contributionPath.'/type-form')); ?>);
// ]]>
</script>

<h1><?php echo __($head['title']); ?></h1>

<div id="primary">
<?php echo flash(); ?>
    
    <?php if(!get_option('contribution_simple') && !$user = current_user()) :?>
        <?php $session = new Zend_Session_Namespace;
              $session->redirect = absolute_url();
        ?>
        <p><?php echo __("You must"); ?> <a href='<?php echo url('guest-user/user/register'); ?>'> <?php echo __("create an account") ?> </a> <?php echo __("or") ?> <a href='<?php echo url('guest-user/user/login'); ?>'> <?php echo __("log in")?> </a> <?php echo __("before contributing. You can still leave your identity to site visitors anonymous."); ?></p>
    <?php else: ?>
        <form method="post" action="" enctype="multipart/form-data">
            <fieldset id="contribution-item-metadata">
                <div class="inputs">
                    <label for="contribution-type"><?php echo __("What type of item do you want to contribute?"); ?></label>
                    <?php $options = get_table_options('ContributionType' ); ?>
                    <?php $typeId = isset($type) ? $type->id : '' ; ?>
                    <?php echo $this->formSelect( 'contribution_type', $typeId, array('multiple' => false, 'id' => 'contribution-type') , $options); ?>
                    <input type="submit" name="submit-type" id="submit-type" value="Select" />
                </div>
                <div id="contribution-type-form" class="inputs">
                <?php if(isset($type)) { include('type-form.php'); }?>
                </div>
            </fieldset>
            
            <fieldset id="contribution-confirm-submit" <?php if (!isset($type)) { echo 'style="display: none;"'; }?>>
                <div class="inputs">
                    <?php echo $this->formCheckbox('contribution-public', "1", array('hidden' => true), array(1,0)); ?>
                </div>
                <div class="inputs">
                    <?php $anonymous = isset($_POST['contribution-anonymous']) ? $_POST['contribution-anonymous'] : 0; ?>
                    <?php echo $this->formCheckbox('contribution-anonymous', $anonymous, array('hidden' => true), array(1, 0)); ?>
<!--                 <?php echo $this->formLabel('contribution-anonymous', __("Contribute anonymously.")); ?> -->

                    <p><label for="terms-agree"><?php echo __("In order to contribute, you must read and agree to the %s",  "<a href='" . contribution_contribute_url('terms') . "' target='_blank'>" . __('Terms and Conditions') . ".</a>"); ?></label></p>
                    <?php $agree = isset( $_POST['terms-agree']) ?  $_POST['terms-agree'] : 0 ?>
                    <?php echo $this->formCheckbox('terms-agree', $agree, null, array('1', '0')); ?>
                    <?php echo $this->formLabel('terms-agree', __('I agree to the Terms and Conditions.')); ?>
                </div>
                
                <?php echo $this->formSubmit('form-submit', __('Contribute'), array('class' => 'submitinput')); ?>
            </fieldset>
        </form>
    <?php endif; ?>
</div>
<?php echo foot();
