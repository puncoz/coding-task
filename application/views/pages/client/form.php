<div class="row">
    <div class="col-xs-12">

        <?php
        $attributes = array(
                        'class' => 'form-horizontal',
                        'role'  => 'form',
                        'name'  => 'add_edit_form',
                        'id'    => 'add_edit_form'
                    );
        $action = site_url('client/'.(isset($edit) ? 'edit/'.url_encrypt($id) : 'add'));
        echo form_open($action, $attributes);
        ?>

        <p><strong>All fields are required.</strong></p>
        <div class="row">
            <div class="col-sm-6">
                
                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="NAME">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" name="NAME" id="NAME" value="<?=(isset($edit) ? $edit[0] : '')?>">
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="GENDER">Gender:</label>
                    <div class="col-sm-9">
                        <select class="form-control select-chosen required" name="GENDER" id="GENDER" data-placeholder="SELECT">
                            <option value=""></option>
                            <option value="Male" <?=(isset($edit)&&$edit[1]=='Male'?'selected':'')?>>Male</option>
                            <option value="Female" <?=(isset($edit)&&$edit[1]=='Female'?'selected':'')?>>Female</option>
                        </select>
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="PHONE">Phone:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" name="PHONE" id="PHONE" value="<?=(isset($edit) ? $edit[2] : '')?>">
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="EMAIL">Email:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control email required" name="EMAIL" id="EMAIL" value="<?=(isset($edit) ? $edit[3] : '')?>">
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="DEF_CONTACT">Default Contact:</label>
                    <div class="col-sm-9">
                        <select class="form-control select-chosen required" name="DEF_CONTACT" id="DEF_CONTACT" data-placeholder="SELECT">
                            <option value=""></option>
                            <option value="Phone" <?=(isset($edit)&&$edit[4]=='Phone'?'selected':'')?>>Phone</option>
                            <option value="Email" <?=(isset($edit)&&$edit[4]=='Email'?'selected':'')?>>Email</option>
                            <option value="None" <?=(isset($edit)&&$edit[4]=='None'?'selected':'')?>>None</option>
                        </select>
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

            </div>

            <div class="col-sm-6">

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="ADDRESS">Address:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control required" name="ADDRESS" id="ADDRESS"><?=(isset($edit) ? $edit[5] : '')?></textarea>
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="NATIONALITY">Nationality:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control required" name="NATIONALITY" id="NATIONALITY" value="<?=(isset($edit) ? $edit[6] : '')?>">
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="DOB">DoB:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control datepicker required" name="DOB" id="DOB" value="<?=(isset($edit) ? $edit[7] : '')?>" readonly="">
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label" for="EDUCATION">Education:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control required" name="EDUCATION" id="EDUCATION"><?=(isset($edit) ? $edit[8] : '')?></textarea>
                        <span class="form-msg" style="display: none"></span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

            </div>
        </div>

        <?php echo form_close() ?>
    </div>
</div>

<script type="text/javascript">
    
$(document).ready(function() {

    $('.select-chosen').chosen();
    $(document).find('.chosen-container').each(function(){
        $(this).find('.chosen-single').parent().css('width' , '100%');
        $(this).find('.chosen-choices').parent().css('width' , '100%');
    });

    $(".datepicker").datepicker({
        autoclose: true,
        clearBtn: true,
        todayBtn: false,
        format: "yyyy-mm-dd",
        todayHighlight: false,
        startView: 2
    });

});

</script>