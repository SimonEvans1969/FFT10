<div class="modal fade modal-danger" id="confirmEdit" role="dialog" aria-labelledby="confirmEditLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Confirm Edit
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to change the Patient's response?
                </p>
            </div>
            <div class="modal-footer">
                {!! Form::button('Cancel', array('class' => 'btn btn-light pull-left', 'type' => 'button', 'id' => 'cancel', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('Confirm', array('class' => 'btn btn-danger pull-right btn-flat', 'type' => 'button', 'id' => 'confirm', 'form' => 'edit_text_form' )) !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  $('#confirmEdit').on('show.bs.modal', function (e) {
  });

  $('#confirmEdit').find('.modal-footer #confirm').on('click', function(){
      // Make an XHR update call
      $.ajax(
          {type: "get",
           url: "{{ route('updateResponse') }}",
           data: {
               FFT_ID: $('.edit-modal-target').attr('fft_id'),
               QUESTION_NO: $('.edit-modal-target').attr('question_no'),
               NEW_TEXT: $('.edit-modal-target').text(),
           },
           success: function(result){
                 // Close the modal
                 $('#confirmEdit').modal('hide');
                    }
          });
  });
    
  $('#confirmEdit').find('.modal-footer #cancel').on('click', function(){
      $('.edit-modal-target').text($('.edit-modal-target').attr('orig-text'));
      $('#confirmEdit').modal('hide');                          
  });

</script>