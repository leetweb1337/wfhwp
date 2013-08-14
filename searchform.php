<!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php _e('Suchbegriff eingeben', 'framework') ?>" onfocus="if(this.value=='<?php _e('Suchbegriff eingeben', 'framework') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Suchbegriff eingeben', 'framework') ?>';" />
	</fieldset>
<!--END #searchform-->
</form>