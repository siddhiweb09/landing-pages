<form action="submitLead.php" method="post" onsubmit="return disableButton()" class="formPanel p-3">
    <h6 class="text-yellow">Admission Open</h6>
    <h4 class="text-blue">Enroll Now for 2025-26</h4>
    <div class="row mt-3">
        <div class="form-group mb-2">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
        </div>
        <div class="form-group mb-2">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
        </div>
        <div class="form-group mb-2" style="display: flex;">
            <input type="text" maxlength="10" style="width: 100%;" id="mobile_code" class="form-control"
                placeholder="Phone Number" name="phone" autocomplete="off" required>
        </div>

        <div class="form-group col-12 col-lg-6 mb-2">
            <select class="form-control form-select state" id="state" name="state" required>
                <option value>Select State</option>
            </select>
        </div>
        <div class="form-group col-12 col-lg-6 mb-2">
            <select class="form-control form-select city" name="city" required>
                <option value>Select City</option>
            </select>
        </div>
        <div class="form-group mb-2">
            <select class="form-control form-select course" id="course" name="course" required>
                <option value="Master of Business Administration (MBA)">Master of Business Administration (MBA)</option>
                <option value="Other Courses">Other Courses</option>
            </select>
        </div>

        <input type="text" class="form-control" id="current_url" name="current_url"
            value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
            hidden>
        <?php
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query_params = [];
        parse_str(parse_url($current_url, PHP_URL_QUERY), $query_params);
        $utm_source = isset($query_params['gad_source']) ? htmlspecialchars($query_params['gad_source']) : '';
        $utm_medium = isset($query_params['gclid']) ? htmlspecialchars($query_params['gclid']) : '';
        $utm_campaign = isset($query_params['utm_campaign']) ? htmlspecialchars($query_params['utm_campaign']) : '';
        ?>
        <input type="text" name="utm_source" value="<?php echo base64_encode($utm_source); ?>" hidden>
        <input type="text" name="utm_medium" value="<?php echo base64_encode($utm_medium) ?>" hidden>
        <input type="text" name="utm_campaign" value="<?php echo $utm_campaign ?>" hidden>
        <input type="hidden" name="key1" id="key1" value="<?php echo base64_encode($clientIp) ?>" hidden>
        <select class="level" id="level" name="level" style="display: none;">
            <option value="none" selected>NA</option>
        </select>
        <input type="hidden" name="key" id="key" value="<?php echo base64_encode($key) ?>" hidden>
        <div class="form-check ms-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label declaration-text" for="flexCheckDefault" style="color: black;">
                By clicking on submit I allow ISBM University to call me & send program information on Email/Phone.
            </label>
        </div>
        <div class="form-group d-flex justify-content-center">
            <input type="submit" id="submitButton" name="submit" value="Submit" class="btn banner-button btn-og" />
        </div>
    </div>
</form>

<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="otpModalBody">
                <!-- Message will be inserted here -->
            </div>
        </div>
    </div>
</div>


<script>
    function disableButton() {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.value = "Submitting...";
        return true;
    }
</script>