@extends('layouts.app')

@section('viewName')
Paper Entry
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
                            Manual Paper Entry
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'userentry.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_CHECK_IN_DATE') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Date:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <input type="date" class="form-control" id="FFT_PAPER_CHECK_IN_DATE"
                                                   placeholder="Enter appointment or discharge date...">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_CHECK_IN_DATE">
                                                    <i class="fas fa-fw fa-calendar-alt" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_CHECK_IN_DATE'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_CHECK_IN_DATE') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_DEP_CODE_ID') ? ' has-error ' : '' }}">
    <label for="FFT_PAPER_DEP_CODE_ID" class="col-md-3 control-label">Type</label>
        <div class="col-md-9">
            <div class="input-group">
                <select class="custom-select form-control" name="FFT_PAPER_DEP_CODE_ID" id="FFT_PAPER_DEP_CODE_ID">
<option value="0" <?php if ("{$user->FFT_TYPE_CODE}" == "0" ) echo " selected "; ?>>All Types</option>
@foreach ($all_types as $type)
    <option value='{{$type->FFT_TYPE_CODE}}' 
        <?php if ("{$type->FFT_TYPE_CODE}" == "{$user->FFT_TYPE_CODE}") echo " selected "; ?>
    >{{$type->FFT_TYPE}}</option>
@endforeach   
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="FFT_PAPER_DEP_CODE_ID">
                        @if(config('laravelusers.fontAwesomeEnabled'))
                            <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                        @else
                            {!! trans('laravelusers::forms.create_user_label_active') !!}
                        @endif
                    </label>
                </div>
            </div>
    @if ($errors->has('FFT_PAPER_DEP_CODE_ID'))
        <span class="help-block">
            <strong>{{ $errors->first('FFT_PAPER_DEP_CODE_ID') }}</strong>
        </span>
    @endif
        </div>
</div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_SPECIALTY_CODE') ? ' has-error ' : '' }}">
                                    <label for="active" class="col-md-3 control-label">Specialty</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="FFT_PAPER_SPECIALTY_CODE" id="FFT_PAPER_SPECIALTY_CODE">
<option value="0" <?php if ("{$user->FFT_SPECIALTY_CODE}" == "0" ) echo " selected "; ?>>All Specialties</option>
@foreach ($all_specialties as $specialty)
    <option value='{{$specialty->FFT_SPECIALTY_CODE}}' 
        <?php if ("{$specialty->FFT_SPECIALTY_CODE}" == "{$user->FFT_SPECIALTY_CODE}") echo " selected "; ?>
    >{{$specialty->FFT_SPECIALTY}}</option>
@endforeach   
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="FFT_PAPER_SPECIALTY_CODE">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_active') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_SPECIALTY_CODE'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_SPECIALTY_CODE') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_LOCATION_CODE') ? ' has-error ' : '' }}">
                                    <label for="FFT_PAPER_LOCATION_CODE" class="col-md-3 control-label">Location</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="FFT_PAPER_LOCATION_CODE" id="FFT_PAPER_LOCATION_CODE">
<option value="0" <?php if ("{$user->FFT_LOCATION_CODE}" == "0" ) echo " selected "; ?>>All Locations</option>
@foreach ($all_locations as $location)
    <option value='{{$location->FFT_LOCATION_CODE}}' 
        <?php if ("{$location->FFT_LOCATION_CODE}" == "{$user->FFT_LOCATION_CODE}") echo " selected "; ?>
    >{{$location->FFT_LOCATION}}</option>
@endforeach   
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="FFT_PAPER_LOCATION_CODE">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.preference') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_active') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_LOCATION_CODE'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_LOCATION_CODE') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_RATING_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Rating:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_RATING_ID" class="custom-select form-control">
                                                <option value='0'>0 - Don't know</option>
                                                <option value='1'>1 - Extremely unlikely</option>
                                                <option value='2'>2 - Unlikely</option>
                                                <option value='3'>3 - Neither likely nor unlikely</option>
                                                <option value='4'>4 - Likely</option>
                                                <option value='5'>5 - Extremely Likely</option>
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_RATING_ID">
                                                    <i class="fas fa-fw fa-star" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_RATING_ID'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_RATING_ID') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                         <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_RESPONSE1') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Reason:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <textarea id="FFT_PAPER_RESPONSE1" class="custom-textare form-control"></textarea>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_RESPONSE1">
                                                    <i class="fas fa-fw fa-comment" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_RESPONSE1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_RESPONSE1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_RESPONSE2') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Improvement:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <textarea id="FFT_PAPER_RESPONSE2" class="custom-textare form-control"></textarea>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_RESPONSE2">
                                                    <i class="fas fa-fw fa-comment" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_RESPONSE2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_RESPONSE2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_IS_DO_NOT_PUBLIC') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Publish:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_IS_DO_NOT_PUBLIC" class="custom-select form-control">
                                                <option value='N'>No</option>
                                                <option value='Y'>Yes</option>
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_IS_DO_NOT_PUBLIC">
                                                    <i class="fas fa-fw fa-check" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_IS_DO_NOT_PUBLIC'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_IS_DO_NOT_PUBLIC') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_ETHNIC_ORIGIN_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Ethnicity:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_ETHNIC_ORIGIN_ID" class="custom-select form-control">
                                                <option value="">Select ethnicity...</option>
@foreach ($ethnicities as $ethnicity)
    <option value='{{$ethnicity->ETHNIC_ID}}' >{{$ethnicity->ETHNIC_NAME}}</option>
@endforeach  
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_ETHNIC_ORIGIN_ID">
                                                    <i class="fas fa-fw fa-user" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_ETHNIC_ORIGIN_ID'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_ETHNIC_ORIGIN_ID') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_AGE_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Age band:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_AGE_ID" class="custom-select form-control">
                                                <option value="">Select age band...</option>
@foreach ($age_bands as $age_band)
    <option value='{{$age_band->AGE_BAND_ID}}' >{{$age_band->AGE_BAND_NAME}}</option>
@endforeach  
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_AGE_ID">
                                                    <i class="fas fa-fw fa-user" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_AGE_ID'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_AGE_ID') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_GENEDER_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Gender:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_GENEDER_ID" class="custom-select form-control">
                                                <option value="">Select gender...</option>
@foreach ($genders as $gender)
    <option value='{{$gender->GENDER_ID}}' >{{$gender->GENDER_NAME}}</option>
@endforeach  
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_GENEDER_ID">
                                                    <i class="fas fa-fw fa-user" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_GENEDER_ID'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_GENEDER_ID') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_DISABILITY_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Disability:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_DISABILITY_ID" class="custom-select form-control">
                                                <option value="">Select disability...</option>
@foreach ($disabilities as $disability)
    <option value='{{$disability->DISABILITY_ID}}' >{{$disability->DISABILITY_NAME}}</option>
@endforeach  
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="FFT_PAPER_DISABILITY_ID">
                                                    <i class="fas fa-fw fa-user" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('FFT_PAPER_DISABILITY_ID'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('FFT_PAPER_DISABILITY_ID') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                         {!! Form::button('Save Record', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
