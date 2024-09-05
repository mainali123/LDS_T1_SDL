jQuery(document).ready(function ($) {

    $(document).ready(function () {


        $(document).on('change', '#filter', function () {
            let term = $(this).val()

            $.ajax({
                url: ajax_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'filter_custom_posts',
                    term: term
                },
                success: function (response) {
                    $('#blogs-container').html(response);
                },
                error: function (response) {
                    console.error(response);
                }
            });
        });

        let page = 2;
        $(document).on('click', '#load-more', function () {
            console.log('Load more button clicked');
            console.log(ajax_params.ajax_url);

            $.ajax({
                url: ajax_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_posts',
                    page: page
                },
                success: function (response) {
                    console.log('Response received');
                    $('#posts-container').append(response);
                    page++;
                },
                error: function (response) {
                    console.error(response);
                }
            });
        });
    });
});