<?php
    $id = $staffInfo['id'] ? $staffInfo['id'] : '';
    $title = $staffInfo['title'] ? $staffInfo['title'] : '';
    $content = $staffInfo['content'] ? $staffInfo['content'] : '';
?>
<input type="hidden" name="staff_id" value="<?php print $id; ?>">
<div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="title" class="form-control input-staff-firsttitle" id="title" placeholder="title" value="<?php print $title; ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="content" class="form-control input-staff-content" id="content" placeholder="content" value="<?php print $content; ?>">
            </div>
        </div>
    </div>
