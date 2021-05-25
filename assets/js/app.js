const ALERT_SUCCESS = 'success';
const ALERT_FAIL = 'fail';
const ALERT_NORMAL = 'normal';

$(document).ready(function(){

    // dashboard page
    $(document).on('click', '.report-list-row', function(){
        $('.report-list-row').removeClass('active');
        $(this).addClass('active');
    })

    // report dropdown menu hide
    document.addEventListener('click', e => {
        let clickedOutside = true;

        e.path.forEach(item => {
            if (!clickedOutside)
                return;

            if (item.className === 'report-list-action-popup' || item.className === 'report-list-action-btn')
                clickedOutside = false;
        });

        if (clickedOutside){
            // Make an action if it's clicked outside..
            $('.report-list-row').removeClass('show-popup');    
        }
            
    });

    // report dropdown show
    $(document).on('click', '.report-list-action-btn', function(){
        $('.report-list-row').removeClass('show-popup');
        $(this).parents('.report-list-row').addClass('show-popup');
    })

    // add button
    $(document).on('click', '#report_add_btn', function(){

        if($('#title').val() == ''){
            showAlert("<div class='message-box'>Enter Report Title</div>");
            $('#title').focus();
            return;
        }

        if($('#conditions').val() == ''){
            showAlert("<div class='message-box'>Enter a condition or disease (mandatory)</div>");
            $('#conditions').focus();
            return;
        }

        $.ajax({
            url: base_url + 'admin_api/report_add',
            type: 'post',
            data: {
                'title' : $('#title').val(),
                'conditions' : $('#conditions').val(),
                'study' : $('#study').val(),
                'country' : $('#country').val(),
                'terms' : $('#terms').val()
            },
            success: function(resp){
                resp = JSON.parse(resp);
                if(resp.success){
                    showAlert("<div class='message-box'><b>" + $('#title').val() + "</b> was successfully added to the list</div>", ALERT_SUCCESS);
                    $('#report_list').append(resp.report);
                    $('.report-add-area').removeClass('report-add-area--expand');
                }
                else{
                    showAlert("<div class='message-box'><b>" + $('#title').val() + "</b> was failed to add to the list</div>", ALERT_FAIL);
                }
            }
        })
    })

    $(document).on('click', '.report-list-info-edit-btn', function(){
        $(this).parent().find('input').removeAttr('disabled');
        $(this).parent().find('select').removeAttr('disabled');
    })

    function updateReport(report_id){
        var report_row = $('.report-list-row[report-id="' + report_id + '"]');        
        $(report_row).addClass('loading');
        $.ajax({
            url: base_url + 'admin_api/report_update',
            type: 'post',
            data: {
                'id' : report_id,
                'title' : $(report_row).find('[name="title"]').val(),
                'conditions' : $(report_row).find('[name="conditions"]').val(),
                'study' : $(report_row).find('[name="study"]').val(),
                'country' : $(report_row).find('[name="country"]').val(),
                'terms' : $(report_row).find('[name="terms"]').val()
            },
            success: function(resp){
                resp = JSON.parse(resp);
                if(resp.success){
                    showAlert("<div class='message-box'>Success</div>", ALERT_SUCCESS);
                    // updating status
                    $(report_row).removeClass('status--no');
                    $(report_row).removeClass('status--new');
                    $(report_row).removeClass('status--recent');
                    $(report_row).removeClass('status--old');
                    $(report_row).addClass("status--" + resp.status);

                    $(report_row).find('.report-list-col-status-wrap__title').text(resp.status_str.title);
                    $(report_row).find('.report-list-col-status-wrap__date').text(resp.status_str.date);
                }
                else{
                    showAlert("<div class='message-box'>Failed</div>", ALERT_FAIL);
                }

                $(report_row).removeClass('loading');
            }
        })
    }

    $(document).on('keypress', '.report-list-row input', function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            updateReport($(this).parents('.report-list-row').attr('report-id'));
        }
    })

    $(document).on('change', '.report-list-row select', function(event){
        updateReport($(this).parents('.report-list-row').attr('report-id'));
    })

    // search input
    function searchReport(keyword, sort){
        $.ajax({
            url: base_url + 'admin_api/report_search',
            type: 'post',
            data: {
                keyword: keyword,
                sort: sort
            },
            success: function(resp){
                resp = JSON.parse(resp);
                if(resp.success){
                    $('#report_list').html(resp.reports);
                }
                else{
                    $('#report_list').html('');
                }
            }
        })
    }

    $(document).on('keypress', '#report_search_input', function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            searchReport($(this).val(), $('#sort').val())
        }
    })

    // sort
    $(document).on('change', '#sort', function(){
        searchReport($('#report_search_input').val(), $(this).val());
    })
    
    // action popup buttons
    $(document).on('click', '.report-list-action-popup-btn--reporting', function(){
        var reporting = 1;
        var report_row = $(this).parents('.report-list-row');
        var report_id = $(this).parents('.report-list-row').attr('report-id');
        var instance = this;
        if($(report_row).hasClass('status--no-reporting')){
            // start reporting
            reporting = 1;
        }
        else if($(report_row).hasClass('status--reporting')){
            // stop reporting
            reporting = 0;
        }
        
        $(report_row).addClass('loading');
        $.ajax({
            url: base_url + 'admin_api/report_reporting',
            type: 'post',
            data: {
                'id' : report_id,
                reporting: reporting
            },
            success: function(resp){
                resp = JSON.parse(resp);
                if(resp.success){
                 
                    if($(report_row).hasClass('status--no-reporting')){
                        // start reporting
                        $(report_row).removeClass('status--no-reporting');
                        $(report_row).addClass('status--reporting');

                        showAlert("<div class='message-box'>Reporting Started!</div>", ALERT_SUCCESS);
                    }
                    else if($(report_row).hasClass('status--reporting')){
                        // stop reporting
                        $(report_row).removeClass('status--reporting');
                        $(report_row).addClass('status--no-reporting');

                        showAlert("<div class='message-box'>Reporting Stoped!</div>", ALERT_SUCCESS);
                    }

                    // updating status
                    $(report_row).removeClass('status--no');
                    $(report_row).removeClass('status--new');
                    $(report_row).removeClass('status--recent');
                    $(report_row).removeClass('status--old');
                    $(report_row).addClass("status--" + resp.status);
                    $(report_row).removeClass('show-popup');

                    $(report_row).find('.report-list-col-status-wrap__title').text(resp.status_str['title']);
                    $(report_row).find('.report-list-col-status-wrap__date').text(resp.status_str['date']);
                }

                $(report_row).removeClass('loading');
            }
        })
    })

    $(document).on('click', '.report-list-action-popup-btn--duplicate', function(){
        var report_row = $(this).parents('.report-list-row');
        var report_id = $(this).parents('.report-list-row').attr('report-id');

        $(report_row).addClass('loading');
        $.ajax({
            url: base_url + 'admin_api/report_duplicate',
            type: 'post',
            data: {
                'id' : report_id,
            },
            success: function(resp){
                resp = JSON.parse(resp);
                if(resp.success){
                    showAlert("<div class='message-box'>Success</div>", ALERT_SUCCESS);
                    // var new_report = $('.report-list-row[report-id="' + report_id + '"]').clone();
                    // $(new_report).attr('report-id', resp.report_id);

                    // $(new_report).removeClass('active');
                    // // $(new_report).removeClass('new');
                    // // $(new_report).removeClass('recent');
                    // $(new_report).removeClass('show-popup');
                    // $(new_report).removeClass('loading');

                    $('.report-list-row[report-id="' + report_id + '"]').after(resp.report);
                    // $('#report_list').append(resp.report);

                }
                else{
                    showAlert("<div class='message-box'>Fail</div>", ALERT_FAIL);
                }
                $(report_row).removeClass('loading');
                $(report_row).removeClass("show-popup");
            }
        })
    })

    $(document).on('click', '.report-list-action-popup-btn--delete', function(){
        var instance = this;

        showConfirm({
            title: 'Are you sure to delete?',
            text: '',
            confirmButtonText: 'Yes, delete it!'
        }, function(){
            var report_row = $(instance).parents('.report-list-row');
            var report_id = $(instance).parents('.report-list-row').attr('report-id');

            $(report_row).addClass('loading');
            $.ajax({
                url: base_url + 'admin_api/report_delete',
                type: 'post',
                data: {
                    'id' : report_id,
                },
                success: function(resp){
                    resp = JSON.parse(resp);
                    $(report_row).removeClass('loading');
                    if(resp.success){
                        swal("Deleted!", "The Report has been deleted.", "success");
                        $('.report-list-row[report-id="' + report_id + '"]').remove();
                    }
                    else{
                        swal("Failed to Delete!", "The Report has been deleted.", "fail");
                    }
                }
            })
        })
    })

    $(document).on('click', '.report-list-download-btn', function(){
        var report_id = $(this).parents('.report-list-row').attr('report-id');
        window.open(base_url + 'admin_api/rss_download?report_id=' + report_id);
    })

    $(document).on('click', '#title', function(event){
        $(this).parents('.report-add-area').addClass('report-add-area--expand');
        event.stopPropagation();
        event.preventDefault();
        console.log('title');
    })

    $(document).on('click', '.report-add-area', function(event){
        console.log('report-add-area:', event.target.className);
        if(event.target.className != 'report-input' && event.target.className != 'btn-main'){
            $(this).removeClass('report-add-area--expand');
        }
    })

    function showAlert(text, type=ALERT_NORMAL){
        if($('.sweet-overlay').length > 0){
            $('.sweet-overlay').addClass('hide');
        }
        
        let customClass = 'custom-alert';

        if(type == ALERT_SUCCESS){
            customClass = 'custom-alert success-alert';
        }
        else if(type == ALERT_FAIL){
            customClass = 'custom-alert fail-alert';
        }
        
        swal({
            title: "",
            text: text,
            timer: 2000,
            html: true,
            showConfirmButton: false,
            animation: "slide-from-top",
            animation: "slide-from-top",
            toast: true,
            position: 'top',
            customClass: customClass,
            showCloseButton: true
        });
    }

    function showConfirm(config, cbConfirm){
        if($('.sweet-overlay').length > 0){
            $('.sweet-overlay').removeClass('hide');
        }

        swal({
            title: config.title,
            text: config.text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: config.confirmButtonText,
            closeOnConfirm: false
        }, function () {
            cbConfirm();
        });
    }


    // users page
    $(document).on('click', '.btn-user-delete', function(){
        var instance = this;
        showConfirm({
            title: 'Are you sure to delete?',
            text: '',
            confirmButtonText: 'Yes, delete it!'
        }, function(){
            var user_id = $(instance).attr('user-id');

            $.ajax({
                url: base_url + 'admin_api/user_delete',
                type: 'post',
                data: {
                    'user_id' : user_id,
                },
                success: function(resp){
                    resp = JSON.parse(resp);
                    if(resp.success){
                        swal("Deleted!", "The User has been deleted.", "success");
                    }
                    else{
                        swal("Failed to Delete!", "The Report has been deleted.", "fail");
                    }
                }
            })
        })      
    })
})