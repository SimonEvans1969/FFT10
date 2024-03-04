<?php 
    $first_filter = true;
    foreach ($filters as $filter) {
?>
<div class="filter-block form-group has-feedback row {{ $errors->has($filter['header']->CATEGORY_NAME) ? ' has-error ' : '' }}">
    <label class="col-md-3 control-label"><?php if ($first_filter) echo 'Parents'; $first_filter = false; ?></label>
    <label class="col-md-2 control-label">{{$filter['header']->DESCRIPTION}}</label>
    <div class="col-md-7">
        <div class="input-group">
           <select class="selectpicker fft_pref fft_select filter fft-category-select modal-input" multiple
                   title="All {{$filter['header']->DESCRIPTION}}s"
                   name="{{$filter['header']->CATEGORY_NAME}}[]"
				   id="{{$filter['header']->CATEGORY_NAME}}"
                   data-width="auto"
				   name="{{$filter['header']->CATEGORY_NAME}}">
<?php   foreach ($filter['data'] as $category) { ?>
               <option value='{{$category->CATEGORY_VALUE}}' 
<?php
		if (is_array(old($filter['header']->CATEGORY_NAME)))
		{
			foreach (old($filter['header']->CATEGORY_NAME) as $selected)
			{
				if ($selected == $category->CATEGORY_VALUE ) echo " selected ";			 
			}
		}
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
        @if ($errors->has($filter['header']->CATEGORY_NAME))
            <span class="help-block">
                <strong>{{ $errors->first($filter['header']->CATEGORY_NAME) }}</strong>
            </span>
        @endif
    </div>
</div> 
<?php } // end foreach filters ?>