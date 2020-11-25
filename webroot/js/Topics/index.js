// Update the topics data list
function getTopics() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
                function (data) {
                    var topicTable = $('#topicData');
                    topicTable.empty();
                    $.each(data.topics, function (key, value)
                    {
                        var editDeleteButtons = '</td><td>' +
                                '<a href="javascript:void(0);" class="btn btn-warning" rowID="' +
                                    value.id + 
                                    '" data-type="edit" data-toggle="modal" data-target="#modalTopicAddEdit">' + 
                                    'edit</a>' +
                                '<a href="javascript:void(0);" class="btn btn-danger"' +
                                    'onclick="return confirm(\'Are you sure to delete data?\') ?' + 
                                    'topicAction(\'delete\', \'' + 
                                    value.id + 
                                    '\') : false;">delete</a>' +
                                '</td></tr>';
                        topicTable.append('<tr><td>' + value.id + '</td><td>' + value.nom + '</td><td>' + value.code + editDeleteButtons);
 
                    });

                }

    });
}

 /* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}


function topicAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var topicData = '';
    var ajaxUrl = urlToRestApi;
    frmElement = $("#modalTopicAddEdit");
    if (type == 'add') {
        requestType = 'POST';
        topicData = convertFormToJSON(frmElement.find('form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        ajaxUrl = ajaxUrl + "/" + id;
        topicData = convertFormToJSON(frmElement.find('form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    frmElement.find('.statusMsg').html('');
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(topicData),
        success: function (msg) {
            if (msg) {
                frmElement.find('.statusMsg').html('<p class="alert alert-success">Topic data has been ' + statusArr[type] + ' successfully.</p>');
                getTopics();
                if (type == 'add') {
                    frmElement.find('form')[0].reset();
                }
            } else {
                frmElement.find('.statusMsg').html('<p class="alert alert-danger">Some problem occurred, please try again.</p>');
            }
        }
    });
}

// Fill the topic's data in the edit form
function editTopic(id) {
    $.ajax({
        type: 'GET',
        url: urlToRestApi + "/" +id,
        dataType: 'JSON',
       // data: 'action_type=data&id=' + id,
        success: function (data) {
            $('#id').val(data.topic.id);
            $('#nom').val(data.topic.nom);
            $('#code').val(data.topic.code);
            
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
            var rowId = $(e.relatedTarget).attr('rowID');
            topicFunc = "topicAction('edit',"+ rowId + ");";
            $('.modal-title').html('Edit topic');
            
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