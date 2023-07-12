<style>
  td.inline-actions a {
    display: inline-grid;
    padding: 5px 7px;
    font-size: 16px;
    margin: 2px;
}
 .custom-control-label::after {
    position: relative;
    }
  </style>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
            <?php if(!empty($message)){ ?>
            <div class="card-body">
                <!-- Notification -->
                <div class="alert"><?php echo $message; ?></div>
            </div>
            <?php } ?>
            <div id='filemanager' class="card-body">
                    <?php echo $form; ?>
                </div>
        </div>
    </div>
</div>

