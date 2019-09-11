

loadTodoList();
$(document).off('blur', '#TodoInputField').on('blur', '#TodoInputField', function (e) {
    if ($(this).val().length) {
        ajaxRequest({
            url: "/note/todo/create",
            method: 'post',
            data: {
                'title': $(this).val()
            }
        }, function (response) {
            loadTodoList();
        });

        $(this).val('');
    }
})

function loadTodoList() {
    var request = {
        url: '/note/todo',
        method: 'get'
    };
    ajaxRequest(request, function (response) {
        appendtolist(response.data);
    })
}

function appendtolist(todos) {
    $('#TodoList').empty();
    if(todos != 'false'){
        if (todos.length) {
            $.each(todos, function (index, value) {
                var todo = ' <div class="m-widget2__item m-widget2__item--primary">\
                                 <div class="m-widget2__checkbox">\
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">\
                                     <input type="checkbox" class="todo-checkBox" name="todo-item" data-id="' + value.id + '" title="Mark as Completed">\
                                    <span></span>\
                                    </label>\
                                </div>\
                                <div class="m-widget2__desc">\
                                        <span class="m-widget2__text" ">'
                    + value.title.ucfirst() +
                    '</span><br>\
                    <span class="m-widget2__user-name">\
                    <a href="#" class="m-widget2__link"> ' +
                    moment(value.date).format(std.config.date_format) +
                    '</a>\
                    </span>\
            </div>\
            <div class="m-widget2__actions">\
             <button type="button" class="btn m-btn btn-success doneTodo hidden btn-sm" data-id=' + value.id + '> <i class="fa fa-check"></i> Done</button>\
                                </div>\
                             </div>\
                    <hr/>';
                $('#TodoList').append(todo)

            });
        } else {
            $('#TodoList').html('<p>No To Do available</p>')
        }
    }

}

$(document).on('click', '.doneTodo', function (e) {
    var id = $(this).attr('data-id');
    ajaxRequest({
        url: "todo/completed/"+id,
        method: 'post',
    }, function (response) {
        loadTodoList();
    });
});
/*$(document).on('click', '.todo-checkBox', function (e) {
    if ($(this).prop('checked')) {
        $(this).parent().parent().next().css('text-decoration', 'line-through');
        $('#MarkAsCompleteBtn').attr('disabled', false);
    }
    else {
        $(this).parent().parent().next().css('text-decoration', 'none');

        if (!$('[name="todo-item"]:checked').length) {
            $('#MarkAsCompleteBtn').attr('disabled', true);
        }
    }
});*/
$(document).on('click', '.todo-checkBox', function (e) {
    var btn = $(this).parent().parent().parent().find('.doneTodo');
    if ($(this).prop('checked')) {
        $(this).parent().parent().next().css('text-decoration', 'line-through');
        btn.removeClass('hidden');
    }
    else {
        $(this).parent().parent().next().css('text-decoration', 'none');
        btn.addClass('hidden');

    }
});
var SelectedTodo = [];
$(document).on('click', '#MarkAsCompleteBtn', function () {

    if ($('[name="todo-item"]:checked').length) {
        $('.todo-checkBox').each(function () {
            if ($(this).prop('checked')) {
                SelectedTodo.push($(this).attr('data-id'));
            }
        });
    }
    ajaxRequest({
        url: "todo/completed",
        method: 'post',
        data: SelectedTodo
    }, function (response) {
        loadTodoList();
    });
});