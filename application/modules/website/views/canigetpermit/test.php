
<div class="container client_dashboard">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs form_custom_tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="first_tab" data-toggle="tab" href="#first" role="tab"
                            aria-controls="first" aria-selected="true"><img src="asset/image/img1.png"
                                alt="1 Steering with Tandem" data-toggle="tooltip" data-placement="top"
                                title="1 Steering with Tandem"></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="second_tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="false"><img src="asset/image/img2.png"
                                alt="1 Steering with Tridem" data-toggle="tooltip" data-placement="top"
                                title="1 Steering with Tridem"></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="third_tab" data-toggle="tab" href="#third" role="tab"
                            aria-controls="third" aria-selected="false"><img src="asset/image/img3.png"
                                alt="2 Steering with Tandem" data-toggle="tooltip" data-placement="top"
                                title="2 Steering with Tandem"></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fourth_tab" data-toggle="tab" href="#fourth" role="tab"
                            aria-controls="fourth" aria-selected="false"><img src="asset/image/img4.png"
                                alt="2 Steering with Tridem" data-toggle="tooltip" data-placement="top"
                                title="2 Steering with Tridem"></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fifth_tab" data-toggle="tab" href="#fifth" role="tab"
                            aria-controls="fifth" aria-selected="false"><img src="asset/image/img5.png"
                                alt="1 Steering with Quad" data-toggle="tooltip" data-placement="top"
                                title="1 Steering with Quad"></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sixth_tab" data-toggle="tab" href="#sixth" role="tab"
                            aria-controls="sixth" aria-selected="false"><img src="asset/image/img6.png"
                                alt="1 Steering with 5 Axles" data-toggle="tooltip" data-placement="top"
                                title="1 Steering with 5 Axles"></a>
                    </li>

                </ul>
                <div class="tab-content form_custom_content" id="myTabContent">

                    <!-- First Tab: 1 steering with tandem  -->

                    <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first_tab">
                        <div class="truck_image_title">
                            <h2>1 Steering with Tandem</h2>
                        </div>
                        <div class="thumnail_detail_image"><img src="asset/image/graph1.png" alt=""></div>
                        <form class="permit_form">
                            <div class="can_permit_truck_information">
                                <h2 class="heading_custom_bottom">Truck Information</h2>
                                <div class="form_col2">
                                    <div class="form-group required">
                                        <label for="cranelength">Overall Crane Length (CL) :</label>
                                        <input type="number" class="form-control" id="cranelength"
                                            aria-describedby="cranelengthHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="craneChassis">Overall Chassis Length (OL) :</label>
                                        <input type="number" class="form-control" id="craneChassis"
                                            aria-describedby="craneChassisHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group required">
                                        <label for="bumberToAxle">Bumper to Axle 1 (BA) :</label>
                                        <input type="number" class="form-control" id="bumberToAxle"
                                            aria-describedby="bumberToAxleHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="frontoverhang">Front Ovehang (FO) :</label>
                                        <input type="number" class="form-control" id="frontoverhang"
                                            aria-describedby="frontoverhangHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="rearoverhang">Rear Ovehang (RO) :</label>
                                        <input type="number" class="form-control" id="rearoverhang"
                                            aria-describedby="rearoverhangHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="overallHeight">Overall Height (H) :</label>
                                        <input type="number" class="form-control" id="overallHeight"
                                            aria-describedby="overallHeightHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="overallwidth">Width (W) :</label>
                                        <input type="number" class="form-control" id="overallwidth"
                                            aria-describedby="overallwidthHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="extremeAxle">Extreme Axle Length (WB) :</label>
                                        <input type="number" class="form-control" id="extremeAxle"
                                            aria-describedby="extremeAxleHelp" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group required">
                                        <label for="Axle12">Axle 1 - 2 (L1) :</label>
                                        <input type="number" class="form-control" id="Axle12"
                                            aria-describedby="Axle12Help" required>
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Axle23">Axle 2 - 3 (L2) :</label>
                                        <input type="number" class="form-control" id="Axle23"
                                            aria-describedby="Axle23Help">
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <?php if(!empty($tab) && $tab!=1 || $tab==2 && $tab==3) { ?>
                                    <div class="form-group">
                                        <label for="Axle34">Axle 3 - 4 (L3) :</label>
                                        <input type="number" class="form-control" id="Axle34" aria-describedby="Axle34Help">
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <?php } ?>
                                    <?php if(!empty($tab) && $tab!=1 && $tab!=2 && $tab!=3 || $tab==4 && $tab==5) { ?>
                                    <div class="form-group">
                                        <label for="Axle45">Axle 4 - 5 (L4) :</label>
                                        <input type="number" class="form-control" id="Axle45" aria-describedby="Axle45Help">
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <?php } ?>
                                    <?php if(!empty($tab) && $tab!=1 && $tab!=2 && $tab!=3 && $tab!=4 && $tab!=4  && $tab!=5) { ?>
                                    <div class="form-group">
                                        <label for="Axle56">Axle 5 - 6 (L5) :</label>
                                        <input type="number" class="form-control" id="Axle56" aria-describedby="Axle56Help">
                                        <span class="size_label">(ft)</span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 radio_input">
                                        <h5 class="field_category">Steering Axle</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row input_radio_btn">
                                            <label class="col-md-4">Number of tires in each axle :</label>
                                            <div class="col-md-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="inlineRadioOptions" id="inlineRadio1" value="option1"
                                                        checked>
                                                    <label class="form-check-label" for="inlineRadio1">2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2">4</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle1width">Axle 1 Width (AW1) :</label>
                                        <input type="number" class="form-control" id="WAxle1"
                                            aria-describedby="Axle1widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle1">Weight, Axle 1 (W1) :</label>
                                        <input type="number" class="form-control" id="WAxle1"
                                            aria-describedby="WAxle1Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle1">Axle 1 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1"
                                                aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php if(!empty($tab) && $tab==3 || $tab==4 || $tab==6){ ?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle2width">Axle 2 Width (AW2) :</label>
                                        <input type="number" class="form-control" id="WAxle2" aria-describedby="Axle2widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle2">Weight, Axle 2 (W2) :</label>
                                        <input type="number" class="form-control" id="WAxle2" aria-describedby="WAxle2Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle2">Axle 2 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1" aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-4 radio_input">
                                        <h5 class="field_category">Tandem Axlee</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row input_radio_btn">
                                            <label class="col-md-4">Number of tires in each axle :</label>
                                            <div class="col-md-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="inlineRadioOptionstandem" id="inlineRadio3"
                                                        value="option3" checked>
                                                    <label class="form-check-label" for="inlineRadio1">2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="inlineRadioOptionstandem" id="inlineRadio4"
                                                        value="option">
                                                    <label class="form-check-label" for="inlineRadio2">4</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($tab) && $tab==1 || $tab==2 && $tab!=3 || $tab==5 || $tab==6){?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle2width">Axle 2 Width (AW2) :</label>
                                        <input type="number" class="form-control" id="WAxle2"
                                            aria-describedby="Axle2widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle2">Weight, Axle 2 (W2) :</label>
                                        <input type="number" class="form-control" id="WAxle2"
                                            aria-describedby="WAxle2Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle2">Axle 2 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1"
                                                aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(!empty($tab) && $tab==1 || $tab==2 || $tab==3 || $tab==4 || $tab==5 || $tab==6){?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle3width">Axle 3 Width (AW3) :</label>
                                        <input type="number" class="form-control" id="WAxle3"
                                            aria-describedby="Axle3widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle2">Weight, Axle 3 (W3) :</label>
                                        <input type="number" class="form-control" id="WAxle3"
                                            aria-describedby="WAxle2Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle3">Axle 3 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1"
                                                aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(!empty($tab) && $tab==2 || $tab==3 || $tab==4 || $tab==5 || $tab==6){ ?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle4width">Axle 4 Width (AW4) :</label>
                                        <input type="number" class="form-control" id="WAxle4" aria-describedby="Axle4widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle4">Weight, Axle 4 (W4) :</label>
                                        <input type="number" class="form-control" id="WAxle4" aria-describedby="WAxle4Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle4">Axle 4 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1" aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(!empty($tab) && $tab==4 || $tab==5 || $tab==6){?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle5width">Axle 5 Width (AW5) :</label>
                                        <input type="number" class="form-control" id="WAxle5" aria-describedby="Axle5widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle5">Weight, Axle 5 (W5) :</label>
                                        <input type="number" class="form-control" id="WAxle5" aria-describedby="WAxle5Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle5">Axle 5 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1" aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(!empty($tab) && $tab==6){?>
                                <div class="form_col2">
                                    <div class="form-group">

                                        <label for="Axle6width">Axle 6 Width (AW6) :</label>
                                        <input type="number" class="form-control" id="WAxle6" aria-describedby="Axle6widthHelp">
                                        <span class="size_label">(ft)</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="WAxle6">Weight, Axle 6 (W6) :</label>
                                        <input type="number" class="form-control" id="WAxle6" aria-describedby="WAxle6Help">
                                        <span class="size_label">(lb)</span>
                                    </div>
                                    <div class="form-group dropdown_custom">
                                        <label for="Axle6">Axle 6 total tire width :</label>
                                        <div class="select_inputs_custom">
                                            <select class="steering_axle" id="steering_select">
                                                <option value="">Select Tire Size</option>
                                                <option value="">10R22.5</option>
                                                <option value="">11R22.5</option>
                                                <option value="">11R24.5</option>
                                                <option value="">12R22.5</option>
                                                <option value="">235/80R22.5</option>
                                                <option value="">255/70R22.5</option>
                                                <option value="">255/80R22.5</option>
                                                <option value="">275/70R22.5</option>
                                                <option value="">275/80R22.5</option>
                                                <option value="">275/80R24.5</option>
                                                <option value="">285/75R24.5</option>
                                                <option value="">295/60R22.5</option>
                                                <option value="">295/75R22.5</option>
                                                <option value="">295/8022.5</option>
                                                <option value="">305/70R22.5</option>
                                                <option value="">315/80R22.5</option>
                                                <option value="">365/70R22.5</option>
                                                <option value="">425/65R22.5</option>
                                                <option value="">435/50R19.5</option>
                                                <option value="">445/50R22.5</option>
                                                <option value="">455/55R22.5</option>

                                            </select>
                                            <!-- dynamic tyre width  -->
                                            <input type="number" class="form-control" id="Axle1" aria-describedby="Axle1Help">
                                        </div>
                                        <span class="size_label">(in)</span>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form_col2 submit_button_grid">
                                   
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn form_button simple_btn calculation"
                                            onclick="openSideNav()">Calculation</button>

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- End first Tab  -->

                    <!-- End Sixth Tab  -->
                </div>
            </div>
        </div>
    </div>