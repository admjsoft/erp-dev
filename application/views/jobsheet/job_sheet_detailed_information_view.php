<style>
body {
    text-align: left;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

header {
    background-color: #4390a4;
    color: #fff;
    padding: 10px;
    text-align: center;
}

main {
    margin: 20px;
}

.center-image-container {
    text-align: center;
}

img.center-image {
    display: inline-block;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table,
th,
td {
    border: 1px solid black;
}

th,
td {
    padding: 10px;
    text-align: left;
}

h2 {
    margin: 20px 0;
}

.image-details-container {
    display: flex;
    flex-wrap: wrap;
    margin-top: 20px;
}

.image-details {
    flex: 0 0 48%;
    /* Adjust the width as needed */
    margin: 0 1% 20px 0;
    /* Add margin for spacing */
    border: 1px solid #ccc;
    /* Add border */
    padding: 10px;
}

.image-details img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.location-details {
    margin-top: 10px;
}

.image-details {
    display: flex;
}

.image-details img {
    max-width: 50%;
    /* Adjust the width as needed */
    height: auto;
    margin-right: 10px;
    /* Add margin between image and text */
}

.location-details {
    flex: 1;
    /* Take remaining space */
}

/* Adjust image size for smaller viewports */
@media only screen and (max-width: 600px) {
    .center-image {
        max-width: 100%;
        /* Adjust as needed */
    }

    header img.logo {
        max-width: 75px;
        /* Adjust as needed */
        margin-right: 10px;
    }
}


@media only screen and (max-width: 600px) {
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        display: block;
        width: 100%;
        box-sizing: border-box;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
}
</style>
<style>
        /* Existing styles */

        /* Header design */
        header {
            background-color: #4390a4;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logo-title-address {
            display: flex;
            align-items: center;
        }

        header img.logo {
            max-width: 125px; /* Increased by 25% */
            margin-right: 10px;
        }

        header .title-address {
            text-align: left;
        }

        /* Add more styling for title, address, and location details as needed */

        /* Adjust table layout for smaller viewports */
        @media only screen and (max-width: 600px) {
            header .logo-title-address {
                flex-direction: column;
                align-items: flex-start;
            }

            header img.logo {
                margin-bottom: 10px;
            }
            header .title-address h1 {
            font-size: 20px;
        }

        header .logo-title-address img {
            align-items: center;
            }
        }


</style>
<div class="modal-header">
    <h4 class="modal-title"><Strong><?php echo $this->lang->line('Job Sheet Details Report') ?></Strong></h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal Body -->
<div class="modal-body">



    <header>
        <div class="logo-title-address">
            <img src="<?php echo base_url('userfiles/company/'.$system_data['logo']); ?>" alt="Logo" class="logo">
            <div class="title-address">
                <h1><?php echo $system_data['cname']; ?></h1>
                <p><?php echo $system_data['address'].",".$system_data['city'].",".$system_data['region'].",".$system_data['country']; ?></p>
                <p>Phone : +<?php echo $system_data['phone']; ?>, Email : <?php echo $system_data['email']; ?></p>
                <!-- <p>Email : <?php // echo $system_data['email']; ?></p> -->
                <!-- Add address and location details here -->
            </div>
        </div>
    </header>

    <main>
        <div class="center-image-container">
            <!-- <img src="<?php // echo base_url('userfiles/company/'.$system_data['logo']); ?>" alt="Center Image"
                class="center-image"> -->
        </div>

        <table>
            <thead>
                <!-- <tr>
                    <th>Job Name</th>
                    <th>Create Date & Time</th>
                    <th>Customer Name</th>
                    <th>Customer Location</th>
                    <th>Job Priority</th>
                    <th>Job Status</th>
                    <th>DO Number</th>
                    <th>Employee Job Type</th>
                    <th>Vehicle Number</th>
                    <th>Job Assigned Date & Time</th>
                    <th>Job Estimated Completion Time</th>                    
                    <th>Job Description</th>
                </tr> -->
            </thead>
            <tbody>
                <!-- 10 rows of data -->
                <tr>
                    <?php 
                    $status="";
                    if($job_details['status']==1){
                        $status='Completed';
                    }elseif($job_details['status']==2){
                        $status='Pending';
                    }
                    elseif($job_details['status']==3){
                        $status='Unassigned';
                    }
                    elseif($job_details['status']==4){
                        
                        $status = "Work In Progress";
                    }elseif($job_details['status']==5){
                        
                        $status = "Close";
                    }

                    $given_hours = $job_details['man_days'];
                    $job_given_date = date('Y-m-d h:i:s',strtotime($job_details['cdate']." ".$job_details['ctime']));
                    $estimated_completed_date = date('d-m-Y h:i:s', strtotime($job_given_date . '+'.$given_hours.' hours'));
                    
                    ?>
                    <?php if (!empty($job_details['job_name'])) : ?>
                <tr>
                    <td>Job Name :</td>
                    <td><?php echo $job_details['job_name']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['created_at'])) : ?>
                <tr>
                    <td>Create Date & Time :</td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($job_details['created_at'])); ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['cname'])) : ?>
                <tr>
                    <td>Customer Name :</td>
                    <td><?php echo $job_details['cname']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['clocation'])) : ?>
                <tr>
                    <td>Customer Location :</td>
                    <td><?php echo $job_details['clocation']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['job_priority'])) : ?>
                <tr>
                    <td>Job Priority :</td>
                    <td><?php echo $job_details['job_priority']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($status)) : ?>
                <tr>
                    <td>Job Status :</td>
                    <td><?php echo $status; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['do_number'])) : ?>
                <tr>
                    <td>DO Number :</td>
                    <td><?php echo $job_details['do_number']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['assigned_employee_job_type'])) : ?>
                <tr>
                    <td>Employee Job Type :</td>
                    <td><?php echo $job_details['assigned_employee_job_type']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['vehicle_number'])) : ?>
                <tr>
                    <td>Vehicle Number :</td>
                    <td><?php echo $job_details['vehicle_number']; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['cdate'])) : ?>
                <tr>
                    <td>Job Assigned Date & Time :</td>
                    <td><?php echo date('d-m-Y', strtotime($job_details['cdate'])) . " " . $job_details['ctime']; ?>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($estimated_completed_date)) : ?>
                <tr>
                    <td>Job Estimated Completion Time :</td>
                    <td><?php echo $estimated_completed_date; ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($job_details['job_description'])) : ?>
                <tr>
                    <td>Job Description :</td>
                    <td><?php echo $job_details['job_description']; ?></td>
                </tr>
                <?php endif; ?>

                </tr>
                <!-- Repeat similar rows for a total of 10 rows -->
            </tbody>
        </table>
        <?php if(!empty($job_images)) { ?>
        <h2>Document Images</h2>
        <?php foreach($job_images as $j_img) { ?>
        <div>
            <div class="image-details">
                <a href="<?php echo base_url('userfiles/job_clock_in_photos/'.$j_img['job_clock_in_photo']); ?>"
                    target="_blank">
                    <img src="<?php echo base_url('userfiles/job_clock_in_photos/'.$j_img['job_clock_in_photo']); ?>"
                        alt="Side Image">
                </a>
                <div class="location-details">
                    <p><?php echo $j_img['job_clock_in_location']; ?></p>
                    <!-- Add more location details as needed -->
                </div>
            </div>


        </div>
        <?php } } ?>

        <?php if(!empty($thread_info['signature'])){ ?>
        <h2>Customer Signature</h2>
        <div class="image-details">
            <img src="<?php echo $job_details['signature']; ?>" alt="Side Image">
        </div>
        <?php } ?>


        <!-- Repeat similar sections for additional rows of data and images -->
    </main>
</div>

<!-- Modal Footer -->
<div class="modal-footer">
    <a href="<?php echo base_url('jobsheets/job_sheet_profile_download/?id='.$job_details['id']); ?>"><button
            type="button" class="btn btn-secondary">Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>