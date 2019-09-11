<?php $f=0; ?>
@foreach($result as $k=>$v)
    <div class="form-group m-form__group row">
        <label class="col-lg-2 col-form-label">{{$labels[$f]}}:</label>
        <div class="col-lg-10">
            <input type="text" class="form-control m-input" value="{{$v}}">
        </div>
    </div>
    <?php $f++; ?>
@endforeach