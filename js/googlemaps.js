$(function(){

$('#googleMap').gmap3({ 
			action:'init',
            options:{
              center:[-33.4523649,-70.5608814],
              zoom: 16,
              streetViewControl: false,
              styles:
              [
              {featureType: "all", stylers: [{saturation: -100}]},
              ]
            }
          },
          { action: 'addMarkers',
            markers:[
              {lat:-33.4523649, lng:-70.5608814, options:{icon:"http://www.brium.cl/img/direccion.png"}},
            ],
            marker:{
              options:{
                draggable: false
              },
              
            }
          }
        );
});
    
