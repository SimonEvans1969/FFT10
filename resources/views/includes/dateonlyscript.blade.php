<script>
$(document).ready(function() {
    $('.fft_select').change(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('prefs/update') }}",   
            data: { fft_year : $('#fft_year').val(),
                    fft_month : $('#fft_month').val()
                  },
            success: function (result) {location.reload(true);} 
        })
    });
});
</script>