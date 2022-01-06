const $ = jQuery;

$(document).ready(() => {
    let $button, $placeholder, type, url;
    $('.process-button').on('click', (e) => {
        e.preventDefault();
        $button = $(e.currentTarget);
        $button.parent().find('.wpg-spinner').show();
        $placeholder = $('#wpb-response-placeholder');
        $placeholder.html("<img src='/wp-admin/images/spinner-2x.gif' />");
        type = $button.data('type');
        url = wpApiSettings.root + 'wpg_wprocket_debug/v1/process/' + type;

        $.ajax({
            url: url,
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
            }
        }).done(function (response) {
            $button.parent().find('.wpg-spinner').hide();
            $placeholder.html(response.html);
            console.log(type + "_cached");
            $('#' + type + "_cached").html(response.cached);
            $('#' + type + "_not_cached").html(response.not_cached);
            $('#' + type + "_total").html(response.total);
        });
    })
})
