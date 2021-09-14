<style>
    label.error {
    position: absolute;
    bottom: -30px;
}
</style>
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=<?php echo BING_MAP_KEY;?>'></script>
<script>
    function codeAddress() {
        var obj={
                "startPointAddress":"Mathura (Place of Lord krishna )",
                "endPointAddress":"New Delhi",
                "startLat1":"27.492413",
                "startLat2":"77.673676",
                "endLate1":"28.644800",
                "endLate2":"77.216721",
            };
        loadMapScenario(obj);
    }
    window.onload = codeAddress;
</script>
<script type='text/javascript'>
    var map;
var mapLoader=$("#mapLoader");
    function loadMapScenario(obj) {
        mapLoader.show();
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            /* No need to set credentials if already passed in URL */
            center: new Microsoft.Maps.Location(obj.startLat1, obj.startLat2),
            zoom: 16
        });
        Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function() {
            var directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
            // directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('printoutPanel') });
            directionsManager.setRequestOptions({
                routeMode: Microsoft.Maps.Directions.RouteMode.truck,
                vehicleSpec: {
                    dimensionUnit: 'ft',
                    weightUnit: 'lb',
                    vehicleHeight: 5,
                    vehicleWidth: 3.5,
                    vehicleLength: 30,
                    vehicleWeight: 30000,
                    vehicleAxles: 3,
                    vehicleTrailers: 2,
                    vehicleSemi: true,
                    vehicleMaxGradient: 10,
                    vehicleMinTurnRadius: 15,
                    vehicleAvoidCrossWind: true,
                    vehicleAvoidGroundingRisk: true,
                    vehicleHazardousMaterials: 'F',
                    vehicleHazardousPermits: 'F'
                }
            });
            var wp1 = new Microsoft.Maps.Directions.Waypoint({
                address: obj.startPointAddress,
                location: new Microsoft.Maps.Location(obj.startLat1,obj.startLat2) //start point late or long 
                // location: new Microsoft.Maps.Location(obj.startLat1,obj.startLat2)  //start point late or long 
            });
            var wp2 = new Microsoft.Maps.Directions.Waypoint({
                address: obj.endPointAddress,
                location: new Microsoft.Maps.Location(obj.endLate1,obj.endLate2) //end point late or lond 
                // location: new Microsoft.Maps.Location(obj.endLate1,obj.endLate2) //end point late or lond 
            });
            
            directionsManager.addWaypoint(wp1);
            directionsManager.addWaypoint(wp2);
            directionsManager.calculateDirections();
            mapLoader.hide();
        });
    }
</script>
<div class="container client_dashboard">
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">

                <!-- Route Permite tab  -->

                <div class="" id="v-pills-routepermit">


                    <div class="permit_form route_permit_form">
                        <h2 class="heading_custom_bottom">Check Route Permit</h2>
                        <div class="loader"></div>
                        <span id="addreess_serach_error" class="addreess_serach_error" style="font-size:20px;"></span>

                        <form method="POST" id="map_serach_route" action="<?php echo base_url("serach-route-by-address"); ?>" enctype="multipart/form-data">

                            <div class="form_col2">

                                <div class="form-group required">
                                    <label for="fromroute">From :</label>
                                    <input type="text" class="form-control" id="fromroute" name="from_route" aria-describedby="fromrouteHelp" placeholder="Enter address or long press the map" required>
                                </div>

                                <div class="form-group required">
                                    <label for="toroute">To :</label>
                                    <input type="text" class="form-control" id="toroute" name="to_route" aria-describedby="torouteHelp" placeholder="Enter address or long press the map" required>
                                </div>


                                <div class="form-group required">
                                    <label for="toroute">Departure Date :</label>
                                    <input type="date" class="form-control" id="datepicker" name="departure_date" aria-describedby="torouteHelp" placeholder="MM/DD/YYYY" required>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn form_button ">Submit</button>
                                </div>
                            </div>

                        </form>
                        <div class="routemap" id="route_map">
                            <div class="loader" id="mapLoader"></div>
                            <div id='myMap' style='width: 100%; height: 550px;'></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs form_custom_tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="first_tab" onclick="tab_click_route_form(1)" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
                                    <img src="<?php echo base_url() ?>assets/image/img1.png" alt="1 Steering with Tandem" data-toggle="tooltip" data-placement="top" title="1 Steering with Tandem">
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="second_tab" onclick="tab_click_route_form(2)" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">
                                    <img src="<?php echo base_url() ?>assets/image/img2.png" alt="1 Steering with Tridem" data-toggle="tooltip" data-placement="top" title="1 Steering with Tridem">
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="third_tab" onclick="tab_click_route_form(3)" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">
                                    <img src="<?php echo base_url() ?>assets/image/img3.png" alt="2 Steering with Tandem" data-toggle="tooltip" data-placement="top" title="2 Steering with Tandem">
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="fourth_tab" onclick="tab_click_route_form(4)" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">
                                    <img src="<?php echo base_url() ?>assets/image/img4.png" alt="2 Steering with Tridem" data-toggle="tooltip" data-placement="top" title="2 Steering with Tridem">
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="fifth_tab" data-toggle="tab" onclick="tab_click_route_form(5)" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">
                                    <img src="<?php echo base_url() ?>assets/image/img5.png" alt="1 Steering with Quad" data-toggle="tooltip" data-placement="top" title="1 Steering with Quad">
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="sixth_tab" data-toggle="tab" href="#sixth" onclick="tab_click_route_form(6)" role="tab" aria-controls="sixth" aria-selected="false">
                                    <img src="<?php echo base_url() ?>assets/image/img6.png" alt="1 Steering with 5 Axles" data-toggle="tooltip" data-placement="top" title="1 Steering with 5 Axles">
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content form_custom_content" id="myTabContent_route_append">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script>
<script>
    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#map_serach_route").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#map_serach_route')[0];
                var datan = new FormData(formId);
                spinner.show();
                $.ajax({
                    url: form.action,
                    dataType: 'json',
                    type: form.method,
                    data: datan,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status === true) {
                            spinner.hide();
                            $('#addreess_serach_error').html(data.message).focus();
                            $('#addreess_serach_error').css('color', 'green');
                            $('#map_serach_route')[0].reset();
                            Swal.fire(
                                'Truck  route',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = base_url;
                            });

                        } else {
                            spinner.hide();
                            if (data.status == 'form_error') {

                                var obj = data;
                                var i;
                                for (i = 0; i < obj.field.length; i++) {
                                    name = obj.field[i];
                                    $('.label-' + name).addClass('label-error');
                                    errors = JSON.stringify(obj.validation);
                                    validate = jQuery.parseJSON(errors);
                                    $("input[name=" + name + "]").after('<span class="error" style="color:red">' + validate[name] + '</span>').focus();
                                }
                            } else {

                                $('#addreess_serach_error').html(data.message).focus();
                                $('#addreess_serach_error').css('color', 'red');
                                Swal.fire(
                                    'Truck  route ',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#addreess_serach_error').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'Truck  route Error',
                            "Something went wrong . please try again once",
                            'warning'
                        );
                        $('#addreess_serach_error').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>').focus();
                        $('#addreess_serach_error').css('color', 'red');
                        setTimeout(function() {
                            $('#addreess_serach_error').html('');
                        }, 5000);

                    }
                });
            }
        });
    });
</script>
<script>
    var spinnerLogin = $(".loader");

    function tab_click_route_form(tabId) {
        spinnerLogin.show();
        $("body").addClass("loader_body");
        $.ajax({
            url: "<?php echo base_url("route-permit-form") ?>",
            dataType: 'html',
            type: "POST",
            data: {
                tabId: tabId,
                pageType: "can_i_get"
            },
            success: function(response) {
                $("body").removeClass("loader_body");
                spinnerLogin.hide();
                $("#myTabContent_route_append").html(response);
            },
            error: function(data) {
                spinnerLogin.hide();
                Swal.fire(
                    'Can I Get Permit Error',
                    "Something went wrong . please try again once",
                    'warning'
                );
            }
        });
    }
</script>
