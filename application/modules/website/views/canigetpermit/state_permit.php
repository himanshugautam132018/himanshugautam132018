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
            foreach ($response as $res) {
              
        ?>
                <tr id="warning_permit">
                    <td><?php echo $res['state_name']; ?></td>
                    <td><?php echo $res['permit_required']; ?></td>
                    <td><?php echo $res['annual_permit']; ?></td>
                    <td><?php echo $res['violation']; ?></td>
                </tr>
        <?php }
        } ?>

    </table>

</div>