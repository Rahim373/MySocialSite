//Show developers
$('.dev').click(function () {
    $('.developer').fadeIn(500, function () {
        $(this).css({"display": "block"})
    });
});


//Hide developers
$('.cross').click(function () {
    $('.developer').fadeOut(500, function () {
        $(this).css({"display": "none"})
    });
});


//Show/hide post button
$('.postarea').keyup(function () {
    var len = $(this).val().length;

    if (len > 0) {
        $('.postbtn').fadeIn(500, function () {
            $(this).css({"display": "block"})
        });
    }
    else {
        $('.postbtn').fadeOut(500, function () {
            $(this).css({"display": "none"})
        });
        console.log(len);
    }
});


jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).slideDown(400).siblings().slideUp(400);
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});

$('.changepass').click(function () {
    $(this).fadeOut(500, function () {
        $(this).css({"display": "none"})
    });
    $('.passtable').fadeIn(500, function () {
        $(this).css({"display": "block"})
    });
    
});

$('.changePhoto').click(function () {
    $(this).fadeOut(000, function () {
        $(this).css({"display": "none"})
    });
    $('.changephotodiv').fadeIn(000, function () {
        $(this).css({"display": "block"})
    });
    
});