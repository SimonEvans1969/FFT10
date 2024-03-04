    @if( isset($extra) )
    {{ $extra }}&nbsp;/&nbsp;
    @endif
    <?php 
        $first = true;
        foreach ($filters as $filter) {
    ?>
<span>
    <?php
            if (!$first) { ?>
    &nbsp;/&nbsp;
    <?php   }
            $first = false;
    ?>

    <select class="browser-default custom-select fft_select fft_pref" id="{{$filter['header']->CATEGORY_NAME}}" style="width: 150px">
          <option value='*'
                  parents='*'
                >All {{$filter['header']->DESCRIPTION}}s</option>
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
</span>
    <?php } // end foreach filters ?>
<?php if ($showDateSelect) { ?>
    &nbsp;/&nbsp; 
@include('includes.dateonly')
<?php } ?>
<span id="button_span" style="display:none">
     &nbsp;/&nbsp;  
    <input class="btn btn-primary" type="submit" value="Update" id="fft_submit" >
    </span>
@include('includes.prefs_script')