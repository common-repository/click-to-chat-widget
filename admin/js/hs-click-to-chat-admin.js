(function( $ ) {
	'use strict';
	$(document).ready(function(){
		var hs_number_validator = document.querySelector("#hs_click_to_chat_pn");
		try{
			var iti =  window.intlTelInput( hs_number_validator,{
				initialCountry: hs_chat_object.country_code,
				utilsScript : hs_chat_object.utils_path
			});

			hs_number_validator.addEventListener("countrychange", function() {
				var country_selected_data = iti.getSelectedCountryData();
				$('input[name="hs_click_to_chat[country-code]"]').val( country_selected_data.iso2 );
			});
		}  catch(e){
			console.info(e);
		}
	});

})( jQuery );
