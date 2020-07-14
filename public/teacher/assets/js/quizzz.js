$('body').on('click', '.delete_confirmation', function (e) {
    e.preventDefault();
    $(document).find('#delete_action').attr('action', $(this).attr('data-action'));
});

/**
 * Show preload
 * 
 * @param1 node
 * @param2 int type [1=>border, 2=>grow]
 * @return void
 */
function preload(node, type) {
    if (type == 1) {
        node.append(
            '<div class="d-flex justify-content-center">' +
            '<div class="spinner-border" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>'
        )
    } else {
        node.append(
            '<div class="d-flex justify-content-center">' +
            '<div class="spinner-grow text-primary" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>'
        )
    }
}

/**
 * Get data using Ajax
 * 
 * @return Promise
 */
const postPromise = (url, data) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: resolve,
            error: reject,
        })
    });
}