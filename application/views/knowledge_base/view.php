<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h3><?php  echo $title; ?></h3>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="card-content">

            <div class="card-body">
                <?php if (!empty($web_url)): ?>
                <iframe src="<?= $web_url; ?>" width="100%" height="786px" frameborder="0"></iframe>
                <?php else: ?>
                <p>No URL provided.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>