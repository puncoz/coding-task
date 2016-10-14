<script src="<?=assets('bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?=assets('bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>

<script type="text/javascript">
    // Config
    var base_url = "<?=base_url()?>";
    var current_url = "<?=current_url()?>";
    var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
    var csrf_token = "<?=$this->security->get_csrf_hash()?>";
    var pageTitle = $(document).find("title").text();

    // message for notification
    var isGritterLight = false;
    var gritterPosition = 'bottom-right'; // possibilities: bottom-left, bottom-right, top-left, top-right, center
    var success_msg = "<?=$this->session->flashdata('success_notify')?>";
    var error_msg = "<?=$this->session->flashdata('error_notify')?>";
    var info_msg = "<?=$this->session->flashdata('info_notify')?>";
    var warning_msg = "<?=$this->session->flashdata('warning_notify')?>";
</script>