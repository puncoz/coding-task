<nav class="navbar navbar-default navbar-layout">
    <div class="container">
    
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url()?>" title="<?=$this->lang->line('software_acronym')?>">
                <span class="fa fa-home fa-2x"></span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?=($page_lvl_1=='client' ? 'active' : '')?>">
                    <a href="<?=site_url('client/lists')?>">
                        Clients
                    </a>
                </li>
            </ul>
        
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="https://www.facebook.com/puncoz" class="facebook" target="_blank"><span class="fa fa-facebook-official fa-2x"></span></a></li>
                <li class="active"><a href="https://np.linkedin.com/in/puncoz" class="linkedin" target="_blank"><span class="fa fa-linkedin-square fa-2x"></span></a></li>
                <li class="active"><a href="skype:puncoz?call" class="skype" target="_blank"><span class="fa fa-skype fa-2x"></span></a></li>
                <li class="active"><a href="https://www.twitter.com/PuncozNepal" class="twitter" target="_blank"><span class="fa fa-twitter-square fa-2x"></span></a></li>
                <li class="active"><a href="https://www.instagram.com/puncoz" class="instagram" target="_blank"><span class="fa fa-instagram fa-2x"></span></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
        
    </div><!-- /.container -->
</nav>