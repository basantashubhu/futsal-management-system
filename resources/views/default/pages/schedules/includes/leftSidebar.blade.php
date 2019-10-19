<form action="javascript:;" class="m-form" id="CourtListForm">
    @foreach(app()['courts']->get() as $court)
    <div class="row mb-3">
        <div class="col-12">
            <label class="m-checkbox checkbox-light-blue">
                <input type="checkbox">
                <span></span>
            </label>
            <button type="button" class="btn btn-sm bg-transparent court" 
                data-id="{{ $court->id }}" style="font-weight:500;">
                {{ $court->name }}
            </button>
        </div>
    </div>
    @endforeach
</form>