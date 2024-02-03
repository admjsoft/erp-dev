<div class=" ">
    <div class="card card-block ">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card card-block ">

            <!-- form method="post" id="data_form"  -->
            <div class="card-body">

                <h5><?php echo $this->lang->line('Attendance Clock In') ?></h5>
                <hr>


                <div class="form-group row">

                    <label class="col-sm-4 control-label" for="from"><?php echo $this->lang->line('Capture Image') ?>
                        <span style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <video id="video" width="100%" height="320" autoplay></video>
                        <button class="btn btn-sm btn-info " id="captureButton">Capture Image</button>
                        <canvas id="canvas" width="480" height="320" style="display:none;"></canvas>
                        <img id="capturedImage" style="display:none;">
                        <button class="btn btn-sm btn-info mt-2" id="retakeButton" style="display:none;">Retake</button>
                        <!-- <button id="uploadButton" style="display:none;">Upload Image</button> -->

                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="todate"><?php echo $this->lang->line('Capture Location') ?>
                        <span style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <div class="input-group bootstrap-timepicker timepicker">
                            <p id="location" style="display:none;"></p>

                            <button class="btn btn-sm btn-info mt-2" id="getLocationButton" style="display:none;">Get
                                Location Details</button>
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="button" id="uploadButton" class="btn btn-success margin-bottom"
                            value="<?php  echo $this->lang->line('Clock In');   ?>" data-loading-text="Adding...">
                        <input type="hidden" value="employee/attendance_settings" id="action-url">
                        <input type="hidden" value="" name="att_sett_id" id="att_sett_id"
                            value="<?php if(!empty($settings['id'])){ echo $settings['id']; } ?>" />
                        <input type="hidden" id="latitudeInput" name="latitudeInput">
                        <input type="hidden" id="longitudeInput" name="longitudeInput">
                        <input type="hidden" id="locationDetailsInput" name="locationDetailsInput">

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const capturedImage = document.getElementById('capturedImage');
    const captureButton = document.getElementById('captureButton');
    // const getLocationButton = document.getElementById('getLocationButton');
    const retakeButton = document.getElementById('retakeButton');
    const uploadButton = document.getElementById('uploadButton');
    const locationElement = document.getElementById('location');

    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((error) => {
            console.error('Error accessing camera:', error);
        });

    captureButton.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        capturedImage.src = canvas.toDataURL('image/png');

        // Hide the camera and capture button
        video.style.display = 'none';
        captureButton.style.display = 'none';

        // Show the captured image and buttons
        capturedImage.style.display = 'block';
        retakeButton.style.display = 'inline-block';
        // getLocationButton.style.display = 'inline-block';
        uploadButton.style.display = 'inline-block';
    });

    const getLocation = () => {
        // Get and display the user's location details
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Use the Google Maps Geocoding API to get address details
                const apiKey =
                    'AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4'; // Replace with your API key
                const geocodingUrl =
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

                fetch(geocodingUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'OK' && data.results.length > 0) {
                            const address = data.results[1].formatted_address;
                            if(address == '')
                            {
                            const address = data.results[0].formatted_address;
                            }
                            locationElement.textContent = `Location: ${address}`;
                            locationElement.style.display = 'block';

                            // Set the values of hidden input fields
                            latitudeInput.value = latitude;
                            longitudeInput.value = longitude;
                            locationDetailsInput.value = address;
                            
                        $('#getLocationButton').hide();

                        } else {
                            console.error('Error fetching location details:', data.status);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location details:', error);
                    });
            }, (error) => {
                console.error('Error getting location:', error);
            });
        } else {
            locationElement.textContent = 'Geolocation is not supported by your browser.';
        }
    };

    // Call getLocation when the page loads
    getLocation();

    retakeButton.addEventListener('click', () => {
        // Show the camera and capture button
        video.style.display = 'block';
        captureButton.style.display = 'inline-block';

        // Hide the captured image, buttons, and location
        capturedImage.style.display = 'none';
        retakeButton.style.display = 'none';
        // getLocationButton.style.display = 'none';
        uploadButton.style.display = 'none';
        locationElement.style.display = 'none';
    });

    uploadButton.addEventListener('click', () => {
        const imageData = capturedImage.src;
        var latitude_details = $('#latitudeInput').val();
        var longitude_details = $('#longitudeInput').val();
        var Location_details = $('#locationDetailsInput').val();

        if (latitude_details != '' && longitude_details != '' && Location_details != '') {

            if (imageData != '') {

                const formData = new FormData();
                formData.append('image', imageData);
                formData.append('latitude_details', latitude_details);
                formData.append('longitude_details', longitude_details);
                formData.append('Location_details', Location_details);

                fetch('<?php echo base_url('dashboard/clock_in'); ?>', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log('Image uploaded successfully:', data);
                        if (data.success) {
                            // Redirect to the success page
                            window.location.href = data.redirect_url;
                        } else {
                            // Display validation errors
                            $('#validation_errors').html(data.validation_errors).show();
                        }
                    })
                    .catch(error => {
                        console.error('Error uploading image:', error);
                    });
            } else {

                alert('Please Capture Photo');
                // getLocation();
            }

        } else {

            alert('Please allow location Details');
            $('#getLocationButton').show();
            // getLocation();
        }
    });


    $('#getLocationButton').click(function() {
    getLocation();
});

});



</script>