<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php echo $this->formText('query', $filters['query']); ?>
    <?php if ($options['show_advanced']): ?>
    <fieldset id="advanced-form">
        <a href="<?php print url("/zoekhulp"); ?>" target="help"><img href=<?php echo img('info-icon.png')?>>Zoekhulp</a>
    </fieldset>
    <?php endif; ?>
    <?php echo $this->formSubmit(null, $options['submit_value']); ?>
</form>
