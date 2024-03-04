@extends('layouts.public')

@section('viewName')
Friends and Family Test
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
                            Friends and Family Test
                        </div>
                    </div>
                    <div class="card-body">
@if ( $fft_id != -1)
                        {!! Form::open(array('route' => 'cryfft.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        <input type="hidden" id="FFT_ID" value="{{ $fft_id }}">

@foreach ($fft_questions as $question)
    @if ($question->QUESTION_TYPE == 1)
        <div class="form-group has-feedback row 
                <?php echo ($errors->has('QUESTION_' . $question->QUESTION_NO)) ? ' has-error ' : '' ?> ">
            <label for="active" class="col-md-3 control-label">{{ $question->QUESTION_TEXT }}</label>
            <div class="col-md-9">
                <div class="input-group">
                    <div class="input-group" >
                        <textarea id="QUESTION_{{ $question->QUESTION_NO}}" 
                                  class="custom-textare form-control"></textarea>
                        <div class="input-group-append">
                            <label class="input-group-text" for="QUESTION_{{ $question->QUESTION_NO }}">
                                <i class="fas fa-fw fa-comment" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <?php if ($errors->has('QUESTION_' . $question->QUESTION_NO)) { ?>
                    <span class="help-block">
                        <strong>{{ $errors->first('QUESTION_<?php echo $question->QUESTION_NO;?>') }}</strong>
                    </span>
                <?php }?>
            </div>
        </div>
    @endif
    @if ($question->QUESTION_TYPE == 2)
        <div class="form-group has-feedback row 
                <?php echo ($errors->has('QUESTION_' . $question->QUESTION_NO)) ? ' has-error ' : '' ?> ">
            <label for="active" class="col-md-3 control-label">{{ $question->QUESTION_TEXT }}</label>
            <div class="col-md-9">
                <div class="input-group">
                    <div class="input-group" >
                        <select id="QUESTION_{{ $question->QUESTION_NO }}" 
                                class="browser-default custom-select form-control">
                            <option value=''>Please select...</option>
                            <option value='0'>0 - Don't know</option>
                            <option value='1'>1 - Very poor</option>
                            <option value='2'>2 - Poor</option>
                            <option value='3'>3 - Neither good nor poor</option>
                            <option value='4'>4 - Good</option>
                            <option value='5'>5 - Very good</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="QUESTION_{{ $question->QUESTION_NO }}">
                                <i class="fas fa-fw fa-star" aria-hidden="true"></i>                  
                            </label>
                        </div>
                    </div>
                </div>            
                <?php if ($errors->has('QUESTION_' . $question->QUESTION_NO)) { ?>
                    <span class="help-block">
                        <strong>{{ $errors->first('QUESTION_<?php echo $question->QUESTION_NO;?>') }}</strong>
                    </span>
                <?php }?>
            </div>
        </div>
    @endif
    @if ($question->QUESTION_TYPE == 4)
        <div class="form-group has-feedback row 
                <?php echo ($errors->has('QUESTION_' . $question->QUESTION_NO)) ? ' has-error ' : '' ?> ">
            <label for="active" class="col-md-3 control-label">{{ $question->QUESTION_TEXT }}</label>
            <div class="col-md-9">
                <div class="input-group">
                    <div class="input-group" >
                        <select id="QUESTION_{{ $question->QUESTION_NO }}" 
                                class="browser-default custom-select form-control">
                            <option value=''>Please select...</option>
                            <option value='Y'>Yes</option>
                            <option value='N'>No</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="QUESTION_{{ $question->QUESTION_NO }}">
                                <i class="fas fa-fw fa-check" aria-hidden="true"></i>                  
                            </label>
                        </div>
                    </div>
                </div>            
                <?php if ($errors->has('QUESTION_' . $question->QUESTION_NO)) { ?>
                    <span class="help-block">
                        <strong>{{ $errors->first('QUESTION_<?php echo $question->QUESTION_NO;?>') }}</strong>
                    </span>
                <?php }?>
            </div>
        </div>
    @endif
@endforeach
        {!! Form::button('Submit feedback', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
        {!! Form::close() !!}
                    </div>
@else
    This link has expired.
@endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
