
// Update the users data list
function getTopics() {
    $.ajax({
        type: 'POST',
        url: 'topicAction.php',
        data: 'action_type=view',
        success: function (html) {
            $('#topicData').html(html);
        }
    });
}

// Send CRUD requests to the server-side script
function topicAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var topicData = '', frmElement = '';
    if (type == 'add') {
        frmElement = $("#modalTopicAddEdit");
        topicData = frmElement.find('form').serialize() + '&action_type=' + type;
    } else if (type == 'edit') {
        frmElement = $("#modalTopicAddEdit");
        topicData = frmElement.find('form').serialize() + '&action_type=' + type;
    } else {
        frmElement = $(".row");
        topicData = 'action_type=' + type + '&id=' + id;
    }
    frmElement.find('.statusMsg').html('');
    $.ajax({
        type: 'POST',
        url: 'topicAction.php',
        dataType: 'JSON',
        data: topicData,
        beforeSend: function () {
            frmElement.find('form').css("opacity", "0.5");
        },
        success: function (resp) {
            frmElement.find('.statusMsg').html(resp.msg);
            if (resp.status == 1) {
                if (type == 'add') {
                    frmElement.find('form')[0].reset();
                }
                getTopics();
            }
            frmElement.find('form').css("opacity", "");
        }
    });
}

// Fill the user's data in the edit form
function editTopic(id) {
    $.ajax({
        type: 'POST',
        url: 'topicAction.php',
        dataType: 'JSON',
        data: 'action_type=data&id=' + id,
        success: function (data) {
            $('#id').val(data.id);
            $('#nom').val(data.nom);
            $('#code').val(data.code);
            
        }
    });
}

// Actions on modal show and hidden events
$(function () {
    $('#modalTopicAddEdit').on('show.bs.modal', function (e) {
        var type = $(e.relatedTarget).attr('data-type');
        var topicFunc = "topicAction('add');";
        $('.modal-title').html('Add new topic');
        if (type == 'edit') {
            topicFunc = "topicAction('edit');";
            $('.modal-title').html('Edit topic');
            var rowId = $(e.relatedTarget).attr('rowID');
            editTopic(rowId);
        }
        $('#topicSubmit').attr("onclick", topicFunc);
    });

    $('#modalTopicAddEdit').on('hidden.bs.modal', function () {
        $('#topicSubmit').attr("onclick", "");
        $(this).find('form')[0].reset();
        $(this).find('.statusMsg').html('');
    });
});



