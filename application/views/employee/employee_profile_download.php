<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
        position: relative;
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
        /* Add margin between each details-col */
    }

    table {
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
        /* Add margin below each image */
    }

    table td {
        padding: 10px;
        vertical-align: top;
        border: none;
        width: 50%;
        font-size: 16px !important;
        /* Add !important rule */
    }

    .top-right-image {
        position: absolute;
        top: 20px;
        right: 20px;
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        float:right;
        margin-bottom:20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    strong {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div>
    <img src="<?php echo base_url('userfiles/customers/'.$employee['client_photo']); ?>" alt="Top Right Image" class="top-right-image">
    </div>
    </br>
    </br>
    <h2>Employee Details</h2>

    <img src="<?php echo base_url('userfiles/employee/' . $employee['picture']); ?>" height="150" width="150"
        alt="Employee Picture" class="employee-image">

    <!-- Add the top-right image -->
  
    <div class="details-col">
        <!-- <p><strong>ID:</strong> 1</p> -->

        <table>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo !empty($employee['name']) ? $employee['name'] : 'N/A'; ?></td>
                <td><strong>Email:</strong></td>
                <td><?php echo !empty($employee['email']) ? $employee['email'] : 'N/A'; ?></td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td><?php echo !empty($employee['address']) ? $employee['address'] : 'N/A'; ?></td>
                <td><strong>City:</strong></td>
                <td><?php echo !empty($employee['city']) ? $employee['city'] : 'N/A'; ?></td>
            </tr>
            <tr>
                <td><strong>Region:</strong></td>
                <td><?php echo !empty($employee['region']) ? $employee['region'] : 'N/A'; ?></td>
                <td><strong>Country:</strong></td>
                <td><?php echo !empty($employee['country']) ? $employee['country'] : 'N/A'; ?></td>
            </tr>
            <tr>
                <td><strong>Postbox:</strong></td>
                <td><?php echo !empty($employee['postbox']) ? $employee['postbox'] : 'N/A'; ?></td>
                <td><strong>Phone:</strong></td>
                <td><?php echo !empty($employee['phone']) ? $employee['phone'] : 'N/A'; ?></td>
            </tr>

            <tr>
                <td><strong>Salary:</strong></td>
                <td><?php echo !empty($employee['salary']) ? $employee['salary'] : 'N/A'; ?></td>
                <td><strong>Joined Date:</strong></td>
                <td><?php echo !empty($employee['joindate']) ? date('d-m-Y',strtotime($employee['joindate'])) : 'N/A'; ?>
                </td>
            </tr>

            <tr>
                <td><strong>Gender:</strong></td>
                <td><?php echo !empty($employee['gender']) ? $employee['gender'] : 'N/A'; ?></td>
                <td><strong>Socso Number:</strong></td>
                <td><?php echo !empty($employee['socso_number']) ? $employee['socso_number'] : 'N/A'; ?></td>
            </tr>

            <tr>
                <td><strong>KWSP Number:</strong></td>
                <td><?php echo !empty($employee['kwsp_number']) ? $employee['kwsp_number'] : 'N/A'; ?></td>
                <td><strong>PCB Number:</strong></td>
                <td><?php echo !empty($employee['pcb_number']) ? $employee['pcb_number'] : 'N/A'; ?></td>
            </tr>



        </table>
    </div>

    <div class="details-col">
        <p><strong>Sign:</strong> <img height="100" width="100"
                src="<?php echo base_url('userfiles/employee_sign/') . $employee['sign'] ?>" alt="Employee Sign"></p>
        <!-- Add more details as needed -->
    </div>

</body>

</html>


<table>