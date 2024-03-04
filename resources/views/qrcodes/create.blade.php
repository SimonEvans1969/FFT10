@extends('layouts.app')

@section('viewName')
Create Weblink
@endsection

@section('content')
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Create QR code
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'qrcodes.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'qrcreateform')) !!} 
                            {!! csrf_field() !!}
							<div class="form-group has-feedback row {{ $errors->has('code_group') ? ' has-error ' : '' }}">
                                <label for="code_group" class="col-md-3 control-label">Link Group</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('code_group', '', array('id' => 'code_group', 'class' => 'form-control text-lowercase', 'placeholder' => 'Enter name for QR Group')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                    <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('code_group'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code_group') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('code_name') ? ' has-error ' : '' }}">
                                <label for="code_name" class="col-md-3 control-label">Link Name</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('code_name', '', array('id' => 'code_name', 'class' => 'form-control text-lowercase', 'placeholder' => 'Enter name for QR Code')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                    <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('code_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							<div class="form-group has-feedback row {{ $errors->has('DESCRIPTION') ? ' has-error ' : '' }}">
                                <label for="code_name" class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::textarea('DESCRIPTION', '', array('id' => 'DESCRIPTION', 'class' => 'form-control', 'placeholder' => 'Enter description for QR Code', 'rows' => '3' )) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="DESCRIPTION">
                                                    <i class="fa fa-fw fa-qrcode" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('DESCRIPTION'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('DESCRIPTION') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
<?php
foreach ($filters as $filter) {
?>
<div class="form-group has-feedback row {{ $errors->has($filter['header']->CATEGORY_NAME) ? ' has-error ' : '' }}">
    <label for="active" class="col-md-3 control-label">{{$filter['header']->DESCRIPTION}}</label>
    <div class="col-md-9">
        <div class="input-group">
            <select class="browser-default custom-select form-control select-save" name="{{$filter['header']->CATEGORY_NAME}}" 
                                    id="{{$filter['header']->CATEGORY_NAME}}" >
                  <option value='' parents='' >Not selected</option>
                    <?php foreach ($filter['data'] as $option) { ?>
                        <option value="{{$option->CATEGORY_VALUE}}" parents='<?php echo htmlspecialchars_decode($option->PARENTS);?>'
                            <? if (old($filter['header']->CATEGORY_NAME) == $option->CATEGORY_VALUE) echo ' selected '; ?>
                                >{{$option->DESCRIPTION}}</option>
                    <?php } ?>
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="$category->CATEGORY_NAME">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
        </div>
    @if ($errors->has($filter['header']->CATEGORY_NAME))
        <span class="help-block">
            <strong>{{ $errors->first($filter['header']->CATEGORY_NAME) }}</strong>
        </span>
    @endif
    </div>
</div>
<?php  } // end of foreach categories ?>

@if (session('qrcode'))
    <div class="row">
        <img src="../../img/qrcodes/{{session('TRUST_CODE')}}/{{session('qrcode')}}.png" alt="QR Code">
    </div>
@endif                
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-2">
                                </div>
                                <div class="col-12 col-sm-6">
                                    {!! Form::button('Create QR code', array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit' )) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {

    // On load, clone all selects
    saved_selects = {};
    $('.select-save').each( function () {
        saved_selects[$(this).attr('id')] = $(this).clone();
    });
    
    // Set up Selects on first time through
    setSelects();
    
    // On change of select apply filters
    $('.select-save').on('change', function () {
        setSelects();
    });
    
    function setSelects() {
        var selected = {};
        $('.select-save').each( function () {
            
            if (($(this).val() != '') && ($(this).val() != null)) {
                selected[$(this).attr('id')] = $(this).val();
            }
        });
        
        $('.select-save').each( function () {
            // For any without a selection, limit the options by Parent
            if (($(this).val() == '') || ($(this).val() == null)) {
                $(this).find('option').remove();
                $(this).append(saved_selects[$(this).attr('id')].find('option').clone());
                // Now loop through the options and remove those that do not apply
                $(this).find('option').each( function () {
                    if ($(this).attr('parents')) {
                        var el = $(this);
                        var parents = JSON.parse($(this).attr('parents'));
                        
                        // Loop thru the selected values
                        for (var category in selected) {
                            if ((selected[category] != '*') && (parents[category])) {
                                switch (typeof(parents[category])) {
                                    case 'string' :
                                        if (parents[category].indexOf(selected[category]) == -1) {
                                            // Found the category, but not the value
                                            $(el).remove();
                                        }
                                        break;
                                    case 'object' :
                                        // Need to test all possible values
                                        var foundpar = false;
                                        for (var par in parents[category]) {
                                           if (parents[category][par].indexOf(selected[category]) != -1) foundpar = true; 
                                        }
                                        if (!foundpar) {
                                            $(el).remove();
                                        }
                                        break;
                                } // end switch
                            } // end if (parents[category])
                        } // end  for (var category in selected)
                    }
                });
            }
        });
    }
});
</script>
@endsection

