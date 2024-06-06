<?php

/*
$activate = get_option('fbs_fab_activate', '');
$position = get_option('fbs_fab_position', '');
$type = get_option('fbs_fab_type', '');

$main_img_id = get_option('fbs_fab_main_img_id', '0');
$main_color = get_option('fbs_fab_main_color', FBS_COLOR);
$main_bg_color = get_option('fbs_fab_main_bg_color', FBS_BG_COLOR);
$main_img_attachment = wp_get_attachment_image_src($main_img_id, 128);
$main_link = get_option('fbs_fab_main_link', '');
$main_text = get_option('fbs_fab_main_text', '');
$page_slug = get_option('fbs_fab_page_slug', '');
*/

if(isset($main_img_attachment[0])){
    $main_img_src = $main_img_attachment[0];
}else{
    $main_img_src = FBS_DEFAULT_IMG;
}
$fbs_btns = get_option('fbs_buttons', json_encode(array()));
print_r($fbs_btns);
//$fbs_btns = json_decode($fbs_btns, TRUE);

$fbs_sub_btns = get_option('fbs_sub_btns', json_encode(array()));
$fbs_sub_btns = json_decode($fbs_sub_btns, TRUE);
  
add_filter('wp_dropdown_pages', 'make_multiple_select_pages');

function make_multiple_select_pages($output) {
    return str_replace('<select ', '<select multiple="multiple" ', $output);
}
  
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div id="wpbody" role="main">
    <div id="wpbody-content" aria-label="Main content" tabindex="0">
	
        <div class="wrap" style="padding-bottom: 300px;">
            <h1 class="wp-heading-inline">
            	<?php _e('Floating Buttons', 'floating-buttons'); ?>
            </h1>
		<!--	
		<section style="margin-top: 50px; padding:20px; border:1px solid #ddd;">
			<h2 class="wp-heading-inline">
            	<?php _e('Button #1', 'floating-buttons'); ?>
            </h2>
            <table class="widefat">
                <thead>
                    <tr>
                        <th colspan="2">
                            <h1><?php _e('Basic Settings', 'floating-buttons'); ?></h1>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fbs-td-1">
                            <?php _e('Activate', 'floating-buttons'); ?> <span class="required">*</span>	
                        </td>
                        <td>
                            <select id="fbs-activate" class="fbs-form-element">
                                <option value="0" <?php if($activate == '0'){ echo 'selected'; } ?> ><?php _e('No', 'floating-buttons'); ?></option>
                                <option value="1" <?php if($activate == '1'){ echo 'selected'; } ?> ><?php _e('Yes', 'floating-buttons'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="fbs-td-1">
                            <?php _e('Button Position', 'floating-buttons'); ?> <span class="required">*</span>	
                        </td>
                        <td>
                            <select id="fbs-position" class="fbs-form-element">
                                <option value="1" <?php if($position == '1'){ echo 'selected'; } ?> ><?php _e('Top Left', 'floating-buttons'); ?></option>
                                <option value="2" <?php if($position == '2'){ echo 'selected'; } ?> ><?php _e('Top Right', 'floating-buttons'); ?></option>
                                <option value="3" <?php if($position == '3'){ echo 'selected'; } ?> ><?php _e('Bottom Right', 'floating-buttons'); ?></option>
                                <option value="4" <?php if($position == '4'){ echo 'selected'; } ?> ><?php _e('Bottom Left', 'floating-buttons'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="fbs-td-1">
                            <?php _e('Button Type', 'floating-buttons'); ?> <span class="required">*</span>	
                        </td>
                        <td>
                            <select id="fbs-type" class="fbs-form-element">
								<option value="0" <?php if($type == '0'){ echo 'selected'; } ?> ><?php _e('Simple Click Icon', 'floating-buttons'); ?></option>
								<option value="4" <?php if($type == '4'){ echo 'selected'; } ?> ><?php _e('Simple Click Text', 'floating-buttons'); ?></option>
                                <option value="1" <?php if($type == '1'){ echo 'selected'; } ?> ><?php _e('Display on Click', 'floating-buttons'); ?></option>
                                <option value="2" <?php if($type == '2'){ echo 'selected'; } ?> ><?php _e('Display on Hover', 'floating-buttons'); ?></option>
                            </select>
                        </td>
                    </tr>
					<tr>
                        <td class="fbs-td-1">
                            <?php _e('Show on which pages?', 'floating-buttons'); ?>
                        </td>
                        <td class="fbs-td-2">
                            <input id="fbs-page-slug" value="<?php esc_html_e($page_slug) ?>">
						
                        </td>

                    </tr>
                </tbody>
            </table>
            <table class="widefat fbs-table">
                <thead>
                    <tr>
                        <td colspan="3">
                            <h1><?php _e('Content', 'floating-buttons'); ?></h1>
                        </td>
                    </tr>
                </thead>
                <tbody>

					 <tr>
                        <td class="fbs-td-1">
                            <?php _e('Button Text', 'floating-buttons'); ?>
                        </td>
                        <td class="fbs-td-2">
                            <input id="fbs-main-btn-text" value="<?php esc_html_e($main_text) ?>">
                        </td>

                    </tr>
					<tr>
                        <td class="fbs-td-1">
                            <?php _e('Main Button Link', 'floating-buttons'); ?>
                        </td>
                        <td class="fbs-td-2">
                            <input id="fbs-main-btn-link" value="<?php esc_html_e($main_link) ?>">
                        </td>
                    </tr>
				</tbody>
			</table>
			<table class="widefat fbs-table">
                <thead>
                    <tr>
                        <td colspan="3">
                            <h1><?php _e('Styling', 'floating-buttons'); ?></h1>
                        </td>
                    </tr>
                </thead>
                <tbody>
					<tr>
                        <td class="fbs-td-1">
                            <?php _e('Button Icon', 'floating-buttons'); ?>
                        </td>
                        <td class="fbs-td-2">
                            <button id="fbs-main-btn-icon" data-id="<?php esc_html_e($main_img_id) ?>" class="button button-small button-seconday">
                                <?php _e('Select Icon', 'floating-buttons'); ?> 
                            </button>
                            <small class="fbs-small"><?php _e('Size 128x128 px', 'floating-buttons'); ?></small>
                        </td>
                        <td rowspan="3" style="vertical-align: middle;">
                            <img src="<?php esc_html_e($main_img_src) ?>" id="fbs-main-btn-preview-img" style="background-color: <?php esc_html_e($main_bg_color) ?>; color: <?php esc_html_e($main_color) ?>;">
                        </td>
                    </tr>
                    <tr>
                        <td class="fbs-td-1">
                            <?php _e('Icon Color', 'floating-buttons'); ?> <span class="required">*</span>	
                        </td>
                        <td class="fbs-td-2">
                            <input id="fbs-main-btn-color" value="<?php esc_html_e($main_color) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="fbs-td-1">
                            <?php _e('Background Color', 'floating-buttons'); ?> <span class="required">*</span>	
                        </td>
                        <td class="fbs-td-2">
                            <input id="fbs-main-btn-bg-color" value="<?php esc_html_e($main_bg_color) ?>">
                        </td>
					</tr>

                    
                </tbody>
            </table>
            <table class="widefat fbs-table">
                <thead>
                    <tr>
                        <th colspan="8">
                            <h1><?php _e('Popup Buttons', 'floating-buttons'); ?></h1>
                        </th>
                    </tr>
                    <tr>
                        <th><?php _e('Title', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Content', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Button Icon', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Text Color', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Background Color', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="fbs-sub-btns-tbody">
                    <?php if(is_array($fbs_fab_sub_btns) && count($fbs_fab_sub_btns) > 0): ?>
                        <?php foreach($fbs_fab_sub_btns as $fbs_fab_sub_btn): ?>
                            <?php $fbs_fab_sub_btn = fbs_fab_parse_content($fbs_fab_sub_btn); ?>
                            <?php list($type, $title, $content, $img_id, $color, $bg_color) = explode('|', $fbs_fab_sub_btn); ?>
                            <tr data-type="<?php esc_html_e($type) ?>">
                                <td>
                                    <div style="font-weight: bold; text-transform: uppercase;">
                                    	<?php esc_html_e($type) ?>
                                	</div>
                                    <input class="fbs-sub-btn-titles" value="<?php esc_html_e($title) ?>">
                                </td>
                                <td>
                                    <textarea class="fbs-sub-btn-contents"><?php esc_html_e($content) ?></textarea>
                                </td>
                                <td>
                                    <button data-id="<?php esc_html_e($img_id) ?>" class="button button-small button-secondary fbs-sub-btn-icons">
                                        <?php _e('Select Icon', 'floating-buttons'); ?>
                                    </button>
                                    <small class="fbs-small"><?php _e('Size 128x128 px', 'floating-buttons'); ?></small>
                                </td>
                                <td>
                                    <input class="fbs-sub-btn-colors" value="<?php esc_html_e($color) ?>">
                                </td>
                                <td>
                                    <input class="fbs-sub-btn-bg-colors" value="<?php esc_html_e($bg_color) ?>">
                                </td>
                                <td>
                                    <span class="dashicons dashicons-move fbs-sub-btn-sort"></span>
                                </td>
                                <td>
                                    <span class="dashicons dashicons-no fbs-sub-btn-rm"></span>
                                </td>
                                <td>
                                    <?php 
                                        $image_attachment = wp_get_attachment_image_src($img_id, 128);
                                        if(isset($image_attachment[0])){
                                            $image_src = $image_attachment[0];
                                        }else{
                                            $image_src = FBS_DEFAULT_IMG;
                                        }
                                    ?>
                                    <img class="fbs-sub-btn-preview-img" src="<?php esc_html_e($image_src) ?>" style="background-color: <?php esc_html_e($bg_color) ?>; color: <?php esc_html_e($color) ?>;">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>	
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <img onclick="fbs_fab_add_sub_button('text', '#77B3D4');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/text.png" class="fbs-add-sub-btn-link" title="Text">
                            <img onclick="fbs_fab_add_sub_button('whatsapp', '#28D044');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/whatsapp.png" class="fbs-add-sub-btn-link" title="WhatsApp">
                            <img onclick="fbs_fab_add_sub_button('messenger', '#0084FF');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/messenger.png" class="fbs-add-sub-btn-link" title="Facebook Messenger">
                            <img onclick="fbs_fab_add_sub_button('phone', '#DD4B3A');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/phone.png" class="fbs-add-sub-btn-link" title="Phone">
                            <img onclick="fbs_fab_add_sub_button('email', '#1D6DF1');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/email.png" class="fbs-add-sub-btn-link" title="Email">
                            <img onclick="fbs_fab_add_sub_button('viber', '#7D3DAF');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/viber.png" class="fbs-add-sub-btn-link" title="Viber">
                            <img onclick="fbs_fab_add_sub_button('snapchat', '#FFFC00');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/snapchat.png" class="fbs-add-sub-btn-link" title="Snapchat">
                            <img onclick="fbs_fab_add_sub_button('line', '#0CC200');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/line.png" class="fbs-add-sub-btn-link" title="Line">
                            <img onclick="fbs_fab_add_sub_button('intercom', '#208CEB');" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/intercom.png" class="fbs-add-sub-btn-link" title="Intercom">
                        </td>
                    </tr>
                </tfoot>
            </table>
		</section>
		-->
		
<!-- Array of BUTTONS -->

		<section>
		<table class="widefat fbs-table">
                <thead>
                    <tr>
                        <th colspan="8">
                            <h1><?php _e('Buttons', 'floating-buttons'); ?></h1>
                        </th>
                    </tr>
                    <tr>
                        <th><?php _e('Active', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Position', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Type', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Text', 'floating-buttons'); ?> <span class="required">*</span></th>
                        <th><?php _e('Link', 'floating-buttons'); ?> </th>
                        <th><?php _e('Pages Visible', 'floating-buttons'); ?> </th>
                        <th><?php _e('Colors', 'floating-buttons'); ?> </th>
                        <th><?php _e('Icon', 'floating-buttons'); ?> </th>
                    </tr>
                </thead>
                <tbody id="fbs-btns-tbody">
				<!--
				<tr>
					<td>
					<span class="dashicons dashicons-no fbs-sub-btn-rm"></span>
						<select class="fbs-activate fbs-form-element-lower">
							<option value="0" <?php if($activate == '0'){ echo 'selected'; } ?> ><?php _e('No', 'floating-buttons'); ?></option>
							<option value="1" <?php if($activate == '1'){ echo 'selected'; } ?> ><?php _e('Yes', 'floating-buttons'); ?></option>
						</select>
					</td>
					<td>
						<select class="fbs-position fbs-form-element-lower">
							<option value="1" <?php if($position == '1'){ echo 'selected'; } ?> ><?php _e('Top Left', 'floating-buttons'); ?></option>
							<option value="2" <?php if($position == '2'){ echo 'selected'; } ?> ><?php _e('Top Right', 'floating-buttons'); ?></option>
							<option value="3" <?php if($position == '3'){ echo 'selected'; } ?> ><?php _e('Bottom Right', 'floating-buttons'); ?></option>
							<option value="4" <?php if($position == '4'){ echo 'selected'; } ?> ><?php _e('Bottom Left', 'floating-buttons'); ?></option>
						</select>
					</td>
					<td>
						<select class="fbs-type fbs-form-element-lower">
							<option value="0" <?php if($type == '0'){ echo 'selected'; } ?> ><?php _e('Simple Click Icon', 'floating-buttons'); ?></option>
							<option value="4" <?php if($type == '4'){ echo 'selected'; } ?> ><?php _e('Simple Click Text', 'floating-buttons'); ?></option>
							<option value="1" <?php if($type == '1'){ echo 'selected'; } ?> ><?php _e('Display on Click', 'floating-buttons'); ?></option>
							<option value="2" <?php if($type == '2'){ echo 'selected'; } ?> ><?php _e('Display on Hover', 'floating-buttons'); ?></option>
						</select>
					</td>
					<td>
						<input class="fbs-main-btn-text" value="<?php esc_html_e($main_text) ?>">
					</td>
					<td>
						<input class="fbs-main-btn-link" value="<?php esc_html_e($main_link) ?>">
					</td>
					<td>
					<?php
					$pages = get_pages();

					// Initialize an empty array to store the page names and IDs
					$page_options = array();

					foreach ($pages as $page) {
						// Add each page name and ID to the array
						$page_options["page-id-".$page->ID] = $page->post_title;
					}

					// Generate the select box
					$args = array(
						'name'             => 'page_select[slug]', // Name attribute for the select box (note the [])

						'option_none_value' => '', // Value for the default option
						'selected'          => array(285,514), // Default selected page IDs (optional)
						'echo'              => 1, // Whether to echo the select box (1 for yes, 0 for no)
						'id'                => 'page-select', // ID attribute for the select box
						'class'             => 'fbs-page-select', // CSS class for styling (optional)
						'exclude'           => '', // IDs of pages to exclude (optional)
						'depth'             => 0, // Depth of hierarchy (0 for flat list)
						'child_of'          => 0, // Parent page ID (optional)
						'tab_index'         => 0, // Tab index (optional)
						'post_type'         => 'page', // Post type (pages)
						'post_status'       => 'publish', // Post status (published pages)
						'multiple'          => true, // Enable multi-select
					);

					// Output the select box
					wp_dropdown_pages($args);



					?>

						<input class="fbs-page-slug" value="<?php esc_html_e($page_slug) ?>">
						
					</td>
					<td>
						<input class="fbs-main-btn-color" value="<?php esc_html_e($main_color) ?>">
						<input class="fbs-main-btn-bg-color" value="<?php esc_html_e($main_bg_color) ?>">
					</td>
					<td>
					
						<button id="fbs-main-btn-icon button button-small button-secondary" data-id="<?php esc_html_e($main_img_id) ?>">
							<?php _e('Select Icon', 'floating-buttons'); ?> 
						</button>
						<small class="fbs-small"><?php _e('Size 128x128 px', 'floating-buttons'); ?></small>
						<br>
						<img src="<?php esc_html_e($main_img_src) ?>" class="fbs-main-btn-preview-img" style="background-color: <?php esc_html_e($main_bg_color) ?>; color: <?php esc_html_e($main_color) ?>;">
					</td>
				</tr>
						-->	
                    <?php 
					print_r($fbs_btns);
					if(is_array($fbs_btns) && count($fbs_btns) > 0):
					
                        foreach($fbs_btns as $fbs_btn):
                            $fbs_btn = fbs_parse_content($fbs_btn);
							//a:1:{i:0;s:98:"0|4|4|Mentor Guide Survey!|https://www.surveymonkey.ca/r/PS7FQ67|undefined|#FFFFFF|#1E73BE|285,514";}
							print_r($fbs_btn);
                            list($active, $position, $type, $text, $link, $img_id, $color, $bg_color, $visibility) = explode('|', $fbs_btn); 
							
					?>
							
                            <tr data-type="<?php esc_html_e($type) ?>">
                                <td>
                                    <div style="font-weight: bold; text-transform: uppercase;">
                                    	<?php esc_html_e($type) ?>
                                	</div>
                                    <input class="fbs-sub-btn-titles" value="<?php esc_html_e($title) ?>">
                                </td>
                                <td>
                                    <textarea class="fbs-sub-btn-contents"><?php esc_html_e($content) ?></textarea>
                                </td>
                                <td>
                                    <button data-id="<?php esc_html_e($img_id) ?>" class="button button-small button-secondary fbs-sub-btn-icons">
                                        <?php _e('Select Icon', 'floating-buttons'); ?>
                                    </button>
                                    <small class="fbs-small"><?php _e('Size 128x128 px', 'floating-buttons'); ?></small>
                                </td>
                                <td>
                                    <input class="fbs-sub-btn-colors" value="<?php esc_html_e($color) ?>">
                                </td>
                                <td>
                                    <input class="fbs-sub-btn-bg-colors" value="<?php esc_html_e($bg_color) ?>">
                                </td>
                                <td>
                                    <span class="dashicons dashicons-move fbs-sub-btn-sort"></span>
                                </td>
                                <td>
                                    <span class="dashicons dashicons-no fbs-sub-btn-rm"></span>
                                </td>
                                <td>
                                    <?php 
									
                                        $image_attachment = wp_get_attachment_image_src($img_id, 128);
                                        if(isset($image_attachment[0])){
                                            $image_src = $image_attachment[0];
                                        }else{
                                            $image_src = FBS_DEFAULT_IMG;
                                        }
										
                                    ?>
                                    <img class="fbs-sub-btn-preview-img" src="<?php esc_html_e($image_src) ?>" style="background-color: <?php esc_html_e($bg_color) ?>; color: <?php esc_html_e($color) ?>;">
                                </td>
                            </tr>
                    <?php 
						
						endforeach;
                    endif; 
					
					?>	
                </tbody>
                
            </table>
		</section>
		<!--
		<table>
                <tfoot>
                    <tr>
					    <td colspan="2">
                            <button id="new-btn" class="button button-large button-primary">
                                <?php _e('New Button', 'floating-buttons'); ?>
                            </button>
                        </td>
                        <td colspan="6">
                            <button id="save-changes-btn" class="button button-large button-primary">
                                <?php _e('Save Changes', 'floating-buttons'); ?>
                            </button>
                        </td>
                    </tr>  
                </tfoot>
            </table>
            <table class="widefat" style="margin-top: 40px;">
                <thead>
                    <tr>
                        <td colspan="2">
                            <h1><?php _e('Content', 'floating-buttons'); ?></h1>
                            
                        </td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Button Type', 'floating-buttons'); ?></b></td><td><b<?php _e('Content Description', 'floating-buttons'); ?>></b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b><?php _e('Text', 'floating-buttons'); ?></b></td><td><?php _e('Any type of simple text and shortcode.', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('WhatsApp', 'floating-buttons'); ?></b></td><td><?php _e('Any WhatsApp number like that 919806886806 (with country code but without any plus, preceding zero, hyphen, brackets, space)', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Facebook Messenger', 'floating-buttons'); ?></b></td><td><?php _e('Valid Facebook Page Slug', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Phone', 'floating-buttons'); ?></b></td><td><?php _e('Mobile number in this format +91-999-999-9999', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Email', 'floating-buttons'); ?></b></td><td><?php _e('Valid email address like xxxxx@yyyyy.com', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Viber', 'floating-buttons'); ?></b></td><td><?php _e('Viber Username', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Snapchat', 'floating-buttons'); ?></b></td><td><?php _e('Snapchat Username', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Line', 'floating-buttons'); ?></b></td><td><?php _e('Valid Line URL like http://line.me/ti/p/xxxxxx', 'floating-buttons'); ?></td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Intercom', 'floating-buttons'); ?></b></td><td><?php _e('App ID', 'floating-buttons'); ?></td>
                    </tr>
                </tbody>
               
            </table>
			-->
        </div>
    </div>
</div>
<?php echo wp_nonce_field('fbs_settings_save'); ?>

<script type="text/javascript">

<!-- requires php for the admin url -->

function savevars(refer, nonce, buttons, sub_buttons, status) {
	if(status == true){
		jQuery("#save-changes-btn").html('Saving...');
		jQuery.ajax({
	        type: "POST",
	        url: "<?php echo get_admin_url(); ?>admin-ajax.php",
	        data: {
	            "action": "fbs_settings_save",
                "_wpnonce": nonce,
                "_wp_http_referer": refer,
				
				"sub_buttons": sub_buttons,
				"buttons": buttons

	        },
	        success: function(res){
				jQuery("#save-changes-btn").html('Save Changes');
	        }
	    });	
	}
}


</script>