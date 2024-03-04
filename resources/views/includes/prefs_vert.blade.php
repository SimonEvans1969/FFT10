    <?php 
        foreach ($filters as $filter) {
    ?>
    <div class="form-group has-feedback row {{ $errors->has($filter['header']->CATEGORY_NAME) ? ' has-error ' : '' }}">
        <label for="active" class="col-md-3 control-label">{{$filter['header']->DESCRIPTION}}</label>
        <div class="col-md-9">
            <div class="input-group">
                <select class="browser-default custom-select form-control" name="{{$filter['header']->CATEGORY_NAME}}" 
                                    id="{{$filter['header']->CATEGORY_NAME}}" >
          <option value='*' parents='*' >Not selected</option>
    <?php
          foreach ($filter['data'] as $category) { ?>
                <option value='{{$category->CATEGORY_VALUE}}' 
                        parents='{{$category->PARENTS}}'
    <?php if ($prefs->{$category->CATEGORY_NAME} == $category->CATEGORY_VALUE)
              echo ' selected ';
    ?>
                        >{{$category->DESCRIPTION}}</option>
    <?php   } // end foreach categories ?>
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="{{$filter['header']->CATEGORY_NAME}}">
                        <i class="{!! trans('laravelusers::forms.create_user_icon_role') !!}" aria-hidden="true"></i>
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
<?php if ($showDateSelect) { ?>
    &nbsp;/&nbsp; 
@include('includes.dateonly')
<?php } ?>
@include('includes.prefs_script')