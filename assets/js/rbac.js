/**
 * 
 * Rbac js
 * @author Rashi https://twitter.com/rashivkp
 * @package		Itchool_rbac
 */

/**
 * adding selected taskgroup
 */
$("#add_group").click(function() {
    $("#taskgroups :selected").each(function(i, selected) {
    var v = $(selected).val();
            var t = $(selected).text();
            $("#selected_taskgroups").append("<option value=" + v + ">" + t + "</option>");
            $("#selected_taskgroups_hidden").append("<input name='selected_tasgroups_h[]' type='hidden' id='selected_tasgroups_h_"+v+"' value=" + v + ">");
            $(selected).remove();
    });
});
/**
 * adding roles to selected taskgroup
 */
$("#add_role").click(function() {
    if ($("#selected_taskgroups :selected").length === 1) {
        $("#roles :selected").each(function(i, selected) {
        var group_value = $("#selected_taskgroups :selected").val();
                var group_text = $("#selected_taskgroups :selected").text();
                var v = $(selected).val();
                var t = $(selected).text();
                if ($("#role_" + group_value + "").length === 1) {
        if ($("#role_" + group_value + " option[value=" + v + "]").length === 1) {
        alert('its already assigned..');
        }
        else {
        $("#role_" + group_value + "").append("<option value=" + v + ">" + t + "</option>");
            $("#hidden_roles_" + group_value + "").append("<input id='srole_h_"+v+"' type='hidden' value=" + v + " name='srole_" + group_value + "[]'>");
        }
    }
    else {
    $("#roles_assigned").append("\
        <div id='roles_remove_wraper_" + group_value + "'>\
            <label class='control-label'><strong>" + group_text + "</strong></label>\
            <select class='input-xlarge' multiple='multiple' name='role_" + group_value + "[]' id='role_" + group_value + "'>\n\
                            <option value=" + v + ">" + t + "</option>\
             </select>\
             <div style='display:none;' id='hidden_roles_"+group_value+"'>\n\
                <input id='srole_h_"+v+"' type='hidden' value=" + v + " name='srole_" + group_value + "[]'>\
            </div>\
            <div class='controls'>\
                <input type='button' id='roles_remove_" + group_value + "' class='remove_role btn btn-warning' value='Remove role'>\n\
            </div>");            
    }

});
        }
else {
alert('please select only one taskgroup for assigning role');
        }
});
/**
 * removing selected taskgroup
 */
$("#remove_group").click(function() {
    $("#selected_taskgroups :selected").each(function(i, selected) {
        var v = $(selected).val();
        var t = $(selected).text();
        //if ($("#taskgroups option[value=" + v + "]").length === 1)
        $("#taskgroups").append("<option value=" + v + ">" + t + "</option>");
        $("#role_" + v + "").remove();
        $("#roles_remove_wraper_" + v + "").remove();
        $("#selected_tasgroups_h_" + v + "").remove();
        $(selected).remove();
    });
});

/**
 * remove role from selected taskgroup
 */
$(".remove_role").click(function() {
    var group_value = $(this).attr('id');
    group_value = group_value.replace(/\D/g, ''); // a string of only digits, or the empty string
    $("#role_" + group_value + " :selected").each(function(i, selected) {
        $("#srole_h_"+$(selected).val()).remove();
        $(selected).remove();
    });

});