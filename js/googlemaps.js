$(function(){

$('#googleMap').gmap3({ 
			action:'init',
            options:{
              center:[-33.4523649,-70.5608814],
              zoom: 16,
              streetViewControl: true,
              styles:
              [
              {featureType: "all", stylers: [{saturation: -100}]},
              ]
            }
          },
          { action: 'addMarkers',
            markers:[
              {lat:-33.4523649, lng:-70.5608814, options:{icon:"http://www.brium.cl/es/img/direccion.png"}},
            ],
            marker:{
              options:{
                draggable: false
              },
              
            }
          }
        );
});
    
