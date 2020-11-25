$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#topic-id').on('change', function () {
        var topicId = $(this).val();
        if (topicId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'topic_id=' + topicId,
                success: function (restaurants) {
                    $select = $('#restaurant-id');
                    $select.find('option').remove();
                    $.each(restaurants, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.nom + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#restaurant-id').html('<option value="">Select Topic first</option>');
        }
    });
});


