<?php
    // PHP variables
    $viewData = [];

    $viewData['page_lvl_1'] = $page_lvl_1 = ($this->uri->segment(1) == '') ? 'home' : $this->uri->segment(1);
    $viewData['page_lvl_2'] = $page_lvl_2 = $this->uri->segment(2);
    $viewData['page_lvl_3'] = $page_lvl_3 = $this->uri->segment(3);
?>
<?php $this->load->view(TMPL.'/partials/layout.htmlhead.php', $viewData) ?>
<body>

    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <noscript>
        <p class="alert alert-danger">JavaScript disabled or your browser doesn't support javascript. Please enable it or <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    </noscript>

    <!-- Navigation -->
    <?php $this->load->view(TMPL.'/partials/layout.navigation.php', $viewData) ?>

    <!-- Main Wrapper -->
    <section id="content">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?=$main_body_content?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php $this->load->view(TMPL.'/partials/layout.footer.php', $viewData) ?>

    <!--
    // SCRIPTS
    -->
    <?php $this->load->view(TMPL.'/partials/scripts/layout.scripts.php', $viewData) ?>
    
</body>
</html>