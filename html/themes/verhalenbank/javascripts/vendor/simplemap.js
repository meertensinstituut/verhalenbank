var nederland,
    centermap;

// loads the googlemaps api asynchroniously:
// function is called from yepnope (modernizr)
function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
//  script.src = 'https://maps.googleapis.com/maps/api/js?libraries=geometry&language=nl&sensor=false&' +
//      'callback=initialize&key=AIzaSyBCVJZl_NcpxEPBv66cyIC6RJLLJklGYRU';
  //script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize&key=AIzaSyBCVJZl_NcpxEPBv66cyIC6RJLLJklGYRU';

  // callback calls initialize function!!
  document.body.appendChild(script);
}

function initialize() {
    var water = "#dda9a9",
        white = "#f2f2f2",
        dark = "#d6d6d6";
        // Create an array of styles.
        // create json for maps: http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
    //var styles =   [{}];
        var onlyroads = [
           {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    { "visibility": "off" },
                    { "color": dark }
                ]
            }, {
                            "elementType": "labels",
                            "stylers": [
                                { "visibility": "off"}
                            ]
                        },
            {
                "featureType": "administrative.locality",
                "elementType": "labels.text.fill",
                "stylers": [
                    { "visibility": "off" },
                    { "color": "#808080" }
                ]
            },
//            {
//                "featureType": "road.highway",
//                "elementType": "labels.text.stroke",
//                "stylers": [
//                  { "visibility": "on" },
//                  { "color": "#ffffff" }
//                ]
//              },
            {
            "elementType": "geometry.fill",
            "stylers": [
            { "visibility": "on" },
            { "color": white }
            ]
            },{
            "elementType": "geometry.stroke",
            "stylers": [
            { "visibility": "on" },
            { "color": dark }
            ]
            },{
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
            { "color": dark }
            ]
            },{
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
            { "color": dark }
            ]
            },{
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
            { "color": dark }
            ]
            },{
            "featureType": "road",
            "elementType": "geometry.stroke",
            "stylers": [
            { "visibility": "off" }
            ]
            },{
            "featureType": "road.local",
            "elementType": "labels.icon",
            "stylers": [
            { "visibility": "on" },
            { "color": dark }
            ]
            },{
            "featureType": "transit",
            "elementType": "geometry.stroke",
            "stylers": [
            { "visibility": "off" }
            ]
            },{
            "featureType": "transit",
            "elementType": "geometry.fill",
            "stylers": [
            { "visibility": "on" },
            { "color": dark }
            ]
            },{
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
            { "visibility": "off" }
            ]
            },

                        {
                            "featureType": "administrative.country",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                    { "visibility": "on" },
                                    { "color": "#04eefd" },
                                    { "weight": 5 }
                            ] },
                            { "featureType": "administrative.province",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    { "visibility": "on" },
                                    { "color": "#04eefd" },
                                    { "weight": 3 }
                                ] },
                            { "featureType": "administrative.province",
                                          "elementType": "labels.text.fill",
                                          "stylers": [
                                              { "visibility": "off" },
                                              { "color": dark },
                                              { "weight": 1 }
                                          ] },
    //                    {
    //                        "featureType": "road.local",
    //                        "elementType": "labels.text.fill",
    //                        "stylers": [
    //                          { "visibility": "on" },
    //                            { "color": "#ffffff" }
    //                        ]
    //                      },
    //                    {
    //                        "featureType": "administrative",
    //                        "elementType": "labels",
    //                        "stylers": [
    //                          { "visibility": "on" }
    //                        ]
    //                      }
    {
    "featureType": "transit.station.airport",
    "elementType": "geometry.stroke",
    "stylers": [
    { "visibility": "off" },
    { "color": dark }
    ]
    },{
    "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
    { "visibility": "off" }

    ]
    },{
    },{
    "featureType": "transit.station.airport",
    "elementType": "geometry.fill",
    "stylers": [
    { "visibility": "off" },
    { "color": "#ffffff" }
    ]
    },{
    "featureType": "transit.station.airport",
    "elementType": "geometry.fill",
    "stylers": [
    { "visibility": "off" },
    { "color": "#f1f0f1" }
    ]
    } , {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
    { "visibility": "on" },
    { "color": water } //  { "color": "#70b4df" }
    ]
    }
    ]
    createNederland();
   getRandomPoint();
    //var styledMapType = new google.maps.StyledMapType(styles,{name: 'Kaart'});
    var onlyroadsType = new google.maps.StyledMapType(onlyroads, {name: 'Meertens'});

    var mapOptions = {
        zoom: 14,
        center: centermap,
        //mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControlOptions: {
           // mapTypeIds: ['onlyroads', 'styled_maps']
            mapTypeIds: ['onlyroads']
           // style: 'DROPDOWN_MENU'

        },
        backgroundColor: "#f2f2f2",
        overviewMapControl: false,
//        overviewMapControlOptions: {
//                opened: true
//            },
        panControl : false,
        zoomControl : false,
        streetViewControl : false,
        disableDefaultUI: true
    };


    var map = new google.maps.Map(document.getElementById('map_canvas'),
                 mapOptions);
       // Associate the styled map with the MapTypeId and set it to display.
   // map.mapTypes.set('styled_maps', styledMapType);



    map.mapTypes.set('onlyroads',  onlyroadsType);
    map.setMapTypeId('onlyroads');
    nederland.setMap(map);
}



//window.onload = loadScript;

function makeRandomNumber(min,max){
   return Math.floor(Math.random() * (max - min + 1) + min);
}

function getRandomPoint(){

   // van links naar rechts: van 2.43 tot 7.26
    // van boven naar beneden: 53.66 tot 49.41
    randlat = (makeRandomNumber(2430,7260)/1000);
    randlng = (makeRandomNumber(49410,53660)/1000);

   // randlatitude= 180*Math.random() - 90;
    //randlongitude =  360*Math.random() - 180;
    point = new google.maps.LatLng(randlng, randlat);
   // point = new google.maps.LatLng (52.331921770570375, 4.915135899999996); // meertens

    if(google.maps.geometry.poly.containsLocation(point, nederland) == true) {
        centermap = point;

        //initialize();
    } else {

       getRandomPoint();
    }

}
function createNederland(){
    // get coordinates at: http://www.the-di-lab.com/polygon/

    var triangleCoords = [
            new google.maps.LatLng(51.12593657426229, 2.4554443359375),
            new google.maps.LatLng(50.88744141113226, 2.5213623046875),
            new google.maps.LatLng(50.6912380522005, 2.6751708984375),
            new google.maps.LatLng(50.63552636417384, 2.889404296875),
            new google.maps.LatLng(50.71385204707258, 3.10638427734375),
            new google.maps.LatLng(50.48722109174841, 3.23822021484375),
            new google.maps.LatLng(50.426018524279066, 3.49639892578125),
            new google.maps.LatLng(50.2594979383533, 3.63372802734375),
            new google.maps.LatLng(50.23666548810372, 3.9935302734375),
            new google.maps.LatLng(49.98302007547225, 4.07318115234375),
            new google.maps.LatLng(49.861005318023004, 4.295654296875),
            new google.maps.LatLng(49.928240054369226, 4.72137451171875),
            new google.maps.LatLng(49.713824623405046, 4.844970703125),
            new google.maps.LatLng(49.53412174576703, 5.30364990234375),
            new google.maps.LatLng(49.43777096183293, 5.5316162109375),
            new google.maps.LatLng(49.450271575719945, 5.80902099609375),
            new google.maps.LatLng(49.537686652219996, 6.031494140625),
            new google.maps.LatLng(49.74933075001045, 6.00677490234375),
            new google.maps.LatLng(50.088868933829644, 6.1798095703125),
            new google.maps.LatLng(50.30337575356313, 6.54510498046875),
            new google.maps.LatLng(50.59369921413021, 6.3995361328125),
            new google.maps.LatLng(50.7798919741081, 6.20452880859375),
            new google.maps.LatLng(51.012026657382386, 6.1962890625),
            new google.maps.LatLng(51.25847731518399, 6.3665771484375),
            new google.maps.LatLng(51.49506473014368, 6.36932373046875),
            new google.maps.LatLng(51.713416052417614, 6.2896728515625),
            new google.maps.LatLng(51.84595933666337, 6.75933837890625),
            new google.maps.LatLng(51.986571643810805, 6.98455810546875),
            new google.maps.LatLng(52.2126557200447, 7.14385986328125),
            new google.maps.LatLng(52.449314140869696, 7.1685791015625),
            new google.maps.LatLng(52.55965567958739, 6.8389892578125),
            new google.maps.LatLng(52.61639023304538, 7.12188720703125),
            new google.maps.LatLng(52.832639706103215, 7.19879150390625),
            new google.maps.LatLng(53.067626642387374, 7.33062744140625),
            new google.maps.LatLng(53.31118556593906, 7.27294921875),
            new google.maps.LatLng(53.491313790532956, 6.92138671875),
            new google.maps.LatLng(53.62509548869807, 6.7291259765625),
            new google.maps.LatLng(53.58435320870081, 6.41876220703125),
            new google.maps.LatLng(53.53051320304864, 6.0479736328125),
            new google.maps.LatLng(53.5256152592252, 5.657958984375),
            new google.maps.LatLng(53.49621570004609, 5.3228759765625),
            new google.maps.LatLng(53.39479437775073, 5.0537109375),
            new google.maps.LatLng(53.30462107510271, 4.888916015625),
            new google.maps.LatLng(53.186287573913305, 4.7021484375),
            new google.maps.LatLng(53.016435582533816, 4.61700439453125),
            new google.maps.LatLng(52.80940281068804, 4.5758056640625),
            new google.maps.LatLng(52.68970242806752, 4.5263671875),
            new google.maps.LatLng(52.50786308797268, 4.46868896484375),
            new google.maps.LatLng(52.27151887966843, 4.32586669921875),
            new google.maps.LatLng(52.05924589011585, 4.0374755859375),
            new google.maps.LatLng(52.01869808104436, 3.83697509765625),
            new google.maps.LatLng(51.8815775618944, 3.8616943359375),
            new google.maps.LatLng(51.74743863117572, 3.57330322265625),
            new google.maps.LatLng(51.46085244645549, 3.3453369140625)


    ];

      // Construct the polygon
      // Note that we don't specify an array or arrays, but instead just
      // a simple array of LatLngs in the paths property
      nederland = new google.maps.Polygon({
        paths: triangleCoords,
        strokeColor: "#03fa54",
        strokeOpacity: 0,
        strokeWeight: 1,
        fillColor: "#FFffff",
        fillOpacity: 0
      });

}