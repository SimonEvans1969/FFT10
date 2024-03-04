@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Fix Zeros
@endsection

@section('content')
<?php $confirm = 1; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @include('includes.prefs2')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="zeros" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Rating</th>
                                <th>Response Text</th>
                                <th>Confirm?</th>
                            </tr>
                        </thead>
                        @foreach($data as $record)
                        <tr id="{{$record->TRUST_CODE}}|{{$record->FFT_ID}}|{{$record->QUESTION_NO}}" >
                            <td> 
                                <select class="browser-default zero_select" >
                                    <option <?php if ($record->RESPONSE_CODE == 0) echo ' selected '; ?>
                                            value='0'>0 - Don't know</option>
                                    <option <?php if ($record->RESPONSE_CODE == 1) echo ' selected '; ?>
                                            value='1'>1 - Very poor</option>
                                    <option <?php if ($record->RESPONSE_CODE == 2) echo ' selected '; ?>
                                            value='2'>2 - Poor</option>
                                    <option <?php if ($record->RESPONSE_CODE == 3) echo ' selected '; ?>
                                            value='3'>3 - Neither good nor poor</option>
                                    <option <?php if ($record->RESPONSE_CODE == 4) echo ' selected '; ?>
                                            value='4'>4 - Good</option>
                                    <option <?php if ($record->RESPONSE_CODE == 5) echo ' selected '; ?>
                                            value='5'>5 - Very good</option>
                                </select>
                            </td>
                            <td>{{$record->RESPONSE_TEXT}}</td>
                            <td style="text-align: center">
                                <i id="<?php echo $confirm++; ?>"
                                   class="fas fa-2x fa-check-circle zero_confirm"></i></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#zeros').DataTable({
        searching: false,
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
    
    $('.zero_select').change(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('zeros/save') }}",   
            data: { 
                    RESPONSE_CODE : $(this).val(),
                    TRUST_CODE : this.closest('tr').id.split("|")[0],
                    FFT_ID : this.closest('tr').id.split("|")[1],
                    QUESTION_NO : this.closest('tr').id.split("|")[2],
                  },
            success: function (result) {} 
        })
    });
    
    $('.zero_confirm').click(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('zeros/confirm') }}",   
            data: { 
                    TRUST_CODE : this.closest('tr').id.split("|")[0],
                    FFT_ID : this.closest('tr').id.split("|")[1],
                    QUESTION_NO : this.closest('tr').id.split("|")[2],
                    ID : this.id,
                  },
            success: function (result) {
                $("#"+result.success).closest('tr').remove();
                } 
        })
    });
});
</script>
@endsection
