@extends('layouts.app')

@section('viewName')
Paper Entry
@endsection

@section('content')
<?php
function getParents($parents) {
    $pText = '';
    $pArray = json_decode($parents,true);
    if (is_array($pArray)) {
        foreach ($pArray as $p => $v) {
            $pText .= "$p='$v' ";
        }
    }
    return($pText);
}
?>
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-12 offset-lg-1">
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
                        {!! Form::open(array('route' => ($question_set ? 'paperentry.store' : 'paperentry.create'), 'method' => ($question_set ? 'POST' : 'POST'), 'role' => 'form', 'class' => 'needs-validation', 'id' => 'paperentryform')) !!} 
                        {!! csrf_field() !!}
            <div class="form-group has-feedback row {{ $errors->has('FFT_DT') ?' has-error ' : '' }}">
                <label for="FFT_DT" class="col-md-2 control-label"
                       style="margin-bottom: 0px; align-self: center">Date/Time:</label>
                <div class="col-md-4">
                    <div class="input-group date" id="FFT_DT" data-target-input="nearest" >
                        <input type="text" class="form-control datetimepicker-input" data-target="#FFT_DT" name="FFT_DT"/>
                        <div class="input-group-append" data-target="#FFT_DT" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-fw fa-calendar"></i></div>
                        </div>
                    </div>
                    @if ($errors->has('FFT_DT'))
                        <span class="help-block">
                            <strong>{{ $errors->first('FFT_DT') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="btn-group btn-group-toggle invisible" data-toggle="buttons" aria-label="Time of Day">
                    <label class="btn btn-light <?php if ($FFT_TM == 'AM') echo " active ";?> ">
                        <input type="radio" name="FFT_TM" value="AM" autocomplete="off"
                               <?php if ($FFT_TM == 'AM') echo " checked ";?> >Morning
                    </label>
                    <label class="btn btn-light <?php if ($FFT_TM == 'PM') echo " active ";?> ">
                        <input type="radio" name="FFT_TM" value="PM" autocomplete="off"
                               <?php if ($FFT_TM == 'PM') echo " checked ";?> >Afternoon
                    </label>
                    <label class="btn btn-light <?php if ($FFT_TM == 'EV') echo " active ";?> ">
                        <input type="radio" name="FFT_TM" value="EV" autocomplete="off"
                               <?php if ($FFT_TM == 'EV') echo " checked ";?> >Evening
                    </label>
                </div>
            </div>

        <script type="text/javascript">
            $(function () {
                $('#FFT_DT').datetimepicker(
                    {
                        format: 'DD/MM/YYYY',
                        defaultDate: moment('{{$FFT_DT}}','DD/MM/YYYY'),
                        sideBySide : true
                    }
                );
            });
        </script>
                        
<div class="form-group has-feedback row {{ $errors->has('QUESTION_SET') ?' has-error ' : '' }}">
    <label for="QUESTION_SET" class="col-md-2 control-label"
           style="margin-bottom: 0px; align-self: center">Type:</label>
        <div class="col-md-9">
            <div class="input-group">
                <select class="custom-select form-control browser-default select-save"  id="QUESTION_SET" 
                        name="QUESTION_SET" old-val="" >
                    <option value="" disabled 
                             <?php if (old('QUESTION_SET') == '') 
                                            echo " selected "; ?>
                            >Select type...</option>
                    @foreach ($question_sets as $type)
                        <option value='{{$type->CATEGORY_VALUE}}' 
                            <?php if ($type->CATEGORY_VALUE == $question_set) 
                                            echo " selected "; ?>
                            >{{$type->DESCRIPTION}}</option>
                    @endforeach   
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="QUESTION_SET">
                            <i class="fas fa-fw fa-star" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
    @if ($errors->has('QUESTION_SET'))
        <span class="help-block">
            <strong>{{ $errors->first('QUESTION_SET') }}</strong>
        </span>
    @endif
        </div>
</div>

@if ($question_set)
<?php 
foreach ($categories as $category) { 
    if ($category->POSITION == 'BEFORE' ) { ?>
<div class="form-group has-feedback row {{ $errors->has($category->CATEGORY_NAME) ? ' has-error ' : '' }}">
    <label for="{{$category->CATEGORY_NAME}}" class="col-md-2 control-label" style="margin-bottom: 0px; align-self: center">{{$category->DESCRIPTION}}:</label>
    <div class="col-md-9">
        <div class="input-group">
            <div class="input-group" >
                <?php if ($category_values[$category->CATEGORY_NAME]) { ?>
                <select class="browser-default custom-select select-save" id="{{$category->CATEGORY_NAME}}"
                        name="{{$category->CATEGORY_NAME}}" >
                    <option disabled selected >Select {{$category->DESCRIPTION}}...</option>
                    <?php foreach($category_values[$category->CATEGORY_NAME] as $option) { ?>
                        <option value="{{$option->CATEGORY_VALUE}}" parents='<?php echo htmlspecialchars_decode($option->PARENTS);?>'
                                <? if (old($category->CATEGORY_NAME) == $option->CATEGORY_VALUE) echo ' selected '; ?>
                                >{{$option->DESCRIPTION}}</option>
                    <?php } ?>
                </select>
                <?php } else {?>
                    <input type="text" class="form-control" id="{{$category->CATEGORY_NAME}} name="{{$category->CATEGORY_NAME}}">
                <?php } ?>
                <div class="input-group-append">
                    <label class="input-group-text" for="$category->CATEGORY_NAME">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
    @if ($errors->has($category->CATEGORY_NAME))
        <span class="help-block">
            <strong>{{ $errors->first($category->CATEGORY_NAME) }}</strong>
        </span>
    @endif
    </div>
</div>
<?php } // end if AFTER
    } // end of foreach categories
                        
foreach ($questions as $question) { 
    $q_no = 'QUESTION_' . $question->QUESTION_NO; 
    
    switch ($question->QUESTION_TYPE) {
        case '2' : ?>                     
<div class="form-group has-feedback row {{ $errors->has($q_no) ? ' has-error ' : '' }}">
    <label for="{{$q_no}}" class="col-md-2 control-label" style="margin-bottom: 0px; align-self: center">{{$question->QUESTION_NAME}}:</label>
    <div class="col-md-9">
        <div class="input-group">
            <div class="input-group" >
                <select class="browser-default custom-select" id="{{$q_no}}" name="{{$q_no}}">
                    <option disabled <?php if (strpos("012345",(strval(old($q_no)) ?: "X")) === false) echo ' selected ';
                            ?>  >Select Rating...</option>
                    <option value="5" <?php if (old($q_no) == '5') echo ' selected '; ?>>Very good</option>
                    <option value="4" <?php if (old($q_no) == '4') echo ' selected '; ?>>Good</option>
                    <option value="3" <?php if (old($q_no) == '3') echo ' selected '; ?>>Neither good nor poor</option>
                    <option value="2" <?php if (old($q_no) == '2') echo ' selected '; ?>>Poor</option>
                    <option value="1" <?php if (old($q_no) == '1') echo ' selected '; ?>>Very poor</option>
                    <option value="0" <?php if (old($q_no) == '0') echo ' selected '; ?>>Don't know</option>
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="{{$q_no}}">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
    @if ($errors->has($q_no))
        <span class="help-block">
            <strong>{{ $errors->first($q_no) }}</strong>
        </span>
    @endif
    </div>
</div>
<?php       break;
		case '6' : ?>                     
<div class="form-group has-feedback row {{ $errors->has($q_no) ? ' has-error ' : '' }}">
    <label for="{{$q_no}}" class="col-md-2 control-label" style="margin-bottom: 0px; align-self: center">{{$question->QUESTION_NAME}}:</label>
    <div class="col-md-9">
        <div class="input-group">
            <div class="input-group" >
                <select class="browser-default custom-select" id="{{$q_no}}" name="{{$q_no}}">
                    <option disabled <?php if (strpos("012345",(strval(old($q_no)) ?: "X")) === false) echo ' selected ';
                            ?>  >Select Rating...</option>
                    <option value="5" <?php if (old($q_no) == '5') echo ' selected '; ?>>Very likely</option>
                    <option value="4" <?php if (old($q_no) == '4') echo ' selected '; ?>>Likely</option>
                    <option value="3" <?php if (old($q_no) == '3') echo ' selected '; ?>>Neither likely nor unlikely</option>
                    <option value="2" <?php if (old($q_no) == '2') echo ' selected '; ?>>Unlikely</option>
                    <option value="1" <?php if (old($q_no) == '1') echo ' selected '; ?>>Very unlikely</option>
                    <option value="0" <?php if (old($q_no) == '0') echo ' selected '; ?>>Don't know</option>
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="{{$q_no}}">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
    @if ($errors->has($q_no))
        <span class="help-block">
            <strong>{{ $errors->first($q_no) }}</strong>
        </span>
    @endif
    </div>
</div>
<?php       break;
        case '99' :
            // Do not print these
            break;
        default : ?>
<div class="form-group has-feedback row {{ $errors->has($q_no) ? ' has-error ' : '' }}">
    <label for="{{$q_no}}" class="col-md-2 control-label" style="margin-bottom: 0px; align-self: center">{{$question->QUESTION_NAME}}:</label>
    <div class="col-md-9">
        <div class="input-group">
            <div class="input-group" >
                <textarea class="form-control" rows="3" id="{{$q_no}}" name="{{$q_no}}">{{old($q_no)}}</textarea>
                <div class="input-group-append">
                    <label class="input-group-text" for="{{$q_no}}">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
    @if ($errors->has($q_no))
        <span class="help-block">
            <strong>{{ $errors->first($q_no) }}</strong>
        </span>
    @endif
    </div>
</div>                      
<?php   } // end of switch 
    } // end foreach questions

foreach ($categories as $category) { 
    if ($category->POSITION == 'AFTER' ) { ?>
<div class="form-group has-feedback row {{ $errors->has($category->CATEGORY_NAME) ? ' has-error ' : '' }}">
    <label for="{{$category->CATEGORY_NAME}}" class="col-md-2 control-label" style="margin-bottom: 0px; align-self: center">{{$category->DESCRIPTION}}:</label>
    <div class="col-md-9">
        <div class="input-group">
            <div class="input-group" >
                <?php if ($category_values[$category->CATEGORY_NAME]) { ?>
                <select class="browser-default custom-select select-save" id="{{$category->CATEGORY_NAME}}" 
                        name="{{$category->CATEGORY_NAME}}">
                    <option disabled selected >Select {{$category->DESCRIPTION}}...</option>
                    <?php foreach($category_values[$category->CATEGORY_NAME] as $option) { ?>
                        <option value="{{$option->CATEGORY_VALUE}}" parents='<?php echo htmlspecialchars_decode($option->PARENTS);?>'
                            <? if (old($category->CATEGORY_NAME) == $option->CATEGORY_VALUE) echo ' selected '; ?>
                                >{{$option->DESCRIPTION}}</option>
                    <?php } ?>
                </select>
                <?php } else {?>
                    <input type="text" class="form-control" id="{{$category->CATEGORY_NAME}}">
                <?php } ?>
                <div class="input-group-append">
                    <label class="input-group-text" for="$category->CATEGORY_NAME">
                        <i class="fas fa-fw fa-question-circle" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
    @if ($errors->has($category->CATEGORY_NAME))
        <span class="help-block">
            <strong>{{ $errors->first($category->CATEGORY_NAME) }}</strong>
        </span>
    @endif
    </div>
</div>
<?php } // end if AFTER
    } // end of foreach categories ?>
                         {!! Form::button('Save Record', array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit' )) !!}
@endif
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
    
    $('#QUESTION_SET').on('change', function () {
        if ($(this).attr('old-val') != '') {
            // Launch modal to check change
            
        } else {
            // submit form
            $('#paperentryform').submit();
        }
    });
    
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
