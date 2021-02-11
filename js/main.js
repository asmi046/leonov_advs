jQuery(document).ready(function($) {
	
	$(".meuBtn i").click(function(){ 
				$(".logoMenu").toggle();
				
	});
	

 $('input,textarea').focus(function(){
   $(this).data('placeholder',$(this).attr('placeholder'))
   $(this).attr('placeholder','');
 });
 $('input,textarea').blur(function(){
   $(this).attr('placeholder',$(this).data('placeholder'));
 });
 
	jQuery('.UpBtn').click(function(event) {
        
        var valInp = jQuery('.cart .quantity input').val();
		jQuery('.cart .quantity input').val(parseInt(valInp)+1);
    });
	
	jQuery('.DvnBtn').click(function(event) {
        
        var valInp = jQuery('.cart .quantity input').val();
		if (parseInt(valInp)-1 > 0)
			jQuery('.cart .quantity input').val(parseInt(valInp)-1);
    });

    $('#input-descr').keyup(function() {
    	var descr = $('#input-descr').val();
    	console.log(descr);
    	if(descr.length > 1) {
	    	var jqXHR = jQuery.post(
	    		allAjax.ajaxurl,
	    		{
	    			action: 'get_address',
	    			nonce: allAjax.nonce,
	    			descr: descr
	    		}
			);
			jqXHR.done(function(responce) {
				$(".descr-form-wrap__result").show().html(responce);
			});
    	}
    });

    $("body").on('click', '.descr-form-wrap__result-item', function() {
    	var address = $(this).data('address');
    	$('#input-descr').val(address);
    	$(".descr-form-wrap__result").hide().html();
    	$(".filterBlk form").submit();
    });

    $(document).mouseup(function (e) {
	    var container = $(".descr-form-wrap__result");
	    if (container.has(e.target).length === 0){
	        container.hide();
	    }
	});

	if($('.tableBlk tbody tr').length <= 7) {
		$('.tableBlk thead').css({'position': 'static'});
		$('.tableBlk table thead tr').css('float', 'unset');
		$(".tableBlk table thead th").css('float', 'unset');
		$(".tableBlk table tbody").css('float', 'unset');
		$('.tableBlk table tbody tr').css('float', 'unset');
		$(".tableBlk table td").css('float', 'unset');
	}

	// $(".slider-partners").slick({
	//     slidesToShow: 4,
	//     arrows: true,
	//     prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
	//     nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
	//     autoplay: true,
	//     responsive: [
	// 	    {
	// 	      breakpoint: 874,
	// 	      settings: {
	// 	        slidesToShow: 2,
	// 	      }
	// 	    },
	//     {
	//       breakpoint: 600,
	//       settings: {
	//         slidesToShow: 1,
	//       }
	//     }
	//   ]
	// });

	var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;
	$(window).resize(function() {
	    colWidth = $bodyCells.map(function() {
	        return $(this).width();
	    }).get();
	    
	    $table.find('thead tr').children().each(function(i, v) {
	        $(v).width(colWidth[i]);
	    });    
	}).resize();
});
