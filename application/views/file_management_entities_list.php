<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div>
            </div>
            <div class="card-body">
                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contents as $content): ?>
                        <tr>
                            <td>
                                <?php if ($content['entity_type'] == 'folder'): ?>
                                <a
                                    href="<?php echo base_url('FileController/list_contents/'.$content['entity_id']); ?>"><?php echo $content['entity_name']; ?></a>
                                <?php else: ?>
                                <?php echo $content['entity_name']; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo ucfirst($content['entity_type']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>