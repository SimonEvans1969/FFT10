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
    &nbsp;/&nbsp; 
@include('includes.dateonly')
<span id="button_span" style="display:none">
     &nbsp;/&nbsp;  
    <input class="btn btn-primary" type="submit" value="Update" id="fft_submit" >
    </span>
<script>
$(document).ready(function() {
    // On load, clone all selects
    fft_prefs = {};
    $('.fft_pref').each( function () {
        fft_prefs[$(this).attr('id')] = $(this).clone();
    });
    
    // Set up Prefs on first time through
    setPrefs();
    
    // Manage prefs Updates
    $('#fft_submit').click(function() {
        $.ajax({
            type: "get",
            url: "{{ route('prefs/update') }}",   
            data: { fft_year : $('#fft_year').val(),
                    fft_month : $('#fft_month').val(),
<?php
    foreach ($filters as $filter) { 
        echo $filter['header']->CATEGORY_NAME . " : $('#" . $filter['header']->CATEGORY_NAME . "').val(),";   
    }
?>  
                  },
            success: function (result) {location.reload(true);} 
        })
    });    
    
    // Show the update button when something changes
    $('.fft_select').change(function() {
        $('#button_span').show();
    });
    
    $('.fft_pref').change(function() {
        setPrefs();
        $('#button_span').show();
    });
});
    
function setPrefs() {
    // Get the selected items
    var selected = {};
    $('.fft_pref').each( function () {
        
        if (($(this).val() != '') && ($(this).val() != null)) {
            selected[$(this).attr('id')] = $(this).val();
        }
    });
    // Now loop through the dropdowns
    $('.fft_pref').each( function () {
        // For any without a selection, limit the options by Parent
        if ($(this).val() != '') { // Do it for everyone
            var selectedNow = $(this).val();
            $(this).find('option').remove();
            $(this).append(fft_prefs[$(this).attr('id')].find('option').clone());
            // Reset the selection
            $(this).prop('selectedIndex',-1);
            // Now loop through the options and remove those that do not apply
            $(this).find('option').each( function () {
                // Reset the selection
                $(this).prop('selected',$(this).val() == selectedNow);
                
                if ($(this).attr('parents')) {
                    var el = $(this);
                    // Always skip the header row
                    if ($(this).attr('parents') != '*') {
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
                }
            });
        }
    });
    
    // And finally loop again and if only one row, hide the header; and if no rows hide the select
     $('.fft_pref').each( function () {
         var opt_count = 0
         $(this).find('option').each( function () {
             opt_count++;
         });
         
         switch (opt_count) {
             case 1 :
                $(this).closest('span').hide();
                 break;
             case 2 :
                $(this).children('option').first().prop( "disabled", true )
                $(this).children('option').eq(1).prop( "selected", true )
                 break;
             default :
                 $(this).closest('span').show();
                 $(this).children('option').first().prop( "disabled", false )
                 break;
         }
     });
}
</script>