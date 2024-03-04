    <select class="browser-default custom-select fft_select" id="fft_year" style="width: 150px">
        <?php
            $yr = 2019;
            $curr_year = intval(date('Y'));
            while ($yr <= $curr_year) {
                $yr_select = ($yr == intval("{$fft_prefs->FFT_YEAR}") ? ' selected ' : '');
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