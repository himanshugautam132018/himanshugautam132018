<?php
$activeUser = $this->session->userdata('xcmgarc_userData');

?>
<div class="container client_dashboard">
    <div class="loader"></div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs form_custom_tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="first_tab" onclick="tab_click_calculation_form(1)" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
                        <img src="<?php echo base_url() ?>assets/image/img1.png" alt="1 Steering with Tandem" data-toggle="tooltip" data-placement="top" title="1 Steering with Tandem">
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="second_tab" onclick="tab_click_calculation_form(2)" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">
                        <img src="<?php echo base_url() ?>assets/image/img2.png" alt="1 Steering with Tridem" data-toggle="tooltip" data-placement="top" title="1 Steering with Tridem">
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="third_tab" onclick="tab_click_calculation_form(3)" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">
                        <img src="<?php echo base_url() ?>assets/image/img3.png" alt="2 Steering with Tandem" data-toggle="tooltip" data-placement="top" title="2 Steering with Tandem">
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="fourth_tab" onclick="tab_click_calculation_form(4)" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">
                        <img src="<?php echo base_url() ?>assets/image/img4.png" alt="2 Steering with Tridem" data-toggle="tooltip" data-placement="top" title="2 Steering with Tridem">
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="fifth_tab" onclick="tab_click_calculation_form(5)" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">
                        <img src="<?php echo base_url() ?>assets/image/img5.png" alt="1 Steering with Quad" data-toggle="tooltip" data-placement="top" title="1 Steering with Quad">
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="sixth_tab" onclick="tab_click_calculation_form(6)" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth" aria-selected="false">
                        <img src="<?php echo base_url() ?>assets/image/img6.png" alt="1 Steering with 5 Axles" data-toggle="tooltip" data-placement="top" title="1 Steering with 5 Axles">
                    </a>
                </li>

            </ul>

            <div class="tab-content form_custom_content" id="myTabContent_append">


            </div>
            
        </div>
    </div>
</div>

<script>
    var spinnerLogin = $(".loader");

    function tab_click_calculation_form(tabId) {
        spinnerLogin.show();
        $("body").addClass("loader_body");
        $.ajax({
            url: "<?php echo base_url("can_i_get_route_form") ?>",
            dataType: 'html',
            type: "POST",
            data: {
                tabId: tabId,
                pageType: "can_i_get"
            },
            success: function(response) {
                $("body").removeClass("loader_body");
                spinnerLogin.hide();
                $("#myTabContent_append").html(response);
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