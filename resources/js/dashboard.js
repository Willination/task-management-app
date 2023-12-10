// resources/js/dashboard.js

import $ from 'jquery';

$(document).ready(function () {
    $('#searchInput').on('input', function () {
        let searchTerm = $(this).val();

        // Make an AJAX request to the server
        $.ajax({
            url: '/tasks/dynamic-search',
            method: 'GET',
            data: { search: searchTerm },
            success: function (response) {
                // Handle the response, update the UI, etc.
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});
