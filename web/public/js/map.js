//Création de l'objet objMap
var objMap = {
    lat: 46.227638, //Latitude
    lng: 2.213749000000007, //Longitude
    zoom: 5, //Niveau de zoom de la carte

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
