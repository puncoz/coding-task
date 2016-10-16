<!--
// BASIC SITES INFO
-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?=$pageInfo->title.' || '.$this->lang->line('software_acronym') ?></title>

<?php
$metaData = [
            [
                'name'      => 'robots',
                'content'   => 'index, follow',
            ],
            [
                'name'      => 'keywords',
                'content'   => $this->lang->line('software_acronym'),
            ],
            [
                'name'      => 'description',
                'content'   => $this->lang->line('software_name'),
            ],
            [
                'name'      => 'application-name',
                'content'   => str_replace(' ', '-', strtolower($this->lang->line('software_acronym'))),
            ],
            [
                'name'      => 'author',
                'content'   => $this->lang->line('software_author'),
            ],
        ];
echo meta($metaData);
?>