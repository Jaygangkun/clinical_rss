<?php
if($report['updated_at'] != '' && $report['updated_at'] != null){
    $now = time();
    $updated_at = strtotime($report['updated_at']);

    $datediff = $now - $updated_at;
    $daysdiff = round($datediff / (60 * 60 * 24));

    if($daysdiff < 7){
        $status = 'recent';
        $status_str = 'Recent Updates';
    }
    else if($daysdiff < 31){
        $status = 'new';
        $status_str = 'New Updates';
    }
    else {
        $status = 'old';
        $status_str = 'Old Updates';
    }
    
}
else{
    $status = '';
    $status_str = 'No Updates';
}
?>
<div class="report-list-row <?php echo $status?>" report-id="<?php echo $report['id']?>">
    <div class="report-list-col-action">
        <div class="report-list-action-btn">
            <i class="material-icons">more_vert</i>
        </div>
        <div class="report-list-action-popup">
            <div class="report-list-action-popup-btn report-list-action-popup-btn--reporting <?php echo $report['reporting'] == '1' ? 'status--reporting' : 'status--no-reporting'?>">
                <i class="material-icons">check_circle</i>
                <span class="report-list-action-popup-btn__text start">Start Reporting</span>
                <span class="report-list-action-popup-btn__text stop">Stop Reporting</span>
            </div>
            <div class="report-list-action-popup-btn report-list-action-popup-btn--duplicate">
                <i class="material-icons">file_copy</i>
                <span class="report-list-action-popup-btn__text">Duplicate</span>
            </div>
            <div class="report-list-action-popup-btn report-list-action-popup-btn--delete">
                <i class="material-icons">delete</i>
                <span class="report-list-action-popup-btn__text">Delete</span>
            </div>
        </div>
    </div>
    <div class="report-list-col-status">
        <div class="report-list-col-status-wrap">
            <?php echo $status_str?>
        </div>
    </div>
    <div class="report-list-col-info">
        <div class="report-list-col-info-wrap">
            <div class="report-list-col-info-row">
                <div class="report-list-col-info-col-50">
                    <div class="report-list-info-col-wrap">
                        <div class="report-list-info-input-wrap">
                            <input type="text" class="report-list-info-input" name="title" value="<?php echo $report['title']?>" disabled1>
                            <i class="material-icons report-list-info-edit-btn">edit</i>
                        </div>
                    </div>
                </div>
                <div class="report-list-col-info-col-50">
                    <div class="report-list-info-col-wrap fs-small">
                        <div class="report-list-info-title">Condition or disease</div>
                        <div class="report-list-info-input-wrap">
                            <input type="text" class="report-list-info-input" name="conditions" value="<?php echo $report['conditions']?>" disabled1>
                            <i class="material-icons report-list-info-edit-btn">edit</i>
                        </div>
                    </div>									
                </div>
            </div>
            <div class="report-list-col-info-row">
                <div class="report-list-col-info-col-50">
                    <div class="report-list-col-info-col-50">
                        <div class="report-list-info-col-wrap fs-small">
                            <div class="report-list-info-input-wrap">
                                <select class="report-list-info-input" name="study" disabled1>
                                    <?php
                                    if(isset($studies)){
                                        foreach($studies as $study){
                                            ?>
                                            <option value="<?php echo $study['value']?>" <?php echo $report['study'] == $study['value'] ? 'selected' : '' ?>><?php echo $study['text']?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <i class="material-icons report-list-info-edit-btn">edit</i>
                            </div>
                        </div>
                    </div>
                    <div class="report-list-col-info-col-50">
                        <div class="report-list-info-col-wrap fs-small">
                            <div class="report-list-info-input-wrap">
                                <select class="report-list-info-input" name="country" disabled1>
                                    <?php
                                    if(isset($countries)){
                                        foreach($countries as $country){
                                            ?>
                                            <option value="<?php echo $country['value']?>" <?php echo $report['country'] == $country['value'] ? 'selected' : '' ?>><?php echo $country['text']?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <i class="material-icons report-list-info-edit-btn">edit</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="report-list-col-info-col-50">
                    <div class="report-list-info-col-wrap fs-small">
                        <div class="report-list-info-title">Search terms</div>
                        <div class="report-list-info-input-wrap">
                            <input type="text" class="report-list-info-input" name="terms" value="<?php echo $report['terms']?>" disabled1>
                            <i class="material-icons report-list-info-edit-btn">edit</i>
                        </div>
                    </div>									
                </div>
            </div>
        </div>
    </div>
    <div class="report-list-col-btn">
        <div class="report-list-download-btn">
            Download PDF
            <div class="report-list-download-btn__icon-wrap"><i class="material-icons">file_download</i></div>
        </div>
    </div>
    <div class="report-list-row-loading">
        <div class="loader"></div>
    </div>
</div>