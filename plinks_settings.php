<div class="wrap">
<div class="icon32"></div>
<h2>pLinks Settings</h2>
<form method="post" action="options.php">
<?php
settings_fields( 'plinks-settings' );
?>
<div id="poststuff">
<div class="postbox">
<h3>Thumbnail Settings</h3>
	<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show Preview Images</th>
        <td><input type="checkbox" name="websnapr-show" id="websnapr-show" value="1" <?php checked(get_option('websnapr-show'), 1); ?> /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Thumbnail Image Size</th>
        <td>
        	<select name="websnapr-size">
        		<option value="t" <?php if (get_option('websnapr-size')=='t') print('selected'); ?>>tiny - 90x68px</option>
        		<option value="s" <?php if (get_option('websnapr-size')=='s') print('selected'); ?>>small - 120x90px</option>
        		<option value="m" <?php if (get_option('websnapr-size')=='m') print('selected'); ?>>medium - 200x150px</option>
        		<option value="l" <?php if (get_option('websnapr-size')=='l') print('selected'); ?>>large - 400x300px</option>
        		<option value="x" <?php if (get_option('websnapr-size')=='x') print('selected'); ?>>extra large - 480x380px</option>
        	</select>
        </td>
        </tr>

    </table>
    </div>
</div>
</div>
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>
<br />

<div id="poststuff">
<div class="postbox">
<h3>pLinks Usage</h3>
	<div class="inside">
	Simple use a shortcode on a page of your choice or create a new page and insert the following
	shortcode: <b>[plinks category_name="Blogroll"]</b>. Use a category that exists! <br />
	<br />
	Happy Linking.
    </div>
</div>
</div>

</div>