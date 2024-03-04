@extends('layouts.app')

@section('viewName')
Missing Reference Data
@endsection

@section('content')
<div class="container">
	@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
	@endif
    <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                @include('includes.dateonly')
        						@include('includes.dateonlyscript')
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="category_tbl" class="table table-hover table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Code</th>
                                    <th>No. of Records</th>
                                </tr>
                            </thead>
							<tbody>
								@foreach($missing as $record)
									<tr>
										<td category-name="{{ $record->CATEGORY_NAME }}">{{ $record->DESCRIPTION }}</td>
										<td>{{ $record->CATEGORY_VALUE }}</td>
										<td>{{ $record->COUNT }}</td>
									</tr>
								@endforeach
							</tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('refdata.new_code_modal')
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#category_tbl').DataTable({
        searching: false,
        order: [[ 0, 'asc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
	
<?php if (Auth::user()->role == "Admin") { ?>    
	$('#category_tbl tbody').on('click', 'tr', function () {
		var td_count = 1;
		$(this).children("td").each(function() {
			switch (td_count++) {
				case 1:
					$("#CodeSet_modal").text($(this).text());
					$("#CATEGORY_NAME").val($(this).attr('category-name'));
					break;
				case 2:
					$("#CATEGORY_VALUE").val($(this).text());
					$("#oldCATEGORY_VALUE").val($(this).text());
					break;
			}
		});
        $("#Action_modal").html('Add code for ');
		$('#newCodeModal').find('#_ACTION').val('store');
        $("#newCodeModal").modal('show');
	});
	
	$("#newCodeModal").find('form').on('submit',function (){
		$("#newCodeModal").find('form').prop('action', $("#_ACTION").val());
	});
});
<?php if ($errors->any()) { ?>
	$(document).ready(function() {
		$("#CodeSet_modal").text($('#category').val());
		$("#CATEGORY_NAME").val($('#category').val());
        $("#newCodeModal").modal('show');
	});
<?php } // end errors 
	} // end admin ?>	
</script>
@endsection
