@extends('layouts.app')

@section('viewName')
Reference Data
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
                                <select class="browser-default custom-select" id="category" style="width: 150px">
            <option value="" 
					<?php
                         	if (old('CATEGORY_NAME') == '') echo " selected "; 
                        ?>
					selected>Select Ref Data Set...</option>s
          @foreach ($categories as $category)
                <option value='{{$category->CATEGORY_NAME}}' 
                        <?php
                         	if ($CATEGORY_NAME == $category->CATEGORY_NAME) echo " selected "; 
                        ?>
                        >{{$category->DESCRIPTION}}</option>
          @endforeach
    </select>
                            </span>

                            <?php 
                                // Commented out for now
                                if (Auth::user()->role  == "Admin") { ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-sm btn-warning btn-block 
							<?php 
								if (old('CATEGORY_NAME') == '') echo " disabled " 
							?>
										  " data-toggle="tooltip" 
								   data-placement="left" id="newCode" title="New Code" >
                                            <i class="fas fa-plus-square"></i>
                                        Add New Code
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="category_tbl" class="table table-hover table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Parents</th>
                                </tr>
                            </thead>
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
        processing: true,
        serverSide: false,
        searching: false,
        ajax: { url: '{{ route('refdata/getdata') }}',
               data: function ( d ) {
                        d.category_name = $('#category').val();
              },
        },
        columns: [
            {data: 'CATEGORY_VALUE'},
            {data: 'DESCRIPTION'},
            {data: 'PARENTS',
                render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    parStr = '';
        
                    if (!data) return(null);
        
                    try {
                        parents = JSON.parse(data.replace(/&quot;/g, '\"'));
                    } catch (e) {
                        return('ERROR');
                    }
                    
                    $.each( parents, function( key, value ) {
                        parStr += key + ' : ' + value + '<br/>';
                    });

                    return (parStr);
                }

            },
        ],
        order: [[ 0, 'asc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
    
    $('#category').on('change', function () {
    	$('#category_tbl').DataTable().ajax.reload();
		
	   	if ($('#category').val() == '') 
			$('#newCode').addClass('disabled')
	   	else
			$('#newCode').removeClass('disabled');
    });
	
	if ($('#category').val() == '') 
			$('#newCode').addClass('disabled')
	   	else
			$('#newCode').removeClass('disabled');
	
<?php if (Auth::user()->role == "Admin") { ?>    
    $('#newCode').on('click', function() {
        $('#newCodeModal').find('.modal-input').val('');
        $('#newCodeModal').find('.selectpicker').selectpicker('refresh')
        $('#newCodeModal').find('.help-block').each( function() { $(this).html("")});
        $("#Action_modal").text('Add new code for ');
        $("#CodeSet_modal").text($('#category').val());
        $("#CATEGORY_NAME").val($('#category').val());
		$('#newCodeModal').find('#_ACTION').val('refdata/store');
        $("#newCodeModal").modal('show');
    });

	$('#category_tbl tbody').on('click', 'tr', function () {
		var td_count = 1;
		$(this).children("td").each(function() {
			switch (td_count++) {
				case 1:
					$("#CATEGORY_VALUE").val($(this).text());
					$("#oldCATEGORY_VALUE").val($(this).text());
					break;
				case 2:
					$("#DESCRIPTION").val($(this).text());
					break;
				case 3:
					var array = $(this).html().split("<br>");
					for (i=0;i<array.length;i++){
						var name_val = array[i].split(" : ");
						if (name_val[0]) {
							var cat_array = name_val[1].split(",");
							$('#newCodeModal').find('#' + name_val[0]).val(cat_array);
						}
					}
					$('#newCodeModal').find('.selectpicker').selectpicker('refresh')
					break;
			}
		});
        $("#Action_modal").html('Update	code for ');
		$("#CodeSet_modal").text($('#category').val());
		$("#CATEGORY_NAME").val($('#category').val());
		$('#newCodeModal').find('#_ACTION').val('refdata/update');
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
