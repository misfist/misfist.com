var plans={trial:9,free:0,plus:1,pro:2,vip:3,ultra:4};

// Show/hide entity options
function entityShowChange(el, entity_name)
{
    if (jQuery(el).is(':checked')) {
        jQuery("#entity_container_"+entity_name).show();
    } else {
        jQuery("#entity_container_"+entity_name).hide();
    }
}

// Show/hide options on Use settings from select
function userSettingsFromChange(el, entity_name)
{
    if (jQuery(el).val()) {
        jQuery("#use_settings_from_container_"+entity_name).hide();
    } else {
        jQuery("#use_settings_from_container_"+entity_name).show();
    }
}

// Toggle collapable area
function toggleCollapsable(el)
{
    jQuery(el).parent().children('.inside').toggle();
}

// Toggle upgrade website instructions
function toggleToUpgrade()
{
    jQuery("#likebtn_like_button_to_upgrade").toggle();
}

// Toggle Post format container
function postFormatAllChange(el, entity_name)
{
    if (jQuery(el).is(':checked')) {
        jQuery("#post_format_container_"+entity_name).hide();
    } else {
        jQuery("#post_format_container_"+entity_name).show();
    }
}

// Account data change
function accountChange()
{
    var account_data_filled = true;
    jQuery("input.likebtn_like_button_account").each(function(index, element) {
        if (!jQuery(element).val()) {
            account_data_filled = false;
        }
    });
    if (account_data_filled) {
        jQuery(":input[name='likebtn_like_button_sync_inerval']").removeAttr('disabled');
    } else {
        jQuery(":input[name='likebtn_like_button_sync_inerval']").val('').attr('disabled', 'disabled');
    }
}

// test synchronization
function testSync(loader_src)
{
    var q = jQuery;

    jQuery(".likebtn_like_button_test_sync_container:first").html('<img src="' + loader_src + '" />');

    jQuery.ajax({
        type: 'POST',
        dataType: "json",
        url: ajaxurl,
        data: {
            action: 'likebtn_like_button_test_sync',
            likebtn_like_button_account_email: jQuery(":input[name='likebtn_like_button_account_email']:first").val(),
            likebtn_like_button_account_api_key: jQuery(":input[name='likebtn_like_button_account_api_key']:first").val()
        },
        success: function(response) {
            var result_text = '';
            if (typeof(response.result_text) != "undefined") {
                result_text = response.result_text;
            }
            jQuery(".likebtn_like_button_test_sync_container:first").text(result_text);
            if (typeof(response.result) == "undefined" || response.result != "success") {
                jQuery(".likebtn_like_button_test_sync_container:first").css('color', 'red');
                if (typeof(response.message) != "undefined") {
                    var text = jQuery(".likebtn_like_button_test_sync_container:first").html() + ': ' + response.message;
                    jQuery(".likebtn_like_button_test_sync_container:first").html(text);
                }
            } else {
                jQuery(".likebtn_like_button_test_sync_container:first").css('color', 'green');
            }

        },
        error: function(response) {
            jQuery(".likebtn_like_button_test_sync_container:first").html('Error occured. Disable WP HTTP Compression plugin if you have it enabled.').css('color', 'red');
        }
    });
}

// enable/disable elements depending on the plan
function planChange(plan_id)
{
    // come through all plan dependent elements
    jQuery(".plan_dependent").each(function() {

        var classes;
        var class_name;
        var option_plan;
        var option_plan_id;
        var available = false;

        if (jQuery(this).attr('class')) {
            classes = jQuery(this).attr('class').split(/\s+/);

            for (var i = 0; i < classes.length; i++) {
                class_name  = classes[i];
                if (!class_name) {
                    continue;
                }
                option_plan = class_name.replace(/plan_/, '');

                if (!option_plan) {
                    continue;
                }
                if (typeof(plans[option_plan]) == "undefined") {
                    continue;
                }
                option_plan_id = plans[option_plan];

                if (plan_id >= option_plan_id) {
                    available = true;
                }
            }
        } else {
            available = true;
        }

        if (available) {
            jQuery(this).removeAttr('disabled');
        } else {
            jQuery(this).attr('disabled', 'disabled');
        }
    });
}

// reest settings
function resetSettings(entity_name, parameters)
{
    var input;
    var default_value;
    for (option_name in parameters) {
        input = jQuery('#use_settings_from_container_'+entity_name+' :input[name^="likebtn_like_button_'+option_name+'_'+entity_name+'"]');

        default_value = parameters[option_name];

        if (input.attr('type') == 'checkbox') {
            jQuery('#use_settings_from_container_'+entity_name+' :input[name^="likebtn_like_button_'+option_name+'_'+entity_name+'"]').removeAttr('checked');
            jQuery('#use_settings_from_container_'+entity_name+' :input[name^="likebtn_like_button_'+option_name+'_'+entity_name+'"][value="'+default_value+'"]').attr('checked', 'checked');
        } else if(input.attr('type') == 'radio') {
            jQuery('#use_settings_from_container_'+entity_name+' :input[name^="likebtn_like_button_'+option_name+'_'+entity_name+'"][value="'+default_value+'"]').attr('checked', 'checked');
        } else {
            input.val(default_value);
        }
        input.change();
    }
}

// submit statistics items
function statisticsSubmit(plan, messages)
{
    if (typeof(plan) != "undefined" && parseInt(plan) >= plans.vip) {

        if (jQuery("#statistics_container .item_checkbox:checked").size()) {
            if (confirm(messages.confirm)) {
                return true;
            } else {
                return false;
            }
        } else {
            alert(messages.items);
            return false;
        }
    } else {
        alert(messages.upgrade);
        return false;
    }
}

// select/unselect items
function statisticsItemsCheckbox(el)
{
    if (jQuery(el).is(':checked')) {
        jQuery("#statistics_container .item_checkbox").attr("checked", "checked");
    } else {
        jQuery("#statistics_container .item_checkbox").removeAttr("checked");
    }
}

// Edit statistics items
function statisticsEdit(entity_name, entity_id, type, plan, text_enter, text_upgrade, text_error)
{
    if (entity_name === '' || entity_id === '' || type === '') {
        return false;
    }

    if (typeof(plan) != "undefined" && parseInt(plan) >= plans.ultra) {
        var value = prompt(text_enter);
        if (value == null) {
            return false;
        }
    } else {
        alert(text_upgrade);
        return false;
    }

    if (type === 'like') {
        internal_type = 1;
    } else {
        internal_type = -1;
    }

    jQuery.ajax({
        url: ajaxurl,
        method: "POST",
        data: {
            action: 'likebtn_like_button_edit_item',
            entity_name: entity_name,
            entity_id: entity_id,
            type: internal_type,
            value: value
        },
        dataType: "json",
        success: function(data) {
            if (data) {
                if (data.result == "success") {
                    if (typeof(data.value) !== "undefined") {
                        jQuery("#item_"+entity_id+" .item_"+type+":first").text(data.value);
                    }
                } else {
                    if (typeof(data.message) !== "undefined") {
                        alert(data.message);
                    } else {
                        alert(text_error);
                    }
                }
            } else {
                alert(text_error);
            }
        },
        error: function(data) {
            alert(text_error);
        }
    });

    return true;
}