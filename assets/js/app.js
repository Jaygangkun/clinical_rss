$(document).ready(function(){

    // login page
    $(document).on('click', '#submit_login', function(){
        // if($('[name="email"]').val() == ''){
        //     alert('Please Input Email!');
        //     $('[name="email"]').focus();
        //     return;
        // }

        // if($('[name="password"]').val() == ''){
        //     alert('Please Input Password!');
        //     $('[name="password"]').focus();
        //     return;
        // }

        // $.ajax({
        //     url: base_url + 'admin_api/login',
        //     type: 'post',
        //     data: {
        //         'email' : $('[name="email"]').val(),
        //         'password' : $('[name="password"]').val()
        //     },
        //     success: function(resp){
        //         resp = JSON.parse(resp);
        //         if(resp.success){
        //             location.href = base_url + 'dashboard';
        //         }
        //         else{
        //             alert('Failed');
        //         }
        //     }
        // })
    })

    // register page
    $(document).on('click', '#submit_register', function(){
        // if($('[name="email"]').val() == ''){
        //     alert('Please Input Email!');
        //     $('[name="email"]').focus();
        //     return;
        // }

        // if($('[name="password"]').val() == ''){
        //     alert('Please Input Password!');
        //     $('[name="password"]').focus();
        //     return;
        // }

        // if($('[name="confirm_password"]').val() == ''){
        //     alert('Please Input Confirm Password!');
        //     $('[name="confirm_password"]').focus();
        //     return;
        // }

        // if($('[name="password"]').val() != $('[name="confirm_password"]').val()){
        //     alert('Please Input Same Confirm Password');
        //     $('[name="confirm_password"]').focus();
        //     return;
        // }

        // $.ajax({
        //     url: base_url + 'admin_api/register',
        //     type: 'post',
        //     data: {
        //         'username' : $('[name="username"]').val(),
        //         'first_name' : $('[name="first_name"]').val(),
        //         'last_name' : $('[name="last_name"]').val(),
        //         'email' : $('[name="email"]').val(),
        //         'password' : $('[name="password"]').val()
        //     },
        //     success: function(resp){
        //         resp = JSON.parse(resp);
        //         if(resp.success){
        //             location.href = base_url + 'login';
        //         }
        //         else{
        //             alert('Failed');
        //         }
        //     }
        // })
    })

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
            alert('Enter Report Title!');
            $('#title').focus();
            return;
        }

        if($('#conditions').val() == ''){
            alert('Enter a condition or disease (mandatory)');
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
                    alert('Success');
                    $('#report_list').append(resp.report);
                }
                else{
                    alert('Failed');
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
                    alert('Success');
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
                    alert('Failed');
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
            searchReport($(this).val(), $('#sort_btn').attr('sort'))
        }
    })

    // sort
    $(document).on('click', '#sort_btn', function(){
        var sort = $(this).attr('sort');
        if(sort == 'ASC'){
            sort = 'DESC';
        }
        else{
            sort = 'ASC';
        }

        $(this).attr('sort', sort);

        searchReport($('#report_search_input').val(), sort);
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
                    }
                    else if($(report_row).hasClass('status--reporting')){
                        // stop reporting
                        $(report_row).removeClass('status--reporting');
                        $(report_row).addClass('status--no-reporting');
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
                    alert('Success');
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
                    alert('Failed');
                }
                $(report_row).removeClass('loading');
                $(report_row).removeClass("show-popup");
            }
        })
    })

    $(document).on('click', '.report-list-action-popup-btn--delete', function(){
        if(confirm('Are you sure to delete?')){
            var report_row = $(this).parents('.report-list-row');
            var report_id = $(this).parents('.report-list-row').attr('report-id');

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
                        alert('Success');
                        $('.report-list-row[report-id="' + report_id + '"]').remove();
                    }
                    else{
                        alert('Failed');
                    }
                }
            })
        }
    })

    $(document).on('click', '.report-list-download-btn', function(){
        var report_id = $(this).parents('.report-list-row').attr('report-id');
        window.open(base_url + 'admin_api/rss_download?report_id=' + report_id);
    })
})