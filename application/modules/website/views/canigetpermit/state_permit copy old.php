<div class="" id="v-pills-statepermit">
    <h2 class="heading_custom_bottom">State Permit</h2>
    <table class="state_permit">
        <tr>
            <th>State</th>
            <th>Require Permit?</th>
            <th>Annual Permit</th>
            <th>Violation</th>
        </tr>
        <?php if (!empty($response)) {
           $annual_permit="NO";
            foreach ($response as $res) {
                foreach ($res['calculation'] as $cal){
                   if($cal['xcp_permit_type_id']==17){
                    $annual_permit="YES";
                   }
                }
                
        ?>
                <tr id="warning_permit">
                    <td><?php echo $res['state_name']; ?></td>
                    <td><?php echo $res['permit_required']; ?></td>
                    <td><?php echo  $annual_permit ;?></td>
                    <td></td>
                </tr>
        <?php } 
        } ?>

    </table>

</div>