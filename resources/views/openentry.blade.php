@extends('layouts.app')

@section('viewName')
FFT Web Access
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
                        {!! Form::open(array('route' => 'openentry.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                <select class="custom-select fft_select fft_pref" id="fft_type" name="Service" style="width: 150px">
<?php
    if ($Service == '') {
        ?>
                
        <option value=''>Select the service...</option>
        <option value='Diabetes service'>Diabetes service</option>
        <option value='Heart failure service'>Heart failure service</option>
        <option value='Occupational therapy'>Occupational therapy</option>
        <option value='Physiotherapy'>Physiotherapy</option>
        <option value='Podiatry'>Podiatry</option>
        <option value='Pulmonary Rehab'>Pulmonary Rehab</option>
<?php } else {
?>
  <option value='{$Service}'>{{$Service}}</option>                  
<?php                    
    }
?>
    </select>
            </div>
   
        </div>
</div>


                        <div class="form-group has-feedback row {{ $errors->has('FFT_PAPER_RATING_ID') ? ' has-error ' : '' }}">
                             <label for="active" class="col-md-3 control-label">Rating:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <select id="FFT_PAPER_RATING_ID" class="custom-select form-control">
                                                <option value='0'>0 - Don't know</option>
                            <option value='1'>1 - Very poor</option>
                            <option value='2'>2 - Poor</option>
                            <option value='3'>3 - Neither good nor poor</option>
                            <option value='4'>4 - Good</option>
                            <option value='5'>5 - Very good</option>
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

    <option value='A' >White British</option>
                                                <option value='B' >White Other</option>
                                                <option value='C' >Black African</option>
                                                <option value='D' >Black Caribbean</option>
                                                <option value='E' >Other</option>
 
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

    <option value='1' >0-15</option>
                                                <option value='1' >0-15</option>
                                                <option value='1' >16-24</option>
                                                <option value='1' >25-34</option>
                                                <option value='1' >35-44</option>
                                                <option value='1' >45-54</option>
                                                <option value='1' >55-64</option>
                                                <option value='1' >65-74</option>
                                                <option value='1' >75-84</option>
                                                <option value='1' >84+</option>
                                                
 
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

    <option value='M' >Male</option>
                                                <option value='F' >Female</option>
                                                <option value='O' >Other</option>

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
                         {!! Form::button('Submit feedback', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
