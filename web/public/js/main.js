function initGlobal() {
    objMap.initMap();
};

$(document).ready(function () {
    'use strict';
    $('#form_city').autocompleter({
        url_list: '/search-city',
        url_get: '/?term='
    });

    $("#ui-id-1").click(function(){
        var id = $("#form_city").val();

        if(id.toString().length > 0){
            $(location).attr('href', '/city/'+id.toString());
        }
    })

});