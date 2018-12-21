//Création de l'objet objMap
var objMap = {
    lat: parseFloat(document.getElementById('lat').innerHTML), //Latitude
    lng: parseFloat(document.getElementById('long').innerHTML), //Longitude
    zoom: parseFloat(document.getElementById('zoom').innerHTML), //Zoom


    //Initialisation de la Map
    initMap: function () {
        advertMap = new google.maps.Map(document.getElementById('advertMap'), {
            zoom: this.zoom,
            center: {
                lat: this.lat,
                lng: this.lng
            }
        });

        var marker = new google.maps.Marker({
            position: {
                lat: this.lat,
                lng: this.lng
            },
            map: advertMap,
            title: 'Localisation de l\'annonce'
        });
    },
};


