$(function () {
    $('#resource-form').on('submit', function (e) {
        e.preventDefault();

        $('#messages').html('');

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (!response || !response.success || !response.data) {
                showErrors(response.errors);
                return;
            }

            if (!$('#id').val()) {
                $('#id').val(response.data.id);
            }

            showSuccess('Resource successfully saved');
            $('#resource-delete').removeClass('hidden');
        }).fail(function () {
            showErrors();
        });
    });

    $('#resource-delete').on('click', function () {
        if (!confirm('Are you sure you want to delete this resource?')) {
            return;
        }

        var id = $('#id').val();
        if (!id) {
            return;
        }

        $.ajax({
            url: $(this).data('url'),
            type: 'post',
            data: {id: id},
            dataType: 'json',
        }).done(function (response) {
            if (!response || !response.success || !response.data) {
                showErrors(response.errors);
                return;
            }

            location.href = response.data;
        }).fail(function () {
            showErrors();
        });

    });
});

function showErrors(errors)
{
    if (!errors || errors.length < 1) {
        errors = ['An unknown error occurred'];
    }

    var msg = errors.join('</div><div class="error">');
    msg = '<div class="error">' + msg + '</div>';

    $('#messages').html(msg);
}

function showSuccess(msg)
{
    var msg = '<div class="success">' + msg + '</div>';
    $('#messages').html(msg);
}