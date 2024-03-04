@extends('layouts.app')

@section('viewName')
Charts
@endsection

@section('content')
<div class="container" >
    <div class="row" style="width: 100%;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        {!! csrf_field() !!}
                        <div class="row" style="display:table-row; vertical-align:middle;">
                            <div class="col-md-2" style="display:table-cell; vertical-align:middle; width:10%;">
                                Chart Type:
                            </div>
                            <div class="col-md-10" style="display:table-cell; vertical-align:middle;">
                            <select class="browser-default custom-select fft_pref fft_select" name="chart_type" 
                                    id="chart_type" style="width: 200px">
                            <?php // calculate all menu entries
                                $type_opts = "<option parents='*' >Select the Chart Type...</option>";
                                $subtype_opts = "<option parents='*' >Select a Chart Option...</option>";
                                $sort_opts = "<option parents='*' >Select the Sort Order...</option>";
                                $selected = false;
                                foreach ($charts as $type => $chart)
                                {
                                    $selected = ($type == $prefs->chart_type) ? ' selected ' : ' ';
                                    $type_opts .= "<option value='$type' $selected >$type</option>";

                                    foreach ($chart as $subtype => $defn)
                                    {
                                        $selected = ($selected && ($subtype == $prefs->chart_subtype)) ? ' selected ' : ' ';
                                        $parents = json_encode([ 'chart_type' => $type]);
                                        $subtype_opts .= "<option value='$subtype' $selected 
                                                                  parents='$parents' >$subtype</option>";

                                        foreach ($defn['sort'] as $sort_id => $sort_params)
                                        {
                                            $selected = ($selected && ($sort_id == $prefs->chart_sort)) ? ' selected ' : ' ';
                                            $parents = json_encode([ 'chart_type' => $type,
                                                                     'chart_subtype' => $subtype]);
                                            $sort_opts .= "<option value='$sort_id' $selected 
                                                                   parents='$parents' >" . $sort_params['name'] . "</option>";
                                        }
                                    }
                                }
                                echo $type_opts;
                                ?>
                            </select>
                            &nbsp;/&nbsp;
                            <select class="browser-default custom-select fft_pref fft_select" name="chart_subtype" 
                                    id="chart_subtype" style="width: 150px">
                                <?php echo $subtype_opts; ?>
                            </select>
                            &nbsp;/&nbsp;
                            <select class="browser-default custom-select fft_pref fft_select" name="chart_sort" 
                                    id="chart_sort" style="width: 150px">
                                <?php echo $sort_opts; ?>
                            </select>
                            &nbsp;/&nbsp;
                            <select class="browser-default custom-select fft_pref fft_select" name="chart_category" 
                                    id="chart_category" style="width: 150px">
                               <option parents='*' >Select the X-axis category...</option>
                                <?php foreach ($categories as $category)
                                      {
                                        $selected = ($category->CATEGORY_NAME == $prefs->chart_category) ? ' selected ' : ' ';
                                        echo "<option parents='{" . '"chart_type":"This Month"' . "}' 
												value='$category->CATEGORY_NAME' $selected >
                                                $category->DESCRIPTION</option>";
                                      }
                                ?>
								<option parents='{"chart_type":"Compare Months"}' value='Month' 
									<?php if ($prefs->chart_type == "Compare Months") echo ' selected '; ?>
										>Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="height: 10px;"></div>
                    <div class="row" style="display:table-row; vertical-align:middle;">
                        <div class="col-md-2" style="display:table-cell; vertical-align:middle; width:10%;">
                            Filters:
                        </div>
                        <div class="col-md-10" style="display:table-cell; vertical-align:middle;">
                            @include('includes.prefs2')
                        </div>
                    </div>        
                </div>
                <div class="panel-body">
                    <canvas id="myChart" ></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php
                    $first_item = true;
                    foreach ($data as $datum)
                    {
                        echo ($first_item ? '' : ' , ') . "'" . addslashes($datum->{$prefs->chart_category}) . "'";
                        $first_item = false;
                    }
                ?>],
        datasets: [
            <?php 
                $datasets = $charts[$prefs->chart_type][$prefs->chart_subtype]['datasets'];
                foreach ($datasets as $dataset)
                    { ?>
            {
            label: <?php echo "'" . addslashes($dataset['title']) . "'" ?>,
            data: [
                <?php
                    $first_item = true;
                    foreach ($data as $datum)
                    {
                        echo ($first_item ? '' : ' , ') . round($datum->{$dataset['value']},2);
                        $first_item = false;
                    }
                ?>
            ],
            type: 'bar',
            borderWidth: 1,
            backgroundColor: <?php echo $dataset['backgroundColor']; ?>
            },
            <?php } // of foreach datasets ?>
        ],
    },
    options: {
        scales: {
            yAxes: [{
                id: 'left-y-axis',
                type: 'linear',
                position: 'left',
                ticks: {
<?php
    $axis = $charts[$prefs->chart_type][$prefs->chart_subtype]['axis'];
    if (is_array($axis)) {
        foreach ($axis as $param => $val)
        {
            echo "$param: $val,";
        }
    }
?>
                },
                stacked: true,
            }],
            xAxes: [{
                stacked: true,
            }]
        }
    }
});
</script>
@endsection

