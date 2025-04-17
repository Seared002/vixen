jQuery(document).ready(function ($) {
    $('.vixen-upload-button').click(function (e) {
        e.preventDefault();
        var button = $(this);
        var input = $('#' + button.data('input'));
        var imagePreview = $('#' + button.data('preview'));

        var custom_uploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        custom_uploader.on('select', function () {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            input.val(attachment.url);
            imagePreview.attr('src', attachment.url).show();
        });

        custom_uploader.open();
    });

    // Repeater
    $('#add-social-link').on('click', function () {
        $('#vixen-social-links').append(`
            <div class="vixen-social-row" style="margin-bottom:10px;">
                <input type="text" placeholder="Icon Class (fab fa-twitter)" class="vixen-icon-input" />
                <input type="text" placeholder="URL" class="vixen-url-input" />
                <button type="button" class="button remove-social">Remove</button>
            </div>
        `);
    });

    $(document).on('click', '.remove-social', function () {
        $(this).parent().remove();
    });

    $('form').on('submit', function () {
        let links = [];
        $('.vixen-social-row').each(function () {
            links.push({
                icon: $(this).find('.vixen-icon-input').val(),
                url: $(this).find('.vixen-url-input').val()
            });
        });
        $('#footer_social_links_serialized').val(JSON.stringify(links));
    });
});
