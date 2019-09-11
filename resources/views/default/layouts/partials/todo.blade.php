<div class="row">
    <div class="col-md-12">
        <form class="m-form" id="todoForm">
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="subject">Subject</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control m-input" id="subject" name="title" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="date">Date</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control m-input" id="date" name="todo_timestamp" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="todo">To Do</label>
                </div>
                <div class="col-sm-10">
                    <textarea class="form-control m-input" id="todo" name="note_desc"></textarea>
                </div>
                <input type="hidden" name="userc_id" value="{{ Auth::id() }}">
                <input type="hidden" name="note_type" value="todo">
                <input type="hidden" name="note_code" value="todo">
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button class="btn btn-sm btn-success m-btn--pill float-right m-l-10" id="submitTodo" data-target="todoForm">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary m-btn--pill clearBtn float-right" data-target="todoForm">Clear</button>
                </div>
            </div>

        </form>
    </div>
    {{--<div class="col-md-4 pull-right " >
        <button type="button" class="btn m-btn--pill btn-success" id="MarkAsCompleteBtn" disabled> <i class="fa fa-check"></i></button>
    </div>--}}
</div>
<div class="row">
    <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light col-md-12">
        <hr>
        <div class="m-widget2" id="TodoList">
            <div class="m-widget2__item m-widget2__item--primary">
                <div class="m-widget2__checkbox">
                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                        <input type="checkbox">
                        <span></span>
                    </label>
                </div>
                <div class="m-widget2__desc">
							<span class="m-widget2__text">
							Make Metronic Great  Again.Lorem Ipsum Amet
							</span><br>
                    <span class="m-widget2__user-name">
							<a href="#" class="m-widget2__link">
							By Bob
							</a>
							</span>
                    <span>
                        test
                    </span>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>