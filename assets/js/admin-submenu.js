(function ($) {
    // Tab for information
    $('.wrap .tabs .mycontainer .myrow .box-menu a').on('click', function () {
        // Get id
        const getId = '.' + $(this).attr('myid');

        // Remove all class active link
        $('.wrap .tabs .mycontainer .myrow .box-menu a').removeClass('active');

        // Active class link
        $(this).addClass('active');

        // Hide all data content
        $('.wrap .data-content').addClass('hide').removeClass('active');

        // Show data content active current
        $(getId + '.data-content').removeClass('hide').addClass('active');
    });
}(jQuery));

//# sourceMappingURL=admin-submenu.js.map
