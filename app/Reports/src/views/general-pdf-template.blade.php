<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		body {
			font-family: "italic";
		}
		.wrapper {
			margin: 0 -25px 0;
			padding: 0 15px;
		}
		.middle {
			text-align: center;
			margin-top: -100px;
		}
		.title {
			font-size: 22px;
		}
		.pb-10 {
			padding-bottom: 10px;
		}
		.pb-5 {
			padding-bottom: 5px;
		}
		.head-content{
			padding-bottom: 2px;
			border-style: none none ridge none;
			font-size: 18px;
		}
		table.table {
			font-size: 13px;
			border-collapse: collapse;
		}
		.page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
		tr.even {
			background-color: #1D1DD499;
		}
		table .left {
			text-align: left;
		}
		table .right {
			text-align: right;
		}
		table .bold {
			font-weight: 600;
		}
		.bg-black {
			background-color: #000;
		}
		.f-white {
			color: #fff;
		}
		.luis {
			font-size: 12px;
			position:fixed;
			left:0px;
			bottom:0px;
			height:30px;
			width:100%;
		}
		.tatuco{
			padding-bottom: 100%;
			border-style: none none ridge none;
			font-size: 18px;
		}
		.date{
			font-size: 12px;
		}
		.logo{
			text-align: right;
		}
		@foreach ($styles as $style)
        {{ $style['selector'] }} {
		{{ $style['style'] }}
}
		@endforeach
	</style>
</head>
<body>
<?php
use Carbon\Carbon;$ctr = 1;
$no = 1;
$currentGroupByData = [];
$total = [];
$isOnSameGroup = true;
$grandTotalSkip = 1;
$espacio = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
foreach ($showTotalColumns as $column => $type) {
    $total[$column] = 0;
}
if ($showTotalColumns != []) {
    foreach ($columns as $colName => $colData) {
        if (!array_key_exists($colName, $showTotalColumns)) {
            $grandTotalSkip++;
        } else {
            break;
        }
    }
}
?>
<div class="wrapper">
	<div class="pb-5">
		<div class="logo"><img width="200" height="100" src="<?php echo $headers['icon']; ?>" >
		</div>
		<div class="middle pb-10 title">
			{{ $headers['acc_nam'] }}
			<br/>
			{{ $headers['acc_ruc'] }}
			<p>{{ $headers['title'] }}</p>
		</div>

			<div class="head-content">
				@if( $headers['meta'] )
				<div class="date">Fecha:</div>
				@endif
					<?php $metaCtr = 0; ?>
					@foreach($headers['meta'] as $name => $value)
						@if ($metaCtr % 2 == 0)
								@endif
								<div class="date"><?php echo $espacio;?>{{$name }}: {{ ucwords($value) }}</div>
								@if ($metaCtr % 2 == 1)
						@endif
						<?php $metaCtr++; ?>
					@endforeach
			</div>

	</div>
	<br/>
	<div class="content">
		<table width="100%" class="table">
			<thead>
			<tr>
				<th class="left">Nro</th>
				@foreach ($columns as $colName => $colData)
					@if (array_key_exists($colName, $editColumns))
						<th class="{{ isset($editColumns[$colName]['class']) ? $editColumns[$colName]['class'] : 'left' }}">{{ $colName }}</th>
					@else
						<th class="left">{{ $colName }}</th>
					@endif
				@endforeach
			</tr>
			</thead>
            <?php
            $chunkRecordCount = ($limit == null || $limit > 300) ? 300 : $limit;
            $__env = isset($__env) ? $__env : null;
            $query->chunk($chunkRecordCount, function($results) use(&$ctr, &$no, &$total, &$currentGroupByData, &$isOnSameGroup, $grandTotalSkip, $headers, $columns, $limit, $editColumns, $showTotalColumns, $groupByArr, $__env) {
            ?>
			@foreach($results as $result)
                <?php
                if ($limit != null && $ctr == $limit + 1) return false;
                if ($groupByArr != []) {
                $isOnSameGroup = true;
                foreach ($groupByArr as $groupBy) {
                if (is_object($columns[$groupBy]) && $columns[$groupBy] instanceof Closure) {
                $thisGroupByData[$groupBy] = $columns[$groupBy]($result);
                } else {
                $thisGroupByData[$groupBy] = $result->{$columns[$groupBy]};
                }
                if (isset($currentGroupByData[$groupBy])) {
                if ($thisGroupByData[$groupBy] != $currentGroupByData[$groupBy]) {
                $isOnSameGroup = false;
                }
                }
                $currentGroupByData[$groupBy] = $thisGroupByData[$groupBy];
                }
                if ($isOnSameGroup === false) {
                echo '<tr class="bg-black f-white">
		    							<td colspan="' . $grandTotalSkip . '"><b>Grand Total</b></td>';
                $dataFound = false;
                foreach ($columns as $colName => $colData) {
                if (array_key_exists($colName, $showTotalColumns)) {
                if ($showTotalColumns[$colName] == 'point') {
                echo '<td class="right"><b>' . number_format($total[$colName], 0, ',', '.') . '</b></td>';
                } elseif ($showTotalColumns[$colName] == 'idr') {
                echo '<td class="right"><b>IDR ' . number_format($total[$colName], 0, ',', '.') . '</b></td>';
                } elseif ($showTotalColumns[$colName] == '$') {
                echo '<td class="right"><b>$ ' . number_format($total[$colName], 2, ',', '.') . '</b></td>';
                }
                $dataFound = true;
                } else {
                if ($dataFound) {
                echo '<td></td>';
                }
                }
                }
                echo '</tr>';//<tr style="height: 10px;"><td colspan="99">&nbsp;</td></tr>';
                // Reset No, Reset Grand Total
                $no = 1;
                foreach ($showTotalColumns as $showTotalColumn => $type) {
                $total[$showTotalColumn] = 0;
                }
                $isOnSameGroup = true;
                }
                }
                ?>
				<tr align="center" class="{{ ($no % 2 == 0) ? 'even' : 'odd' }}">
					<td class="left">{{ $no }}</td>
					@foreach ($columns as $colName => $colData)
                        <?php
                        $class = 'left';
                        // Check Edit Column to manipulate class & Data
                        if (is_object($colData) && $colData instanceof Closure) {
                        $generatedColData = $colData($result);
                        } else {
                        $generatedColData = $result->{$colData};
                        }
                        $displayedColValue = $generatedColData;
                        if (array_key_exists($colName, $editColumns)) {
                        if (isset($editColumns[$colName]['class'])) {
                        $class = $editColumns[$colName]['class'];
                        }
                        if (isset($editColumns[$colName]['displayAs'])) {
                        $displayAs = $editColumns[$colName]['displayAs'];
                        if (is_object($displayAs) && $displayAs instanceof Closure) {
                        $displayedColValue = $displayAs($result);
                        } elseif (!(is_object($displayAs) && $displayAs instanceof Closure)) {
                        $displayedColValue = $displayAs;
                        }
                        }
                        }
                        if (array_key_exists($colName, $showTotalColumns)) {
                        $total[$colName] += $generatedColData;
                        }
                        ?>
						<td class="{{ $class }}">{{ $displayedColValue }}</td>
					@endforeach
				</tr>
                <?php $ctr++; $no++; ?>
			@endforeach
            <?php }); ?>
			@if ($showTotalColumns != [] && $ctr > 1)
				<tr class="bg-black f-white">
					<td colspan="{{ $grandTotalSkip }}"><b>Grand Total</b></td> {{-- For Number --}}
                    <?php $dataFound = false; ?>
					@foreach ($columns as $colName => $colData)
						@if (array_key_exists($colName, $showTotalColumns))
                            <?php $dataFound = true; ?>
							@if ($showTotalColumns[$colName] == 'point')
								<td class="right"><b>{{ number_format($total[$colName], 0, ',', '.') }}</b></td>
							@elseif ($showTotalColumns[$colName] == 'idr')
								<td class="right"><b>IDR {{ number_format($total[$colName], 0, ',', '.') }}</b></td>
							@elseif ($showTotalColumns[$colName] == 'idr')
								<td class="right"><b>$ {{ number_format($total[$colName], 2, ',', '.') }}</b></td>
							@endif
						@else
							@if ($dataFound)
								<td></td>
							@endif
						@endif
					@endforeach
				</tr>
			@endif
		</table>
	</div>
	<div class="luis"><b>Usuario: </b>{{$headers['foot']}} <b>Fecha:</b> <?php echo Carbon::now()->format('l j F Y H:i');?></div>
</div>




<script type="text/php">
	    	@if (strtolower($orientation) == 'portrait')
		if ( isset($pdf) ) {
            $pdf->page_text(30, ($pdf->get_height() - 26.89), "Date Printed: " . date('d M Y H:i:s'), null, 10);
            $pdf->page_text(($pdf->get_width() - 84), ($pdf->get_height() - 26.89), "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10);
        }
@elseif (strtolower($orientation) == 'landscape')
		if ( isset($pdf) ) {
            $pdf->page_text(30, ($pdf->get_height() - 26.89), "Date Printed: " . date('d M Y H:i:s'), null, 10);
            $pdf->page_text(($pdf->get_width() - 84), ($pdf->get_height() - 26.89), "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10);
        }
@endif
</script>
</body>
</html>