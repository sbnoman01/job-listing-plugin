(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	// Get the Selected Cat
	function getSelectedCat(){
		let cat_name = [];
		$('.single__cate input:checked').each(function(){
			cat_name.push($(this).val());
		});
		return cat_name;
	}

	// Get the Selected Type
    function getSelectedType(){
        let single__type = [];
        $('.single__type input:checked').each(function(){
            single__type.push($(this).val());
        });
        return single__type;
    }

	// Get the Selected Location
    function getSelectedLoc(){
        let single__loc = [];
        $('.single__loc input:checked').each(function(){
            single__loc.push($(this).val());
        });
        return single__loc;
    }

	// Get the Selected Specific
	function getSelectedSpec(){
		let single__spec = [];
		$('.single__spec input:checked').each(function(){
			single__spec.push($(this).val());
		});
		return single__spec;
	}

	// Get the Selected Seas
	function getSelectedSeas(){
		let single__seas = [];
		$('.single__seas input:checked').each(function(){
			single__seas.push($(this).val());
		});
		return single__seas;
	}

	 // input field search string
	 function getSearchString(){
        return $('.post_search_input').val();
    }


	$('.filter_class').on('change', function(){

        $.ajax({
            type: 'post',
            url: ajax_data.admin_url,
            data: {
                action: "job_filter_callback",
                security : ajax_data.nonce,
				cat	  : getSelectedCat,
				type  : getSelectedType,
				location: getSelectedLoc,
				specific: getSelectedSpec,
				season  : getSelectedSeas,
				search 	: getSearchString
            },
            // beforeSend: function() {
            //     $('.filter-loader').show();
            // },
            success: function (res) {
			console.log(res);
			
              if(res.found_post > 0){
				$('.results_area').html(res.content);
			  }else{
				$('.results_area').html('No jobs found!');
			  }
            }
        });
    });

	$('.post_search_input').on('keyup', function(event){
		$.ajax({
            type: 'post',
            url: ajax_data.admin_url,
            data: {
                action: "job_filter_callback",
                security : ajax_data.nonce,
				cat	  : getSelectedCat,
				type  : getSelectedType,
				location: getSelectedLoc,
				specific: getSelectedSpec,
				season  : getSelectedSeas,
				search 	: getSearchString
            },
            // beforeSend: function() {
            //     $('.filter-loader').show();
            // },
            success: function (res) {
			console.log(res);
			
              if(res.found_post > 0){
				$('.results_area').html(res.content);
			  }else{
				$('.results_area').html('No jobs found!');
			  }
            }
        });
	});


	$('.modal-toggle').on('click', function(e) {
		$('.apply_form').slideToggle();
	 });

})( jQuery );
