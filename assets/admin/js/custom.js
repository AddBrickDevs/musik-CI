$(function () {
	$(".select2").select2();

	$('.select2-artist').select2({
		minimumInputLength: "3",
		  ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
           url: base_url+"dashboard/search_artist",
            dataType: 'json',
            quietMillis: 300, 
            data: function (term, page) {
                return {
                    q: term, // search term
                    page_limit: 10                    
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.                                
                return {results: data.artist};
            }
        }	  
	});

	$('.select2-song').select2({
		minimumInputLength: "3",
		  ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
           url: base_url+"dashboard/search_song",
            dataType: 'json',
            quietMillis: 300, 
            data: function (term, page) {
                return {
                    q: term, // search term
                    page_limit: 10                    
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.                
                return {results: data.songs};
            }
        }	  
	});

    $('*[data-toggle="popover"]').popover();
});