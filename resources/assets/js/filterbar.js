/*[ No ui ]
===========================================================*/
var filterBar = document.getElementById('filter-bar');
var price_min = document.getElementById('price_min').value;
var price_max = document.getElementById('price_max').value;
noUiSlider.create(filterBar, {
    start: [ price_min, price_max ],
    connect: true,
    step : 1,
    range: {
        'min': 5,
        'max': 100
    }
});

var skipValues = [
    document.getElementById('value-lower'),
    document.getElementById('value-upper')
];

var getValues = [
    document.getElementById('price_min'),
    document.getElementById('price_max')
];

filterBar.noUiSlider.on('update', function( values, handle ) {
    skipValues[handle].innerHTML = Math.round(values[handle]) ;
    getValues[handle].value = Math.round(values[handle]) ;
});
