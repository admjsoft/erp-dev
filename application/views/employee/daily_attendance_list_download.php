<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .employee-image {
            display: block;
            margin: 0 auto 20px;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .details-col {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .attendance-table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .attendance-table img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .attendance-table td, .attendance-table th {
            padding: 10px;
            vertical-align: top;
            border: 1px solid #ddd;
            font-size: 16px;
            text-align: center;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="details-col">
        <h2>Daily Attendance - <?php echo date('d-m-Y'); ?></h2>
        <table class="attendance-table">
            <tr>
                <th>#</th>
                <th><?php echo $this->lang->line('Employee') ?></th>
                <th><?php echo $this->lang->line('Date & ClockIn') ?></th>
                <th><?php echo $this->lang->line('Early / Late In Minutes') ?></th>
                <th><?php echo $this->lang->line('Date & ClockOut') ?></th>
                <th><?php echo $this->lang->line('Early / Late In Minutes') ?></th>
                <th><?php echo $this->lang->line('Auto LoggedOut') ?></th>
            </tr>
            <?php if(!empty($attendance_list)){ $a=1; foreach($attendance_list as $attendance){ 
                ?>
                <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $attendance['name']; ?></td>
                    <td ><?php echo $attendance['lowest_clock_in_time']; ?></td>
                    <td style="background-color: <?php if($attendance['clockin_late_mark']) { echo "#FF7F7F"; } ?>"><?php echo $attendance['clockin_difference']; ?></td>
                    <td ><?php echo $attendance['highest_clock_out_time']; ?></td>
                    <td style="background-color: <?php if($attendance['clockout_early_mark']) { echo "#FF7F7F"; } ?>"><?php echo $attendance['clockout_difference']; ?></td>
                    <td><?php echo $attendance['auto_logout']; ?></td>
                </tr>
            <?php $a++; } }?>  
        </table>
    </div>

    <div class="details-col">
        <!-- Attendance Timings -->
        <h2>Attendance Timings</h2>
        <table>
            <tr>
                <td><strong>Clock In Time: <?php echo date('h:i A',strtotime($attendance_settings['clock_in_time'])); ?></strong></td>
                
            </tr>
            <tr>
                <td><strong>Clock Out Time: <?php echo date('h:i A',strtotime($attendance_settings['clock_out_time'])); ?></strong></td>
                
            </tr>
        </table>
    </div>

    <!-- List of employee names -->
    <div class="details-col">
        <?php if (!empty($absent_emp_names)) : ?>
        <h2>List of Absent Employee Names</h2>
        <ul>
            <?php foreach ($absent_emp_names as $name) : ?>
                <li><?php echo $name['name']; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php else : ?>
        <p>No absent employees</p>
        <?php endif; ?>
    </div>

</body>

</html>


   