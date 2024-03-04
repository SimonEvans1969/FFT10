<?php 
    $first_filter = true;
    foreach ($filters as $filter) {
?>
<div class="{{$filter_type}}-filter-block form-group has-feedback row
            {{ $errors->has($filter_type . '__' . $filter['header']->CATEGORY_NAME) ? ' has-error ' : '' }}">
    <label class="col-md-3 control-label"><?php if ($first_filter) echo isset($filter_header) ? $filter_header : '**BLANK**' ; $first_filter = false; ?></label>
    <label class="col-md-2 control-label">{{$filter['header']->DESCRIPTION}}</label>
    <div class="col-md-7">
        <div class="input-group">
           <select class="{{$filter_type}}-select selectpicker fft_pref fft_select filter fft-category-select" multiple
                   title="All {{$filter['header']->DESCRIPTION}}s"
                   name="{{$filter_type}}__{{$filter['header']->CATEGORY_NAME}}[]"
                   data-width="auto" >
<?php   foreach ($filter['data'] as $category) { ?>
               <option value='{{$category->CATEGORY_VALUE}}' 
<?php
    $t_limits = isset(${$filter_type}->{$category->CATEGORY_NAME}) ? ${$filter_type}->{$category->CATEGORY_NAME} : [];
    $t_limits= is_array($t_limits) ? $t_limits : [ $t_limits ];
    if (array_search($category->CATEGORY_VALUE, $t_limits) !== false) echo ' selected ';
?>
                        >{{$category->DESCRIPTION}}</option>
<?php   } // end foreach categories ?>
           </select>
           <div class="input-group-append">
               <label class="input-group-text fft-category-icon">
                   <i class="fa fa-fw fa-star" aria-hidden="true"></i>
               </label>
           </div>
        </div>
        @if ($errors->has($filter_type . '__' . $filter['header']->CATEGORY_NAME))
            <span class="help-block">
                <strong>{{ $errors->first($filter_type . '__' . $filter['header']->CATEGORY_NAME) }}</strong>
            </span>
        @endif
    </div>
</div> 
<?php } // end foreach filters ?>