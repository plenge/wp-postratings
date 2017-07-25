<?php
/**
 * wp-postratings-pretty Templates.
 *
 * @package WordPress
 * @subpackage wp-postratings-pretty Plugin
 */


/**
 * Security check
 * Prevent direct access to the file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Permission check
 * Check whether the user can manage ratings
 */
if ( ! current_user_can( 'manage_ratings' ) ) {
	wp_die( esc_html__( 'Access Denied', 'wp-postratings-pretty' ) );
}


### Ratings Variables
$base_name = plugin_basename('wp-postratings-pretty/postratings-manager.php');
$base_page = 'admin.php?page='.$base_name;


### If Form Is Submitted
if ( isset( $_POST['Submit'] ) ) {
	check_admin_referer('wp-postratings-pretty_templates');
	$postratings_template_vote = wp_kses_post(trim($_POST['postratings_template_vote']));
	$postratings_template_text = wp_kses_post(trim($_POST['postratings_template_text']));
	$postratings_template_permission = wp_kses_post(trim($_POST['postratings_template_permission']));
	$postratings_template_none = wp_kses_post(trim($_POST['postratings_template_none']));
	$postratings_template_highestrated = wp_kses_post(trim($_POST['postratings_template_highestrated']));
	$postratings_template_mostrated = wp_kses_post(trim($_POST['postratings_template_mostrated']));
	$update_ratings_queries = array();
	$update_ratings_text = array();
	$update_ratings_queries[] = update_option('postratings_template_vote', $postratings_template_vote);
	$update_ratings_queries[] = update_option('postratings_template_text', $postratings_template_text);
	$update_ratings_queries[] = update_option('postratings_template_permission', $postratings_template_permission);
	$update_ratings_queries[] = update_option('postratings_template_none', $postratings_template_none);
	$update_ratings_queries[] = update_option('postratings_template_highestrated', $postratings_template_highestrated);
	$update_ratings_queries[] = update_option('postratings_template_mostrated', $postratings_template_mostrated);
	$update_ratings_text[] = esc_html__('Ratings Template Vote', 'wp-postratings-pretty');
	$update_ratings_text[] = esc_html__('Ratings Template Voted', 'wp-postratings-pretty');
	$update_ratings_text[] = esc_html__('Ratings Template No Permission', 'wp-postratings-pretty');
	$update_ratings_text[] = esc_html__('Ratings Template For No Ratings', 'wp-postratings-pretty');
	$update_ratings_text[] = esc_html__('Ratings Template For Highest Rated', 'wp-postratings-pretty');
	$update_ratings_text[] = esc_html__('Ratings Template For Most Rated', 'wp-postratings-pretty');
	$i = 0;
	$text = '';
	foreach($update_ratings_queries as $update_ratings_query) {
		if($update_ratings_query) {
			$text .= '<p style="color: green;">'.$update_ratings_text[$i].' '.esc_html__('Updated', 'wp-postratings-pretty').'</p>';
		}
		$i++;
	}
	if(empty($text)) {
		$text = '<p style="color: red;">'.esc_html__('No Ratings Templates Updated', 'wp-postratings-pretty').'</p>';
	}
}
?>
<script language="JavaScript" type="text/javascript">
/* <![CDATA[*/
	function ratings_updown_templates(template, print) {
		var default_template;
		switch(template) {
			case "vote":
				default_template = "%RATINGS_IMAGES_VOTE% <span class='rating-text'>%RATINGS_USERS% <?php esc_html_e('ratings', 'postrating-strings'); ?>.</span>";
				break;
			case "text":
				default_template = "%RATINGS_IMAGES_VOTE% <span class='rating-text'><?php esc_html_e('Thank you for the rating.', 'postrating-strings'); ?></span>";
				break;
			case "permission":
				default_template = "%RATINGS_IMAGES% (<em><strong>%RATINGS_SCORE%</strong> <?php esc_html_e('rating', 'wp-postratings-pretty'); ?><?php esc_html_e(',', 'wp-postratings-pretty'); ?> <strong>%RATINGS_USERS%</strong> <?php esc_html_e('votes', 'wp-postratings-pretty'); ?><?php esc_html_e(',', 'wp-postratings-pretty'); ?> <strong><?php esc_html_e('rated', 'wp-postratings-pretty'); ?></strong></em>)<br /><em><?php esc_html_e('You need to be a registered member to rate this.', 'wp-postratings-pretty'); ?></em>";
				break;
			case "none":
				default_template = "%RATINGS_IMAGES_VOTE% (<?php esc_html_e('No Ratings Yet', 'postrating-strings'); ?>";
				break;
			case "highestrated":
				default_template = "<li><a href=\"%POST_URL%\" title=\"%POST_TITLE%\">%POST_TITLE%</a> (%RATINGS_SCORE% <?php esc_html_e('rating', 'wp-postratings-pretty'); ?><?php esc_html_e(',', 'wp-postratings-pretty'); ?> %RATINGS_USERS% <?php esc_html_e('votes', 'wp-postratings-pretty'); ?>)</li>";
				break;
			case "mostrated":
				default_template = "<li><a href=\"%POST_URL%\"  title=\"%POST_TITLE%\">%POST_TITLE%</a> - %RATINGS_USERS% <?php esc_html_e('votes', 'wp-postratings-pretty'); ?></li>";
				break;
		}
		if(print) {
			jQuery("#postratings_template_" + template).val(default_template);
		} else {
			return default_template;
		}
	}
	function ratings_default_templates(template, print) {
		var default_template;
		switch(template) {
			case "vote":
				default_template = "%RATINGS_IMAGES_VOTE% <span class='rating-text'>%RATINGS_USERS% <?php esc_html_e('ratings', 'postrating-strings'); ?>.</span>";
				break;
			case "text":
				default_template = "%RATINGS_IMAGES_VOTE% <span class='rating-text'><?php esc_html_e('Thank you for the rating.', 'postrating-strings'); ?></span>";
				break;
			case "permission":
				default_template = "%RATINGS_IMAGES% (<em><strong>%RATINGS_SCORE%</strong> <?php esc_html_e('rating', 'wp-postratings-pretty'); ?><?php esc_html_e(',', 'wp-postratings-pretty'); ?> <strong>%RATINGS_USERS%</strong> <?php esc_html_e('votes', 'wp-postratings-pretty'); ?><?php esc_html_e(',', 'wp-postratings-pretty'); ?> <strong><?php esc_html_e('rated', 'wp-postratings-pretty'); ?></strong></em>)<br /><em><?php esc_html_e('You need to be a registered member to rate this.', 'wp-postratings-pretty'); ?></em>";
				break;
			case "none":
				default_template = "%RATINGS_IMAGES_VOTE% (<?php esc_html_e('No Ratings Yet', 'wp-postratings-pretty'); ?>)<br />%RATINGS_TEXT%";
				break;
			case "highestrated":
				default_template = "<li><a href=\"%POST_URL%\" title=\"%POST_TITLE%\">%POST_TITLE%</a> %RATINGS_IMAGES% (%RATINGS_AVERAGE% <?php esc_html_e('out of', 'wp-postratings-pretty'); ?> %RATINGS_MAX%)</li>";
				break;
			case "mostrated":
				default_template = "<li><a href=\"%POST_URL%\"  title=\"%POST_TITLE%\">%POST_TITLE%</a> - %RATINGS_USERS% <?php esc_html_e('votes', 'wp-postratings-pretty'); ?></li>";
				break;
		}
		if(print) {
			jQuery("#postratings_template_" + template).val(default_template);
		} else {
			return default_template;
		}
	}
/* ]]> */
</script>
<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<div class="wrap">
	<h1><?php esc_html_e('Post Ratings Templates', 'wp-postratings-pretty'); ?></h1>
	<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
		<?php wp_nonce_field('wp-postratings-pretty_templates'); ?>
		<h2><?php esc_html_e('Template Variables', 'wp-postratings-pretty'); ?></h2>
		<table class="form-table">
			<tr>
				<td><strong>%RATINGS_IMAGES%</strong> - <?php esc_html_e('Display the ratings images', 'wp-postratings-pretty'); ?></td>
				<td><strong>%RATINGS_IMAGES_VOTE%</strong> - <?php esc_html_e('Display the ratings voting image', 'wp-postratings-pretty'); ?></td>
			</tr>
			<tr>
				<td><strong>%RATINGS_AVERAGE%</strong> - <?php esc_html_e('Display the average ratings', 'wp-postratings-pretty'); ?></td>
				<td><strong>%RATINGS_USERS%</strong> - <?php esc_html_e('Display the total number of users rated for the post', 'wp-postratings-pretty'); ?></td>
			</tr>
			<tr>
				<td><strong>%RATINGS_MAX%</strong> - <?php esc_html_e('Display the max number of ratings', 'wp-postratings-pretty'); ?></td>
				<td><strong>%RATINGS_PERCENTAGE%</strong> - <?php esc_html_e('Display the ratings percentage', 'wp-postratings-pretty'); ?></td>
			</tr>
			<tr>
				<td><strong>%RATINGS_SCORE%</strong> - <?php esc_html_e('Display the total score of the ratings', 'wp-postratings-pretty'); ?></td>
				<td><strong>%RATINGS_TEXT%</strong> - <?php esc_html_e('Display the individual rating text. Eg: 1 Star, 2 Stars, etc', 'wp-postratings-pretty'); ?></td>
			</tr>
		</table>
		<h2><?php esc_html_e('Ratings Templates', 'wp-postratings-pretty'); ?></h2>
		<table class="form-table">
			 <tr>
				<td width="30%">
					<strong><?php esc_html_e('Ratings Vote Text:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?>
					<p style="margin: 2px 0">- %RATINGS_IMAGES_VOTE%</p>
					<p style="margin: 2px 0">- %RATINGS_MAX%</p>
					<p style="margin: 2px 0">- %RATINGS_SCORE%</p>
					<p style="margin: 2px 0">- %RATINGS_TEXT%</p>
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %RATINGS_PERCENTAGE%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('vote', true);" class="button" />
					<br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('vote', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_vote" name="postratings_template_vote"><?php echo esc_attr(stripslashes(get_option('postratings_template_vote'))); ?></textarea></td>
			</tr>
			<tr>
				<td width="30%">
					<strong><?php esc_html_e('Ratings Voted Text:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?>
					<p style="margin: 2px 0">- %RATINGS_IMAGES%</p>
					<p style="margin: 2px 0">- %RATINGS_MAX%</p>
					<p style="margin: 2px 0">- %RATINGS_SCORE%</p>
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %RATINGS_PERCENTAGE%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('text', true);" class="button" /><br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('text', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_text" name="postratings_template_text"><?php echo esc_attr(stripslashes(get_option('postratings_template_text'))); ?></textarea></td>
			</tr>
			<tr>
				<td width="30%">
					<strong><?php esc_html_e('Ratings No Permission Text:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?>
					<p style="margin: 2px 0">- %RATINGS_IMAGES%</p>
					<p style="margin: 2px 0">- %RATINGS_MAX%</p>
					<p style="margin: 2px 0">- %RATINGS_SCORE%</p>
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %RATINGS_PERCENTAGE%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('permission', true);" class="button" /><br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('permission', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_permission" name="postratings_template_permission"><?php echo esc_attr(stripslashes(get_option('postratings_template_permission'))); ?></textarea></td>
			</tr>
			<tr>
				<td width="30%">
					<strong><?php esc_html_e('Ratings None:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?><br />
					<p style="margin: 2px 0">- %RATINGS_IMAGES_VOTE%</p>
					<p style="margin: 2px 0">- %RATINGS_MAX%</p>
					<p style="margin: 2px 0">- %RATINGS_SCORE%</p>
					<p style="margin: 2px 0">- %RATINGS_TEXT%</p>
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %RATINGS_PERCENTAGE%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('none', true);" class="button" /><br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('none', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_none" name="postratings_template_none"><?php echo esc_attr(stripslashes(get_option('postratings_template_none'))); ?></textarea></td>
			</tr>
			<tr>
				<td width="30%">
					<strong><?php esc_html_e('Highest Rated:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?><br />
					<p style="margin: 2px 0">- %RATINGS_IMAGES%</p>
					<p style="margin: 2px 0">- %RATINGS_MAX%</p>
					<p style="margin: 2px 0">- %RATINGS_SCORE%</p>
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %RATINGS_PERCENTAGE%</p>
					<p style="margin: 2px 0">- %POST_ID%</p>
					<p style="margin: 2px 0">- %POST_TITLE%</p>
					<p style="margin: 2px 0">- %POST_EXCERPT%</p>
					<p style="margin: 2px 0">- %POST_CONTENT%</p>
					<p style="margin: 2px 0">- %POST_URL%</p>
					<p style="margin: 2px 0">- %POST_THUMBNAIL%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('highestrated', true);" class="button" /><br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('highestrated', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_highestrated" name="postratings_template_highestrated"><?php echo esc_attr(stripslashes(get_option('postratings_template_highestrated'))); ?></textarea></td>
			</tr>
			<tr>
				<td width="30%">
					<strong><?php esc_html_e('Most Rated:', 'wp-postratings-pretty'); ?></strong><br /><br />
					<?php esc_html_e('Allowed Variables:', 'wp-postratings-pretty'); ?><br />
					<p style="margin: 2px 0">- %RATINGS_USERS%</p>
					<p style="margin: 2px 0">- %RATINGS_AVERAGE%</p>
					<p style="margin: 2px 0">- %POST_ID%</p>
					<p style="margin: 2px 0">- %POST_TITLE%</p>
					<p style="margin: 2px 0">- %POST_EXCERPT%</p>
					<p style="margin: 2px 0">- %POST_CONTENT%</p>
					<p style="margin: 2px 0">- %POST_URL%</p>
					<p style="margin: 2px 0">- %POST_THUMBNAIL%</p>
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Normal Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_default_templates('mostrated', true);" class="button" /><br />
					<input type="button" name="RestoreDefault" value="<?php esc_html_e('Restore Default Template (Up/Down Rating)', 'wp-postratings-pretty'); ?>" onclick="ratings_updown_templates('mostrated', true);" class="button" />
				</td>
				<td><textarea cols="80" rows="15" id="postratings_template_mostrated" name="postratings_template_mostrated"><?php echo esc_attr(stripslashes(get_option('postratings_template_mostrated'))); ?></textarea></td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_html_e('Save Changes', 'wp-postratings-pretty'); ?>" />
		</p>
	</form>
</div>