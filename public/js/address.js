function initializeAutocomplete() {
	var options = {
		componentRestrictions: {country: "ru"}
	};
	var input = document.getElementById('input_address');
	var autocomplete = new google.maps.places.Autocomplete(input, options);
	autocomplete.addListener('place_changed', function() {
		var event = new Event('change');
		input.dispatchEvent(event);
	});
}
google.maps.event.addDomListener(window, 'load', initializeAutocomplete);
