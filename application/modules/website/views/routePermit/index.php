<style>
    label.error {
        position: absolute;
        bottom: -30px;
    }
</style>
<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=<?php echo BING_MAP_KEY; ?>' async defer></script>
<script type='text/javascript'>
    var map;
    var directionsManager;
    var mapLoader = $("#mapLoader");
    mapLoader.show()

    function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {});

        //Load the directions module.
        Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function() {
            //Create an instance of the directions manager.
            directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
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
            //Specify where to display the route instructions.
            directionsManager.setRenderOptions({
                itineraryContainer: '#directionsItinerary',
            });

            //Specify the where to display the input panel
            directionsManager.showInputPanel('directionsPanel');
            mapLoader.hide();
        });
    }
</script>

<style>
    div.routemap {
        height: 550px;
    }

    .directionsContainer {
        width: 380px;
        height: 100%;
        overflow-y: auto;
        float: left;
    }

    div.route_map_rt {
        width: calc(100% - 380px);
        float: left !important;
        height: 100%;
        float: left;
    }

    .MicrosoftMap .directionsPanel ul {
        padding-left: 15px;
    }

    .MicrosoftMap .dropdownOpen .dropdownPopup input.radio {
        /* line-height: 10px !important; */
        height: 23px;
        margin-right: 5px !important;
    }

    .dirOptsDriving input[type=checkbox] {
        height: 23px;
        margin-right: 5px !important;
    }

    .dirOptsDriving label {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .calContainer.single_cal_holder table {
        width: 100%;
    }

    a.dirBtnRev {
        display: none !important;
    }

    a.dirBtnRev {
        display: none !important;
    }

    body .MicrosoftMap.dirSDK .dirWp input {
        width: 320px !important;
    }

    .dirBtnWalk {
        display: none !important;
    }

    .dirBtnTransit {
        display: none !important;
    }
</style>
<div class="container client_dashboard">
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">

                <!-- Route Permite tab  -->

                <div class="" id="v-pills-routepermit">


                    <div class="permit_form route_permit_form">
                        <h2 class="heading_custom_bottom">Check Route Permit</h2>
                        <div class="routemap" id="route_map">
                            <div class="loader" id="mapLoader"></div>
                            <div class="directionsContainer">
                                <div id="directionsPanel"></div>
                                <div id="directionsItinerary"></div>
                            </div>
                            <div id="myMap" class="route_map_rt"></div>
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