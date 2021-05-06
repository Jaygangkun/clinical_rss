$(document).ready(function(){
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
                }
                else{
                    alert('Failed');
                }
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
})