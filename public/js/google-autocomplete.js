inputField = document.getElementById('profile.property_address.full_address1');

google.maps.event.addDomListener(window, "load", initAutocomplete);

let componentForm = {
    street_number: 'short_name', // Street Number
    route: 'long_name', // Street Name
    locality: 'long_name', // City
    administrative_area_level_1: 'short_name', // Province
    //country: 'long_name', // Country
    postal_code: 'short_name' // Postal Code
};
let formFields = {
    'street_number': 'profile.property_address.number',
    'route': 'profile.property_address.address1', // Street Name
    'locality': 'profile.property_address.city', // City
    'administrative_area_level_1': 'profile.property_address.province', // Province
    //'profile.property_address.country', // Country
    'postal_code': 'profile.property_address.postal_code' // Postal Code
};

function initAutocomplete() {
    console.log('Autocomplete Initiated');
    leadAddress = new google.maps.places.Autocomplete(inputField, {
        /** @type {!HTMLInputElement} */
        componentRestrictions: { country: ["ca"] },
        fields: ["address_components"],
        types: ["address"],
    });
    leadAddress.addListener("place_changed", () => {
        fillInAddress(leadAddress);
    })
}

function fillInAddress(autocomplete) {
    // Get the place details from the autocomplete object.
    let place = autocomplete.getPlace();

    for (let component in formFields) {
            //console.log(component, formFields[component]);
        if (!!document.getElementById(formFields[component])) {
            document.getElementById(formFields[component]).value = '';
            document.getElementById(formFields[component]).disabled = false;
        }
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    let address = '';
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType] && document.getElementById(formFields[addressType])) {
            let val = place.address_components[i][componentForm[addressType]];
            document.getElementById(formFields[addressType]).value = val;
        }

        if(addressType == 'street_number' || addressType == 'route') {
            address += place.address_components[i][componentForm[addressType]] + ' ';
        }
    }

    document.getElementById('profile.property_address.full_address1').value = address;
}
