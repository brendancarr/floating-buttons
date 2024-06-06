jQuery(document).ready(function(){

	jQuery("#fbs-sub-btns-tbody").sortable();

	jQuery(document).on("click", "#fbs-main-btn-icon", function(){
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: "Choose Icon Image",
            button: {
                text: "Select",
            },
            multiple: false,
        });
        file_frame.on("select", function(){
            attachment = file_frame.state().get("selection").first().toJSON();
            jQuery("#fbs-main-btn-icon").data("id", attachment.id);
            jQuery("#fbs-main-btn-preview-img").attr("src", attachment.url);
        });
        file_frame.open();
    });

	jQuery("#fbs-main-btn-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery("#fbs-main-btn-preview-img").css("color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});
	
	jQuery(".fbs-main-btn-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).find(".fbs-main-btn-preview-img").css("color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});

	jQuery(".fbs-main-btn-bg-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).find(".fbs-main-btn-preview-img").css("background-color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});
	
	jQuery("#fbs-main-btn-bg-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery("#fbs-main-btn-preview-img").css("background-color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});

	jQuery(document).on("click", ".fbs-sub-btn-icons", function(){
        var obj = jQuery(this);
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: "Choose Icon Image",
            button: {
                text: "Select",
            },
            multiple: false,
        });
        file_frame.on("select", function(){
            attachment = file_frame.state().get("selection").first().toJSON();
            jQuery(obj).data("id", attachment.id);
            jQuery(obj).parents("tr").find(".fbs-sub-btn-preview-img").attr("src", attachment.url);
        });
        file_frame.open();
    });

	fbs_ini_for_sub_btn();
});

function fbs_ini_for_sub_btn(){
	jQuery(".fbs-sub-btn-colors").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).parents("tr").find(".fbs-sub-btn-preview-img").css("color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});
	jQuery(".fbs-sub-btn-bg-colors").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).parents("tr").find(".fbs-sub-btn-preview-img").css("background-color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});
}

jQuery(document).on("click", "#save-changes-btn", function(){
	jQuery(".fbs-error").html("");
	
    var _wpnonce = jQuery("input[name='_wpnonce']").val();
    var _wp_http_referer = jQuery("input[name='_wp_http_referer']").val();
	var status = true;
	/*
	var activate = jQuery("#fbs-activate").val().trim();
	var position = jQuery("#fbs-position").val().trim();
	var type = jQuery("#fbs-type").val().trim();
	var m_img_id = jQuery("#fbs-main-btn-icon").data("id");
	var m_color = jQuery("#fbs-main-btn-color").val().trim();
	var m_bg_color = jQuery("#fbs-main-btn-bg-color").val().trim();
	var m_link = jQuery("#fbs-main-btn-link").val().trim();
	var m_text = jQuery("#fbs-main-btn-text").val().trim();
	var m_page_slug = jQuery("#fbs-page-slug").val().trim();
	*/
	var buttons = new Array();
	jQuery("#fbs-btns-tbody").find("tr").each(function(){
		
		var _activate = jQuery(this).find(".fbs-activate").val().trim();
		var _position = jQuery(this).find(".fbs-position").val().trim();
		var _type = jQuery(this).find(".fbs-type").val().trim();
		var _m_img = jQuery(this).find(".fbs-main-btn-preview-img").attr("src");
		var _m_color = jQuery(this).find(".fbs-main-btn-color").val().trim();
		var _m_bg_color = jQuery(this).find(".fbs-main-btn-bg-color").val().trim();
		var _m_link = jQuery(this).find(".fbs-main-btn-link").val().trim();
		var _m_text = jQuery(this).find(".fbs-main-btn-text").val().trim();
		//var _m_page_slug = jQuery(this).find(".fbs-page-slug").val().trim();
		var _m_visibility = jQuery(this).find(".fbs-page-select").val();
		var buttons_row = _activate  + "|" + _position  + "|" + _type + "|" + _m_text + "|" + _m_link + "|" + _m_img + "|" + _m_color + "|" + _m_bg_color + "|" + _m_visibility;

		buttons.push(buttons_row);
	});	
	
    var sub_buttons = new Array();
	jQuery("#fbs-sub-btns-tbody").find("tr").each(function(){
		var _parent = jQuery(this).find(".buttonsforsub").val();
        var _type = jQuery(this).data("type");
		var _title = jQuery(this).find(".fbs-sub-btn-titles").val().trim();
		var _content = jQuery(this).find(".fbs-sub-btn-contents").val().trim();
        var _img= jQuery(this).find(".fbs-sub-btn-preview-img").attr("src");
        var _color = jQuery(this).find(".fbs-sub-btn-colors").val().trim();
        var _bg_color = jQuery(this).find(".fbs-sub-btn-bg-colors").val().trim();
		var row = _parent +"|"+ _type +"|"+ _title +"|"+ _content +"|"+ _img +"|"+ _color +"|"+ _bg_color;
		sub_buttons.push(row);
	});

savevars(_wp_http_referer, _wpnonce, buttons, sub_buttons, status);
	
});

function fbs_new_button(selectbox){

    var html = `
		<tr>
			<td>
			<span class="dashicons dashicons-no fbs-sub-btn-rm"></span>
				<select class="fbs-activate fbs-form-element-lower">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</td>
			<td>
				<select class="fbs-position fbs-form-element-lower">
					<option value="1">Top Left</option>
					<option value="2">Top Right</option>
					<option value="3">Bottom Right</option>
					<option value="4">Bottom Left</option>
				</select>
			</td>
			<td>
				<select class="fbs-type fbs-form-element-lower">
					<option value="0">Simple Click Icon</option>
					<option value="4">Simple Click Text</option>
					<option value="1">Display on Click Text</option>
					<option value="3">Display on Click Icon</option>
					<option value="2">Display on Hover</option>
				</select>
			</td>
			<td>
				<input class="fbs-main-btn-text">
			</td>
			<td>
				<input class="fbs-main-btn-link">
			</td>
			<td>
				`;
	html += selectbox;	
	html += `
			</td>
			<td>
				<input class="fbs-main-btn-color">
				<input class="fbs-main-btn-bg-color">
			</td>
			<td>
			
				<button id="fbs-main-btn-icon button button-small button-secondary" data-id="">
					Select Icon
				</button>
				<small class="fbs-small">Size 128x128 px</small>
				<br>
				<img src="" class="fbs-main-btn-preview-img" style="background-color: ; color: ;">
			</td>
		</tr>
		`;
	jQuery("#fbs-btns-tbody").append(html);
	colorify();
		
	jQuery(".fbs-page-select").select2();

}

function colorify() {
		
		jQuery(".fbs-main-btn-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).find(".fbs-main-btn-preview-img").css("color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});

	jQuery(".fbs-main-btn-bg-color").wpColorPicker({
	    defaultColor: false,
	    hide: true,
	    palettes: true,
	    change: function(event, ui){
	        jQuery(this).find(".fbs-main-btn-preview-img").css("background-color", ui.color.toString());
	    },
	    clear: function(){
	    },
	});
}
function fbs_add_sub_button(type, bg_color, img){
    var image_html = '<img class="fbs-sub-btn-preview" src="<?php echo FBS_PLUGIN_URL; ?>assets/img/'+ type +'.png">';
    var html = '';
    html += '<tr data-type="'+ type +'">';
    html += '   <td>';
	html += '       <span class="dashicons dashicons-no fbs-sub-btn-rm"></span>';
	html += '		<select class="fbs-type fbs-form-element-lower buttonsforsub">';
	html += jQuery(".hiddendropdown").html();
	html += '		</select>';
	html += '	</td>';
    html += '   <td>';
    html += '        <input class="fbs-sub-btn-titles" value="'+ type.toUpperCase() +'">';
    html += '   </td>';
    html += '   <td>';
    html += '        <textarea class="fbs-sub-btn-contents">https://</textarea>';
    html += '   </td>';
    html += '   <td>';
    html += '       <button data-id="0" class="button button-small button-secondary fbs-sub-btn-icons">';
    html += '           Select Icon';
    html += '       </button>';
    html += '       <small class="fbs-small">Size 128x128 px</small>';
    html += '   </td>';
    html += '   <td>';
    html += '       <input class="fbs-sub-btn-colors" value="#000000">';
    html += '   </td>';
    html += '   <td>';
    html += '       <input class="fbs-sub-btn-bg-colors" value="' + bg_color + '">';
    html += '   </td>';
    html += '   <td>';
    html += '       <span class="dashicons dashicons-move fbs-sub-btn-sort"></span>';
    html += '   </td>';
    html += '   <td>';
    html += '      <img class="fbs-sub-btn-preview-img" src="' + img + '" style="background-color: ' + bg_color + '; color: #FFFFFF;">';
    html += '   </td>';
    html += '</tr>';
	jQuery("#fbs-sub-btns-tbody").append(html);
	fbs_ini_for_sub_btn();
	colorify();
}

jQuery(document).on("click", ".fbs-sub-btn-rm", function(){
	jQuery(this).parent().parent().remove();
});



jQuery(document).ready(function() {
    jQuery(".fbs-page-select").select2();
	
});