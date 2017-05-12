/**
 * Created by mosaddek on 3/9/15.
 */

// Select2

function format(state) {
	
    if (!state.id) return state.text; // optgroup
    return "<img class='flag' src='img/flags/" + state.id.toLowerCase() + ".png'/>" + state.text;
}
        if (jQuery.fn.select2) {
			
var placeholder = "Select One";
jQuery('.select2-multiple').select2({
    placeholder: placeholder
});
jQuery("#e4").select2({
    formatResult: format,
    formatSelection: format,
    escapeMarkup: function(m) {
        return m;
    }
});
jQuery('.select2-allow-clear').select2({
    allowClear: true,
    placeholder: placeholder
});
jQuery('button[data-select2-open]').click(function() {
    jQuery('#' + jQuery(this).data('select2-open')).select2('open');
});
var select2OpenEventName = "select2-open";
jQuery(':checkbox').on("click", function() {
    jQuery(this).parent().nextAll('select').select2("enable", this.checked);
});
		}

