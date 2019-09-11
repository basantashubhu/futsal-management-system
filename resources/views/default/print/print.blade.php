<html>
<head>
    <title>Title</title>
    <style>
        .body{
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
        }
        table.headerArea{
            width: 100%;
            margin-bottom: 20px;
        }
        table.headerArea tr td{
            width: 40%;
            font-family: 'Poppins', sans-serif;
        }
        table.options{
            width: 40%;
            float: left;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table.options tr td{
            padding: 5px;
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
        }
        table.options tr td:first-child{
            text-align: right;
        }
        table.dataTable{
            margin-top: 20px;
            width: 100%;
        }
        table.dataTable tr th{
            text-align: left;
        }
        table.dataTable tr th, table.dataTable tr td{
            padding: 5px;
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
        }
        /* table.dataTable tbody tr:last-child {
            font-weight: bolder;
        } */
    </style>
</head>
<body>
    <?php
    if(isset($request)){
        $request=$datas['request'];
        unset($datas['request']);
    }

    $table=$datas['table'];
    unset($datas['table']);
    ?>
<table class="headerArea">
    <tr>
        <td><img src="{{ base64_logo() }}" alt="Logo" style="background-color:white;display: block; height: 50px;filter: Alpha(opacity=100); opacity: 1;"></td>
        <td style="font-family: 'Poppins', sans-serif;font-size: 12px;">
            <strong>Foster Grandparents Program</strong>
        </td>
        <td style="font-family: 'Poppins', sans-serif;font-size: 11px; text-align: right;">
            <?php echo 'Date: ' . date('m/d/Y H:i:s');?><br>
            
        </td>
    </tr>
</table>
@if(array_key_exists('request', $datas))
    <?php 
        $r = $datas['request'];
        unset($datas['request']);
        $r = array_filter($r); 
    ?> 
@endif
@if(isset($r))
<table class="options">
    <tr>
        <td></td>
        <td><strong>Search Criteria</strong></td>
    </tr>
    @foreach($r as $d=>$v)
    <tr>
        <td>{{$d}}: </td>
        <td>@if($v==null) All @elseif(is_array($v)) {{implode(',', $v)}} @else {{$v}} @endif</td>
    </tr>
    @endforeach
</table>
@endif
<table class="dataTable" border="1"  cellpadding="0" cellspacing="0" style="border-collapse: collapse;" align="center">
    <caption style="font-family: 'Poppins', sans-serif; font-size: 12px; text-align: right; margin-bottom: 20px; font-weight: bold;">{{$table}}</caption>
    <thead>
        <tr>
            @foreach($fields as $field => $key)
            @if($key == "Estimated Amt")
                <th style="text-align: right;">{{$key}}</th>
            @else
                <th>{{$key}}</th>
            @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($datas as $da)
        <tr>
            @foreach($da as $k=>$v)
            @if($k == 'copay')
            <td style="text-align: right;">${{number_format($v,2)}}</td>
            @elseif($k == 'date' || $k == 'start_date' || $k == 'end_date' || $k == 'closed_date' || $k == 'hol_date')
            <td>@if($v != ''){{date('m/d/Y', strtotime($v))}}@endif</td>
            @elseif($k == 'cost')
            <td style="text-align: right;">{{$v}}</td>
            @else
            <td>{{$v}}</td>
            @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>