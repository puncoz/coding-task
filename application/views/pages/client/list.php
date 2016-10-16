<div style="margin-bottom: 10px;">
    
    <!-- MESSAGE -->
    <?php
    $success_msg = $this->session->flashdata('success_msg');
    $warning_msg = $this->session->flashdata('warning_msg');
    $info_msg = $this->session->flashdata('info_msg');
    $error_msg = $this->session->flashdata('error_msg');

    $msg_type = (
            (!is_null($success_msg)) ? 'success' : (
                (!is_null($warning_msg)) ? 'warning' : (
                    (!is_null($info_msg)) ? 'info' : (
                        (!is_null($error_msg)) ? 'danger' : ''
                    )
                )
            )
        );
    ?>
    <?php if ($msg_type == 'success'): ?>
        <div class="pull-left alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <?=$success_msg?>
        </div>
    <?php elseif ($msg_type == 'warning'): ?>
        <div class="pull-left alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> <?=$warning_msg?>
        </div>
    <?php elseif ($msg_type == 'info'): ?>
        <div class="pull-left alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Info!</strong> <?=$info_msg?>
        </div>
    <?php elseif ($msg_type == 'danger'): ?>
        <div class="pull-left alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> <?=$error_msg?>
        </div>
    <?php endif ?>
    
    <a href="<?=site_url('client/add')?>" class="btn btn-success tooltip-success pull-right loadForm" 
        data-toggle="tooltip" data-placement="top" title="Add client"
        data-popupbtnlabel="Add" data-popuptitle="Add New Client" data-popupclass="dialog-60">
        <span class="fa fa-user-plus"></span>
    </a>    
    
    <div class="clearfix"></div>
</div>

<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Nationality</th>
            <th>DoB</th>
            <th>Education</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $cnt = $start; foreach ($clients as $id => $client): ?>
            <tr>
                <td><?=++$cnt?></td>
                <td><?=$client[0]?></td>
                <td><?=$client[1]?></td>
                <td>
                    <span style="font-weight: <?=$client[4] == 'Phone' ? 'bold' : 'normal'?>">Phone: <?=$client[2]?> <i class="fa fa-<?=$client[4] == 'Phone' ? 'check' : ''?>"></i></span><br>
                    <span style="font-weight: <?=$client[4] == 'Email' ? 'bold' : 'normal'?>">Email: <?=$client[3]?> <i class="fa fa-<?=$client[4] == 'Email' ? 'check' : ''?>"></i></span>
                </td>
                <td><?=$client[5]?></td>
                <td><?=$client[6]?></td>
                <td><?=$client[7]?></td>
                <td><?=$client[8]?></td>
                <td>
                    <a href="<?=site_url('client/edit/'.url_encrypt($id))?>" class="btn btn-xs btn-info tooltip-info loadForm" 
                        data-toggle="tooltip" data-placement="top" title="edit"
                        data-popupbtnlabel="Update" data-popuptitle="Update Client" data-popupclass="dialog-60">
                        <span class="fa fa-edit"></span>
                    </a>
                    <a href="<?=site_url('client/delete/'.url_encrypt($id))?>" class="btn btn-xs btn-danger tooltip-danger bootbox-confirm" 
                        data-toggle="tooltip" data-placement="top" title="delete"
                        data-msg="Are you sure? You cannot undo once confirmed.">
                        <span class="fa fa-remove"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        if ($cnt == 0): ?>
            <tr>
                <td colspan="9">No records found!</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <?=(isset($pagination) ? $pagination : '')?>
</nav>