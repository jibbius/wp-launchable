jQuery(document).ready(function () {

    jQuery(".Launchable-quickfix").click(function (event) {
        event.preventDefault();
        quickFix = jQuery(this)
        nonce = quickFix.attr("data-nonce")
        action = quickFix.attr("data-action")
        ajaxurl = launchableArgs.ajaxurl


        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: ajaxurl,
            data: {action: action, nonce: nonce},
            success: function (response) {
                if (response.type == "success") {
                    quickFix.parents(".Launchable-message").slideUp();
                }
                else {
                    alert("failed")
                }
            }
        })

    })
})