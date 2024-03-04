@extends('layouts.app')

@section('viewName')
Test Message
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
                            Create Test Messages
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'test.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        <div class="form-group has-feedback row">
                             <label for="active" class="col-md-3 control-label">Mobile Number:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <input type="text" class="form-control" name="MOBILE" id="MOBILE"
                                                   placeholder="Enter mobile number...">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="MOBILE">
                                                    <i class="fas fa-fw fa-star" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="form-group has-feedback row ">
                                    <label for="TYPE" class="col-md-3 control-label">FFT Type:</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="TYPE" id="TYPE">
                                            @foreach ($all_types as $type)
                                                <option value='{{$type->FFT_DEP_CODE}}' >{{$type->FFT_DEP_CODE}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="TYPE">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_active') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        <div class="form-group has-feedback row ">
                                    <label for="SPECIALTY" class="col-md-3 control-label">Specialty:</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="SPECIALTY" id="SPECIALTY" aria-label="Specialty" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="TYPE">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_active') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group has-feedback row ">
                                    <label for="LOCATION" class="col-md-3 control-label">Location:</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="LOCATION" id="LOCATION" aria-label="Location" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="TYPE">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_active') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                         {!! Form::button('Create Trigger', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
