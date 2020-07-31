<?php
    $title = $staffInfo['title'] ? $staffInfo['title'] : '';
    $content = $staffInfo['content'] ? $staffInfo['content'] : '';
?>
<div class="row">
    <div class="col-lg-12">
        <p><strong>title: </strong><?php print $title?></p>
        <p><strong>content: </strong><?php print $content?></p>
    </div>
</div><!-- /.row -->
