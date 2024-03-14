<?php if(!empty($attendance_list)){ $a=1; foreach($attendance_list as $attendance){ ?>
<tr>
    <td><?php echo $a; ?></td>
    <td><?php echo $attendance['name']; ?></td>
    <td><?php echo $attendance['lowest_clock_in_time']; ?></td>
    <td><?php echo $attendance['clockin_difference']; ?></td>
    <td><?php echo $attendance['highest_clock_out_time']; ?></td>
    <td><?php echo $attendance['clockout_difference']; ?></td>
    <td><?php echo $attendance['auto_logout']; ?></td>
    <!-- <td></td>
                        <td></td> -->
</tr>
<?php $a++; } }?>