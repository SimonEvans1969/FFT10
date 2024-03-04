@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Feedback
@endsection

@section('content')
<?php $edid = 1; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @include('includes.prefs')
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="feedback" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Type</th>
                                <th id='category_head' ></th>
                                <th>Rating</th>
                                <th>Improvement</th>
                                <th>Publish</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $record)
                                <tr>
                                    <td> 
                                        <?php 
                                            $dt = new DateTime("{$record->TRIGGER_DT_TM}");
                                            echo $dt->format('d-m-Y H:i');
                                        ?>
                                    </td>
                                    <td> 
                                        {{ $record->TYPE}}
                                    </td>
                                    <td> 
                                        <?php echo (is_null($record->SUBTYPE_DESCRIPTION) ?
                                                    '[' . $record->SUBTYPE . ']' :
                                                    $record->SUBTYPE_DESCRIPTION ); 
                                        ?>
                                    </td>
                                    <td> 
                                        {{ $record->RESPONSE_CODE}}
                                    </td>
                                    <td class="admin_edit" fft_id="<?php echo $record->FFT_ID; ?>"
                                                question_no="2" > 
                                        {{ $record->IMPROVEMENT}}
                                    </td>
                                    <td class="admin_edit" fft_id="<?php echo $record->FFT_ID; ?>"
                                                question_no="3" > 
                                        {{ $record->PUBLISH}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<?php // Admin users can edit
    if ( Auth::user()->role  == "Admin") { ?>
@include('edit_text.edit_text_modal')
<?php }?>

<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#feedback').DataTable({
        searching: true,
        columns: [
            { 'width' : '16%'},
            { 'width' : '15%'},
            { 'width' : '19%'},
            { 'width' : '7%'},
            { 'width' : '33%'},
            { 'width' : '10%'},
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
                title: 'FFT Feedback',
                messageTop: function () {
                    return ("Type: " + $('#fft_type').val() + 
                            "  Specialty: " + $('#fft_specialty').val() +
                            "  Location: " + $('#fft_location').val() +
                            "  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },
                autoFilter: true,
                sheetName: 'FFT Feedback',
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to pdf',
                title: 'FFT Feedback',
                messageTop: function () {
                    return ("Type: " + $('#fft_type').val() + 
                            "  Specialty: " + $('#fft_specialty').val() +
                            "  Location: " + $('#fft_location').val() +
                            "  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },   
            },
        ],
        order: [[ 0, 'desc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
});
    
$(document).ready(function() {
    $('#category_head').text(conv_to_title('<?php echo $category; ?>'));
});

<?php // Admin users can edit
    if ( Auth::user()->role  == "Admin") { ?>
$(document).ready(function() {
    $('.admin_edit').dblclick( function (e) {
        e.stopPropagation;
        this.contentEditable = true;
        $(this).addClass('alert-danger');
        $('.edit-modal-target').removeClass('edit-modal-target');
        $(this).addClass('edit-modal-target');
        $(this).attr('orig-text',$(this).text());
    });
    
    $('.admin_edit').blur( function () {
        if (this.isContentEditable) {
            if ($(this).text() != $(this).attr('orig-text')) {
                $("#edit_text_id").val($(this).attr('id'));
                $("#edit_text_text").val($(this).text());
                $("#confirmEdit").modal('show');
            }
            this.contentEditable = false;
            $(this).removeClass('alert-danger');
        }
    });
});
<?php } ?>
    
function conv_to_title(str) {
    var strl = str.replace(/_/g,' ').toLowerCase();
    return(str.substr(0,1) + strl.substr(1));
}

</script>
@endsection
