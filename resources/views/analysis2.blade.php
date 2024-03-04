@extends('layouts.app')

@section('viewName')
Analysis
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
    <select class="mdb-select md-form fft_pref fft_select" id="category"
                       multiple style="width: 150px">
            <option value="" disabled selected>Select categories...</option>
          @foreach ($categories as $category)
                <option value='{{$category->CATEGORY_NAME}}' 
                        <?php
                            foreach ($selected as $sel_cat) {
                                if ($sel_cat == $category->CATEGORY_NAME) {
                                    echo ' selected ';
                                    break;
                                }
                            }
                        ?>
                        >{{$category->DESCRIPTION}}</option>
          @endforeach
    </select>
    
        </div>
        <div class="col-md-6">
            <div style="display: table; height:100%">
                <div style="display: table-cell; vertical-align: middle">
    &nbsp;/&nbsp;      
    <select class="browser-default custom-select fft_select" id="fft_year" style="width: 150px">
        <?php
            $yr = 2019;
            $curr_year = intval("{$fft_prefs->FFT_YEAR}");
            while ($yr <= $curr_year) {
                $yr_select = ($yr == $curr_year ? ' selected ' : '');
                echo "<option $yr_select >$yr</option>";
                $yr++;
            }
        ?>
    </select>
    &nbsp;/&nbsp;
    <select class="browser-default custom-select fft_select" id="fft_month" style="width: 150px">
        <option value="01" <?php if ("{$fft_prefs->FFT_MONTH}" == "01") echo " selected "; ?>>Jan</option>
        <option value="02" <?php if ("{$fft_prefs->FFT_MONTH}" == "02") echo " selected "; ?>>Feb</option>
        <option value="03" <?php if ("{$fft_prefs->FFT_MONTH}" == "03") echo " selected "; ?>>Mar</option>
        <option value="04" <?php if ("{$fft_prefs->FFT_MONTH}" == "04") echo " selected "; ?>>Apr</option>
        <option value="05" <?php if ("{$fft_prefs->FFT_MONTH}" == "05") echo " selected "; ?>>May</option>
        <option value="06" <?php if ("{$fft_prefs->FFT_MONTH}" == "06") echo " selected "; ?>>Jun</option>
        <option value="07" <?php if ("{$fft_prefs->FFT_MONTH}" == "07") echo " selected "; ?>>Jul</option>
        <option value="08" <?php if ("{$fft_prefs->FFT_MONTH}" == "08") echo " selected "; ?>>Aug</option>
        <option value="09" <?php if ("{$fft_prefs->FFT_MONTH}" == "09") echo " selected "; ?>>Sep</option>
        <option value="10" <?php if ("{$fft_prefs->FFT_MONTH}" == "10") echo " selected "; ?>>Oct</option>
        <option value="11" <?php if ("{$fft_prefs->FFT_MONTH}" == "11") echo " selected "; ?>>Nov</option>
        <option value="12" <?php if ("{$fft_prefs->FFT_MONTH}" == "12") echo " selected "; ?>>Dec</option>
    </select>
    <span id="button_span" style="display:none">
     &nbsp;/&nbsp;  
    <input class="btn btn-primary" type="submit" value="Update" id="fft_submit" >
    </span>
    </div></div></div></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="feedback" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Type</th>
<?php
foreach ($categories as $category) {
    foreach ($selected as $sel_cat) {
        if ($sel_cat == $category->CATEGORY_NAME) {
                echo "<th>$category->DESCRIPTION</th>";
                break;
        }
    }
}
?>

                                <th>Eligible</th>
                                <th>Responses</th>
                                <th>Response Rate %</th>
                                <th>5</th>
                                <th>4</th>
                                <th>3</th>
                                <th>2</th>
                                <th>1</th>
                                <th>0</th>
                                <th>Positive %</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#feedback').DataTable({
        processing: true,
        serverSide: false,
        searching: false,
        ajax: { url: '{{ route('analysis2/getdata') }}',
               data: function ( d ) {
                        d.category = $('#category').val();
                        //d.category = 'SPECIALTY';
                        d.fft_yr = $('#fft_year').val();
                        d.fft_mth = $('#fft_month').val();
              },
        },
        columns: [
            {data: 'TYPE'},

<?php
foreach ($categories as $category) {
    foreach ($selected as $sel_cat) {
        if ($sel_cat == $category->CATEGORY_NAME) {
                echo "{data: '$category->CATEGORY_NAME'},";
                break;
        }
    }
}
?>
            {data: 'ELIGIBLE'},
            {data: 'RESPONSE_COUNT'},
            {data: 'RESPONSE_RATE',
             render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    return parseFloat(data).toFixed(2) + '%';}
            },
            {data: 'SCORE_5_COUNT'},
            {data: 'SCORE_4_COUNT'},
            {data: 'SCORE_3_COUNT'},
            {data: 'SCORE_2_COUNT'},
            {data: 'SCORE_1_COUNT'},
            {data: 'SCORE_0_COUNT'},
            {data: 'POSITIVE_RATE',
             render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    return parseFloat(data).toFixed(2) + '%';}
            },
        ],
        dom: 'frtiB',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copy to clipboard'
            },
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'FFT AllStats',
                messageTop: function () {
                    return ("  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },
                autoFilter: true,
                sheetName: 'FFT AllStats',
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to pdf',
                title: 'FFT AllStats',
                messageTop: function () {
                    return ("  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },   
            },
        ],
        order: [[ 0, 'asc'], [1, 'asc'], [2, 'asc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
});

$('#fft_submit').click(function() {
    $.ajax({
            type: "get",
            url: "{{ route('prefs/update') }}",   
            data: { fft_year : $('#fft_year').val(),
                    fft_month : $('#fft_month').val(),
                    fft_analysis_cats : JSON.stringify($('#category').val()),
                  },
            success: function (result) {location.reload(true);} 
        })
});    
    
$('.fft_select').change(function() {
    $('#button_span').show();
});

$(document).ready(function() {    
    $('#feedback tbody').on('click', 'tr', function () {
        window.location.href = "{{url('feedback')}}" 
                        + '?type=' + encodeURIComponent($(this).children('td:nth-child(1)').text())
                        +
<?php
            // SDE TO DO XXX
?>
                        + '&category=' + encodeURIComponent($('select#category').val())
                        + '&subtype=' + encodeURIComponent($(this).children('td:nth-child(2)').text());
    } ) 

    $('.mdb-select').materialSelect();
});
</script>
@endsection
