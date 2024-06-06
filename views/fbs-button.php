<?php 

	$classes = get_body_class();

	$fbs_btns = get_option('fbs_buttons', json_encode(array()));
	$classes = get_body_class();
	$fbs_sub_btns = get_option('fbs_sub_btns', json_encode(array()));


	if(is_array($fbs_sub_btns) && count($fbs_sub_btns) > 0):
		foreach($fbs_sub_btns as $fbs_sub_btn):
			$fbs_btn = fbs_parse_content($fbs_sub_btn);
			list($sub_parent, $sub_type, $sub_title, $sub_link, $sub_img, $sub_color, $sub_bg_color) = explode('|', $fbs_sub_btn);
			$subbutton[$sub_parent][] = array($sub_type, $sub_title, $sub_link, $sub_img, $sub_color, $sub_bg_color);
		endforeach;
	endif;
	
	/*
	echo "<div class='debugsubbuttons' style='display:none;'>";
	print_r($subbutton);
	echo "</div>";
	*/
	
	if(is_array($fbs_btns) && count($fbs_btns) > 0):
		$number = 0;
		
		foreach($fbs_btns as $fbs_btn):
		
			$number++;
			$show = false;
			$active = 0;
			
			$fbs_btn = fbs_parse_content($fbs_btn);
			list($active, $position, $type, $text, $link, $img_src, $color, $bg_color, $visibility) = explode('|', $fbs_btn);
		
			$linkurl = $link;
			$title = $text;
			$page_slug = explode(",", $visibility);
			foreach ($page_slug as $slug) {
				$page_class = "page-id-".$slug;
				

				if (in_array($page_class,$classes)) {
					$show = true;
					break;
				} else {
					$show = false;
				}

			}

			if ($show == true && $active == 1) {
				
				if($position == '1'): $pos = "one";
				elseif($position == '2'): $pos = "two";
				elseif($position == '3'): $pos = "three";
				elseif($position == '4'): $pos = "four";
				endif;
				/*
				<option value="0">Simple Click Icon</option>
				<option value="4">Simple Click Text</option>
				<option value="1">Display on Click</option>
				<option value="2">Display on Hover</option>
				*/
				$linktype = "";
				$link = "";
				$target = "";
				$addclass = "";
				switch ($type) {
					case '1': //display on link text
					$link = 'javascript: void(0);';
					$addclass = "fbs-clickshow";
					break;
					
					case '2':
					$link = 'javascript: void(0);';
					break;
					
					case '3': //display on link icon
					$link = 'javascript: void(0);';
					$text = '<img src="'.esc_html($img_src).'">';
					$addclass = "fbs-clickshow";
					break;
					
					case '0':
					$link = $linkurl;
					$text = '<img src="'.esc_html($img_src).'">';
					$target = 'target="_blank"';
					break;
					
					case '4':
					$linktype = " textlink";
					$target = 'target="_blank"';
					$link = $linkurl;
					break;
				}
				
/* DEBUG
echo "<div class='debugbutton' style='display:none;'>";
echo "<br>Button Number: " . $number;
echo "<br>Show: " . $show;
echo "<br>Type: " . $type;
echo "<br>Text: " . $text;
echo "<br>Link URL: " . $link;
echo "<br>Image: " . $img_src;
echo "<br>Color: " . $color;
echo "<br>BG Color: " . $bg_color;
echo "<br>Active: " . $active;
echo "<br>Position: " . $position;
echo "<br>Visibility: " . $visibility;
echo "<br>Classes: ";
print_r($classes);
echo "</div>";
*/
				?>
				<nav class="fbs-container <?php echo $pos; echo $linktype; echo " type-".$type; ?>"> 
				<?php if($position == '1' || $position == '2'): ?>
					<a href="<?php esc_html_e($link); ?>" class="fbs-buttons <?php echo $addclass; ?> fbs-primary" data-id="<?php echo $number; ?>" style="display: none; background-color: <?php esc_html_e($bg_color) ?> !important; color: <?php esc_html_e($color) ?> !important;">
						<?php echo $text; ?>
					</a>
				<?php endif; ?>    

				<?php if($position == '3' || $position == '4'): ?>
					<a href="<?php esc_html_e($link); ?>" class="fbs-buttons <?php echo $addclass; ?> fbs-primary" data-id="<?php echo $number; ?>" style="display: none; background-color: <?php esc_html_e($bg_color) ?> !important; color: <?php esc_html_e($color) ?> !important;">
						<?php echo $text; ?>
					</a>
					<a href="#" class="fbs_close">x</a>
				<?php endif; ?>
				
				</nav>

					<?php
				}

			 

// SUB BUTTONS ONLY

				if(is_array($subbutton[$number]) && count($subbutton[$number]) > 0):
					foreach($subbutton[$number] as $fbs_sub_btn): 

						list($type, $sub_title, $link, $image, $color, $bg_color) = $fbs_sub_btn; 
						$content = fbs_parse_content($link);
						$content = esc_html($link);

						$image_attachment = wp_get_attachment_image_src($img_id, 128);
						if(isset($image_attachment[0])){
							$image_src = $image_attachment[0];
						}else{
							$image_src = FBS_DEFAULT_IMG;
						}
						
/* DEBUG
echo "<div class='debugsubbutton' style='display:none;'>";
echo "<br>Type: " . $type;
echo "<br>Title: " . $sub_title;
echo "<br>Link URL: " . $link;
echo "<br>Image: " . $imgage;
echo "<br>Color: " . $color;
echo "<br>BG Color: " . $bg_color;
echo "</div>";
*/
				
					?>
					<?php if($type == 'intercom'): ?>
						<script type="text/javascript">(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/<?php esc_html_e($content, 'floating-buttons'); ?>';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
						<script type="text/javascript">
						window.intercomSettings = {
							app_id: "<?php esc_html_e($content, 'floating-buttons'); ?>",
							hide_default_launcher: true,
							custom_launcher_selector: "#fbs-btn-<?php echo $i; ?>",
						};
						Intercom('onHide', function(){
							jQuery(".fbs-container").fadeIn(500);
						});
						</script>
					<?php else: ?>    
						<div data-id="<?php echo $number; ?>" class="<?php echo $pos; ?> fbs-box"> 
							<div class="fbs-box-head" style="background-color: <?php esc_html_e($bg_color) ?>; color: <?php esc_html_e($color) ?>; position: relative;">
								<div style="display: inline-block; width: 30px;">
									<span style="position: absolute; display: block; background-image: url('<?php esc_html_e($image_src) ?>'); width: 27px; height: 27px; background-size: cover; background-repeat: no-repeat; background-position: center; margin-top: -20px;"></span>
								</div>
								<?php esc_html_e($title, 'floating-buttons'); ?>
								<span data-id="<?php echo $number; ?>" class="fbs-box-hide">x</span>
							</div>
							<div class="fbs-body" style="padding: 20px; font-family: courier;">
								<?php if($type == 'whatsapp'): ?>
									<?php
										$number = $content;
										$invalid_array = array(' ', '+', '-', '(', ')', '{', '}', '[', ']');
										$number = str_replace($invalid_array, '', $number);
										$whatsapp_url = 'https://wa.me/'.$number.'?text=Hi';
									?>
									<div style="display: block; margin-bottom: 32px; text-align: center; font-size: 16px; font-weight: bold;">
										<p>
											<?php esc_html_e('WhatsApp Number', 'floating-buttons'); ?>
										</p>
										<p>
											<?php esc_html_e($content, 'floating-buttons'); ?>
										</p>
									</div>
									<div style="color: <?php esc_html_e($bg_color) ?>; text-align: center; font-size: 18px;">
										<a href="<?php esc_html_e($whatsapp_url) ?>" target="_blank" style="padding: 10px 15px; border-radius: 3px; background-color: <?php esc_html_e($bg_color) ?>; color: <?php esc_html_e($color) ?>; text-decoration: none;">
											<?php esc_html_e('Message', 'floating-buttons'); ?>
										</a>
									</div>
								<?php elseif($type == 'messenger'): ?>
									<iframe style="border: none; border-radius: 0 0 16px 16px; overflow: hidden;" scrolling="no" allowtransparency="true" src="https://www.facebook.com/plugins/page.php?href=http://facebook.com/<?php esc_html_e($content, 'floating-buttons'); ?>/&tabs=messages&small_header=true&width=300&height=320&adapt_container_width=true&hide_cover=true&show_facepile=false&appId=" width="300" height="320" frameborder="0"></iframe>
								<?php elseif($type == 'phone'): ?>
									<a href="tel:<?php echo str_replace(' ', '-', $content); ?>" style="display: block; text-align: center; margin-top: 10px; font-size: 24px; color: <?php esc_html_e($bg_color) ?>;">
										<?php esc_html_e($content, 'floating-buttons'); ?>
									</a>
								<?php elseif($type == 'email'): ?>
									<a href="mailto:<?php esc_html_e($content, 'floating-buttons'); ?>" class="fbs-buttons" style="display: block; text-align: center; margin-top: 10px; font-size: 24px; color: <?php esc_html_e($bg_color) ?>;">
										<img src="<?php esc_html_e($image, 'floating-buttons'); ?>">
									</a>
								<?php elseif($type == 'viber'): ?>
									<a href="http://chats.viber.com/<?php esc_html_e($content, 'floating-buttons'); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=800'); return false;" style="display: block; text-align: center; margin-top: 10px; font-size: 24px; color: <?php esc_html_e($bg_color) ?>;">
										<?php esc_html_e($content, 'floating-buttons'); ?>
									</a>
								<?php elseif($type == 'snapchat'): ?>
									<div style="width: 300px; text-align: center;">
										<object data="https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username=<?php esc_html_e($content, 'floating-buttons'); ?>&type=PNG" type="image/png" width="200px" height="200px"></object>
										<div style="display: block; text-align: center; margin-top: 10px; font-size: 24px; color: <?php esc_html_e($bg_color) ?>;">
											<?php esc_html_e($content, 'floating-buttons'); ?>
										</div>
									</div>
								<?php elseif($type == 'line'): ?>
									<iframe style="height: 490px; margin-top: -115px;" scrolling="no" allowtransparency="true" src="<?php esc_html_e($content, 'floating-buttons'); ?>" frameborder="0"></iframe>
								<?php else: ?>
									<div class="post-content">
										<?php echo do_shortcode($content); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>   
				<?php endforeach; ?>
			<?php endif;

		endforeach; //foreach button
	endif; //if there are buttons


