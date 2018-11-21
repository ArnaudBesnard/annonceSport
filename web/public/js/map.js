//Création de l'objet objMap
var objMap = {
    lat: 47.9167, //Latitude
    lng: -3.3333, //Longitude
    zoom: 13, //Niveau de zoom de la carte

    //Initialisation de la Map
    initMap: function () {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: this.zoom,
            center: {
                lat: this.lat,
                lng: this.lng
            }
        });
        objMarkers.initJson();
    },
};
