<nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="javascript:void(0);" onclick="getParentFolders('')"><i class="fa fa-home"></i></a></li>
        <?php foreach ($breadcrumbs as $breadcrumb): ?>
        <?php if ($breadcrumb['entity_type'] == 'folder'): ?>
        <li class="breadcrumb-item"><a href="javascript:void(0);"  onclick="getParentFolders(<?php echo $breadcrumb['entity_id']; ?>)"><?php echo $breadcrumb['entity_name']; ?></a>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ol>
    
</nav>
<div id="fileInputCopy" style="">
    <select id="folder_heirarichy" class="form-control folder_heirarichy" name="folder_heirarichy">
        <option value="">Select Folder</option>
        <?php if(!empty($folders)) { foreach($folders as $folder){ ?>
        <option value="<?php echo $folder['entity_id']; ?>"><?php echo $folder['entity_name']; ?></option>
        <?php }} ?>
    </select>
</div>
<input type="hidden" name="parentId" id="parentId" value="<?php if(!empty($folder_id)) { echo $folder_id; }else{ echo NULL;} ?>" />