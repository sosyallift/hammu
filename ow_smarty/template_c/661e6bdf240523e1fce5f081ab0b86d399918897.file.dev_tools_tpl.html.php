<?php /* Smarty version Smarty-3.1.12, created on 2015-05-12 01:29:47
         compiled from "/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/components/dev_tools_tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:81823792655518fcb10df34-49636361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '661e6bdf240523e1fce5f081ab0b86d399918897' => 
    array (
      0 => '/homepages/11/d222791150/htdocs/Hammulandingpage/hammu/ow_system_plugins/base/views/components/dev_tools_tpl.html',
      1 => 1430993603,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81823792655518fcb10df34-49636361',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'oxwall' => 0,
    'profiler' => 0,
    'memoryUsage' => 0,
    'requestHandler' => 0,
    'renderedItems' => 0,
    'events' => 0,
    'database' => 0,
    'clrBtnUrl' => 0,
    'query' => 0,
    'cmp' => 0,
    'event' => 0,
    'listener' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_55518fcb1f71e9_33698383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55518fcb1f71e9_33698383')) {function content_55518fcb1f71e9_33698383($_smarty_tpl) {?><style>
    span.dev_tools_item{
        color:#2f2f2f;
        display:inline-block;
        min-height:24px;
        border-right:1px solid #ccc;
        padding:7px 10px 3px 2px;
    }
    span.dev_tools_item i{
        letter-spacing:2px;
		cursor:pointer;
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAADR0lEQVR4nGJgoBAAAAAA//9iRBfYtWtX7e/ff6L+/P2rARNjYWa+wcrKsszNza0ZXT0AAAD//4IbsGfPHuev376vYmdjFxIVE2EQ4OdnYGBkZPj39x/Dx08fGd68fsvw89fPd9xcnGEuLi57YfoAAAAA//9ihGn+8vXbFhERYQ45WVkGbm5uhlu3bjH8+PGDQUREhEFSUpLh27dvDI+fPGF4/frNDx5uLh+YIQAAAAD//wTBwQkAIQwAweUkIW+DT71GUrHlqc8IznwiYmufWWu1fwxUlcyktUZEUErh3ouqMnrH3W3tM0XEAB4AAAD//wTBsRGAMAwEwRvm3YATMIQK3KO7UntS8OxemXmkMb93YZvupqqICCSx96aq6G5ss54baczMPAA/AAAA//88yCEWwDAIRMH/qlt6utzfYzAhi4K6jpxr51lmN91NVSEJSUQEmYm7/1dVzAyvPew8C+ADAAD//2L59OmThqKCPMP3798Z/v79Cw/dM2fOwNmamppwNjMzMwMXFyfDp0+fNBgYGBgAAAAA//88yrEJAEAMA7Ej/JLZNzsZXJjv3KnQk4RtbJOkcXfru6tnBgBJAHwAAAD//2L5/v07w9ev3xj+///H8Pv3b6yJ5ePHj3A2CwsLAxMTE9wAAAAAAP//YmFjY7376tVLZT4+PoZPnz5hNeDDhw9wNh8fH8PHT58Y2NhY7zIwMDAAAAAA//9iEhQU3Pnk6TOGv3//Mnz//p3h06dPGAbBxGDh9PTpMwZBQcGdDAwMDAAAAAD//0zRwQkAIAwEwcUC7h/LtdXrQCLkFfyJ08KMGbFO5raNpLfxqyq6G0nY5mTuGbEALgAAAP//BMExDoAgEADBlcJLrhf5DLZ28lbsbOUziD0JFhdnJoCc836XcoY1zN4vjDHovWNmOOdQVUSE1l7qU78txiOldAH8AAAA//+C54X169d77Nm7dxUnBwevqJgYAzc3NwPD//8MTExMDF++fIGkhx8/Prs4O4cFBgbugOkDAAAA//9iZGRk5GBkZORmZGTknzlzpsL9+/dznzx9av/x4ydBmCJ+Pr73kpISRzQ1NTuSkpKe/vv37z0DA8OP/////wEAAAD//wMAa0BF3lzxB5oAAAAASUVORK5CYII=);
		background-position:3px 50%;
		padding:2px 0 2px 25px;
		background-repeat:no-repeat;
    }
	
	span.dev_tools_item i.request{
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAD8ElEQVR4nGJkwAHWrFmz7fv3754MDAwMnJyc20NCQrywqQMAAAD//2KBMTZv3lzw9evXWF5e3mZvb+8NX79+NbSzs2NgYGBgOHTokCEDAwPD1q1bYz9//lzAzc292NfXdwIDAwMDAAAA//9ihGn+/v17v5aWFsP169cZfv/+vYuBgcHN0dGRgYGBgWH//v0MDAwMR1hZWW00NTUZrl27xsDJyVno6+s7AQAAAP//BMGhFcAwCEDB3/diskGQWGQ7DvMxTitjI5MNMIjeXQAR8ZrZPcagqlhrISL03gHITPbeqCqtNc45zDk/d39+AAAA//8EwbERAEEMArGdDwkoglavRDfi2CQvfQC238ywu7QlCZJoy90hiSS0ZXeZGWw/gB8AAP//NNAxFYBQCEDRx+T+FxJwaKIxyEYMTcKhAdNfHZ28Ea78B5l5r7VOdwegu5mZV0REVQ8zA6Cq2Hs/EXEBfAAAAP//AEEAvv8BoaGhtvPz8zEHBwcYLy8vABAQEADW1tYA9fX1vl5eXksAAAAAoqKitQsLC0IqKioA8PDwANHR0QD5+fnoDQ0NzwAAAP//BMGxDcAgDEXBFyigzTZ/KKZB8k4Wy6SFAjt3z5wzJdFaIyKICNZae4zx3ns3QK21m9knqWcmpRTOObg7PwAAAP//PM/BDQAxCAOwnLgH7L8lAxAihNRX6w38k0Rmwt1hZogIzMyrXZK+qoIk7C66GyRxAAAA//8EwaENADAIBEDyphUEpv9dmnocQ6A7AUH1Dqp6M/NFhFSVdLeY2SJ5AGwAm+Rx9zUzUlUSEZKZT1XvBwAA//+C29TZ2bn/z58/DqqqqgxCQkIMd+/eZXj+/PlPBgYGBklJSXZlZWWGd+/eMdy+fZuBhYXlZHl5uQUDAwMDAAAA//9iZGBgYFi2bFnohQsXVuno6DD8+vWLgY2NjUFMTIyBgYGBgYmJieHfv38Mr169gstduXKFwcDAIDkqKmoeAAAA//8EwaERwEAIRcEnIhncF7SZBq6TtEUJSE6gmew+AJl5JDEzzAxVhbsjid3l3kt3ExGYGZLIzBf4fgAAAP//BMGhDcBADATBVch14e6/lcCQMzCw9EVY5pl5ACLi2KaqyEwkffdeZobdpbuR9GYmVYVtIuIA/AAAAP//BMGxCcAwDATAJxoppSDwa6R/MoQHsEb0Aga1br7O3QUAkmZmjohYJL+qum2f7sbeG7ZPVT0k34hYmTkkTQD4AQAA//+CBSIzIyMjBxMTkwAjIyMvExOTQHh4+KynT5/qMjAwMEhLS19ZuXJlxv///7/9+/fv4////z/8////2////38CAAAA//8DAKB9gEicuASeAAAAAElFTkSuQmCC);
	}
	
	span.dev_tools_item i.elements{
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAC60lEQVR4nHTBsQEAEQAEwd2M2rxqURvZfSoxI5cx11aLCkASkpz+tcrDDwAA//9iQeb8//+fQ1hIkIGdnZ2BkZGR4devXwyvXr/hwKWZgYGBAQAAAP//YmRgYGDYuGnzd3Z2Ng5GRkaGb1+/MrCwQMz99+8fAycnF8Pf//8Zfv38ycDIyMjAzMz0xNvLSxZmAAAAAP//YmFgYGD49/cvh5KiIgMHBwcDMzMzA8wLjIyMDP/+/WP4/v07w+XLVxikpCQZXr56LYPsAgAAAAD//2KB2cTExMTw6tUrBkZGRjiGGcLPz8/w798/hocPHzKwsXMwbNi46T8zE9MTX18fWQAAAAD//2TMMRGAQAwAsCx1gYVe/St5xvroHWVgJALyBbugu38BVJVnV2aKCDPjnPuCFwAA//9kziEOADAMw0CX5TH9/+u6pGQaGTQ4ye8gCd394aoiCbYBmBkkcW4vAAAA//9kzjERADAIBMHVgBj8W3glOGDS0UTA7dwBMDPfPlSV3ZUEdPc1DwAA//9Mz7ENACEMBDAX9NkF2H+xS6TvXkxgeUES3f0XXh2qShL3bDAzkoAPAAD//1TLsQ0AIQwEMAt9ly3Yf7uIk0JF/e79QU7MjL23tdYvw71XTnQ3qCpJwAMAAP//bNAhAQBBCACw1aAJ/TU9KHCHQJ14+wUm9gFz7a7u/k2MCDNXVYHMdM8BDwAA//+CGgBxwYMHDzCcDwuDb9++MRgZGTIwMjIy/Pjxg+Hrt68MDAwMDAAAAAD//2zQoREAQAgDwSsilv5rwzOfSAT2G1ixB9gkoaq+iUl4Nt0NgCRmDlgAAAD//zzQsQ0AIAgAwSukYv9NRVoLiQt8PregJ7BnC98CIkJ3y0xQVU49gwsAAP//gofBp0+fGNjY2FCcDgMfP35k+PbtK8OevfugIv8Z/vz9/Y6BgYEBAAAA//9iYWBgYODm4n69a/duUQydSEBYSPh1X1+vGLo4AAAA//8DADK2+ZMUovJPAAAAAElFTkSuQmCC);
	}
	
	span.dev_tools_item i.database{
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACaUlEQVR4nGJgoBAAAAAA//9iZGBgYNi0ect/Tk5Ohi9fvjD8/fOHoCZ+AQGGnz9/Mvh4ezECAAAA//90y0ERACAMA8F74CMD+BdEMVATmaCA/e8AsM1eE9tIIsk3dzdJOHUBeAAAAP//dMwBCQAwDMCwwg7zL7j9FTwCcgAqZoYKFfUbqOwutwB4AAAA//+CG/D/PwPDnz9/4BgX+P37NwMbGxvDv38QVwIAAAD//0Iy4B/Dr1+/GP7+/cvw8+dPvAYwMDAw/PsPcQEAAAD//4IbAJP88+cPAxMTE14v/P//H64HAAAA//9iYWBgYPj/7x/D////GX7//s1w9+5dnJphlggKCsLDAAAAAP//QvLCfwZeXl4GRkZGvAbAAMwLAAAAAP//QjHgz58/DM+ePWP49OkTTo2srKwMJiYmcC8AAAAA//9k0TEVADAIxNC4wA3+B+oCByw8rkMHxkrIz2fQ3bg7mQmAmSFdpCHiUFVs9l54AAAA//800NEJACAMxNCo6ATdf5nSobyC+qEuEMirP7DWNchMzAx3JyLofVBbY1OQJpIu4ls4AAAA//8s0rENwCAMRcFX0Fnef0VCQRqSL4OFUpAJrrkCMH/Z3YkIer/JTMyMejUk8UqM8bD3iZbrXPkAAAD//wTBsQ2AMAxFwSeDXKUJG3gMYIUwE2IuMlIoXPORuJsBllqvu/dz31YiAnentQMzo5SCJF6JyeCTyEzGeAD4AQAA//+CB/miRYsqLl261Pjr12+2f///Mfz9gz05M7MwMzAxMjH8+/+PYcrkyYwAAAAA//8iKsrwAQAAAAD//wMA9JsanVaBG6QAAAAASUVORK5CYII=);
	}
	
	span.dev_tools_item i.page{
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAADWElEQVR4nGJgoBAAAAAA//9iRBfYt2+f+K9fv2f8+fvX7t+//0IwcSYmxncszMyH2NhYM5ycnF7CxAEAAAD//0IxYNfu3dnfv//skZWV4ZCTlWHg5OSEy33//p3h0eMnDI8fP/nBycle4ubqOpWBgYEBAAAA//+CG7Br167sHz9/TTE2MmJgY2NluHr1KsOLFy/gBkhISDBoa2sz/Pr1m+HsuXMMHOxsOW5ublMBAAAA//9ihDn7/YdPD0xMjDhYmJkZzp49y6Cjo8MgIyPD8OzZcwYpKUmGJ0+eMFy5coXB2NiY4c/fvwxnzpz7ISjApwAAAAD//wTBsRHAIAwEwZuPRAOMIvXyXVKbIts9AKl3BbDPXZkzRgTdjW2qCkk874ckqgrbdDcjgswZ+9z1AwAA//88xrERgDAQA8EbIjXAE6gX998BdifKRMZGewEkWc8MSbCNJNrSlnef/5KwTRLmHpKsDwAA//88z6kVwDAMRMH/1lzABWz/LcQ5ShIUsUCY6bARQO+ekshMbJ/3db9EBOv5jtmmqhhD9O75AwAA//8EwYENgCAQBLBycQp1/8XAJSA8thdUlbWWJJI454DeB9h76+PzPrck5pxaa6rKDwAA//9EzrENgDAQBDCLJvsvBKIBMU7K4/URJZ7AG/RqVSUJ/OUxzDm9if04XfcDkqgqvdoHAAD//2KBeOH3+7dv3wkyMzMxfPz4kYGXl5eBgYGBITIiFO7012/eMOzevY9BW0uD4efPnwxfvn5l+PP793sAAAAA//9UybEJQCEQRMGHwRagnQn+iu3iAq+Q5TATfjDRNABJ+2Rim4jANlX1M3rnW/N9nkTSvgAAAP//PM+xEcAgDATBGxeBKqTgL8JIJEo+IsKZt4N9ACLGXO86WRvbSKK7/8q9l+5GErbJ2mTWiRjzAwAA//+Cp8SVK1cVXLh4sV9NVZVBRESYgY2NDT2bMPz69YvhzZu3DLdu32Yw0NcvDA8PmwAAAAD//0LJC8uWLS86ffpMu7CwEJuEhAQDFxciL3z9+o3h2bNnDB8+fPxlampSGRUV2cfAwMAAAAAA///CyI27du2SuHTp0sKHDx9bfvnymRcmzsPD+1leXva4np5evJubGzyTAAAAAP//AwDOcl3oTZcIxgAAAABJRU5ErkJggg==);
	}
	
    span.dev_tools_item i.events{
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAC2UlEQVR4nGJkwAFWrlq14PHjJ/EMDAwMsrIyC8PDwhKwqQMAAAD//wTBsQ2AIBCG0Q8auAQHcAxXcDFZyoYRLHEMapv7c4nvJYAxxj7ne6ecj601qhlrLSQhOZKwariEu1NLeXq/zoj4fgAAAP//YmRgYGCoqam9KCIioqerq8PAy8vLwM7OzvD7zx+GP79/M/z6/Zvh969fUMN+M/z8+ZPh4qVLDFycXAcrKyscAAAAAP//BMGhAcAwCADBF0WyAj6mA2T/ZpVgYoGgevcAuPs7xmDvzTkHVaW7yUyqioggM7n3IiKYGetbE+AHAAD//yTOsQ2AMAxE0V/QEMmW2H+lZIMwA7R3LkzBm+AdAN39zLWujCAyGOf4uzJVRhK2sAtb7H0TmS/ABwAA//8EwSESgCAQQNG/ZIdAsEuQIHCRnYGkXkvNck9J+J4BaO11vX94v8AYxLhxHjvWTuScqLUgIoSwoqqIEZ77mgF+AAAA//880cEJwEAIRcGHJ2+iG7D/NuWz5pS0MGOf5t6lqpBEd+PuzAyZSUQgCTPjnIe9+y+8AAAA//+CG/DvP0KQi4sLzmZlZYWz//37x8DA8B9FLQAAAP//QnLBP1xJAhP8R6gFAAAA///C6gK8ev8zMPxF8gIAAAD//0K44D+xLviP4gIAAAAA//9CCURiACMjI8M/JLUAAAAA//9C8cJ/qDe+ffsGV/D792+EYiYmhv9I6hgYGBgAAAAA//9U0LEJAAAIBLErLf39p7QQFEGsHSF5id2NuxMR7C6SqCpmBkmYGZn5uAcAAP//ghvAxcX19vHjJwyKiooMzMzMDI8ePWJQVlZmYGRkZLhz5w6DoqIiw9evXxl2797DwMvH9wamDwAAAP//YmFgYGBiYWFRFRMTnXHs2LGs48ePCXJyckKd/4fhz5/fEPrvH4a/f/4wMDEzf1RXU1vByspq+vv377MAAAAA//8DAD9IFWBZHf/ZAAAAAElFTkSuQmCC);
	}
    
    
    .ow_prf_item{
        font:13px Arial;
        font-weight: normal;
        padding:12px;
    }
    
    .ow_prf_item h3{
        font: bold 20px Arial;
        color:#313131;
        padding: 20px 0;
    }
    
    table.ow_dev_tools{
        width: 100%;
    }
    
    table.ow_dev_tools td, table.ow_dev_tools th{
        padding: 8px 10px;
        border: 1px solid #e1c9a6;
    }
    table.ow_dev_tools th{
        background: #ede7df;
    }
    
    div.ow_dev_tools_info{
        font: 14px Arial;
        font-style: italic;
        padding: 5px 0;
    }
    
    div.ow_dtools_clb{
        font-size: 14px;
        color: blue;
        padding-bottom: 6px;
    }
    
    .ow_dev_tools_close_bg{
        width:16px;
        height:16px;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXRJREFUeNpiYKAQMIKIP6tX8zMyM29gYGJyIErXv38H/v/9G8ASGvqRBcT/+/37BkZGRgcSLHb4////BiDtCHbBt2nT/pPjfKArFMAu+PP5M4oEh5cXw9/Hjxl+X74M5rPq6jIwy8oy/Ni2DUUdX3n5Q4gXkAzgBGpm1dEB438/fkAM9PSEeB2o7juaIRgu+Hb4MAOrvj4DExcXA1dgICLcvn0Dy/1Fcy0TzAAY/nnzJsO7ri6Gf1+/IjQD2SAxkByyWrgL0E1lFxdnYOLmRtgCZDMDxX5eu4YRkBhe4HFzYxDMzITY/OULxAAeHrAYKEy+7NqFxQCoQrBrgH6FuepZbi6YLTV5MgMzLy9YDlktwgufPsEFPqxaxfDv+3eGn7dugf0MAk+SkxnY1dQYPm3ejD0pX1VSIishad+7xwgLgwOg5Emi/gNwL/z/8SPg358/Gxj+/yfOEEbGA0wsLAFwLyCDMwwM9gS0PzBhYHgI4wAEGAARZrBsHocP6gAAAABJRU5ErkJggg==);
    }
    #ow_dev_tools_bar, #ow_dev_tools_screen{
        color: #000 !important;
    }
</style>
<script>
OWshowDevToolTab = function( id ){
	$('.ow_prf_item').hide();
	$('#'+id).show();
	$('#ow_dev_tools_screen').show();
}
OWhideDevToolScreen = function(){
	$('#ow_dev_tools_screen').hide();
}
OWremoveDevTools = function(){
    $('#ow_dev_tools_bar').remove();
    $('#ow_dev_tools_screen').remove();
}
OWcacheClear = function(){
    
}
</script>

<div id="ow_dev_tools_bar" style="position: fixed;background-color: #f7f7f7;bottom: 0;left:0;margin:0;padding: 0;z-index: 6000000;width: 100%;border-top: 1px solid #bbb;font: 11px Verdana, Arial, sans-serif;text-align: left;color: #2f2f2f;">
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_info');">Oxwall:</i> <b><?php echo $_smarty_tpl->tpl_vars['oxwall']->value['version'];?>
</b> (<?php echo $_smarty_tpl->tpl_vars['oxwall']->value['build'];?>
)
    </span>
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_profiler');" class="page">Page:</i> <b><?php echo sprintf('%.3f',$_smarty_tpl->tpl_vars['profiler']->value['total']);?>
</b>s | <b> <?php echo $_smarty_tpl->tpl_vars['memoryUsage']->value;?>
</b>MB
    </span>
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_request');" class="request">Request:</i> <b><?php echo $_smarty_tpl->tpl_vars['requestHandler']->value['controller'];?>
</b>::<b><?php echo $_smarty_tpl->tpl_vars['requestHandler']->value['action'];?>
</b>
    </span>
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_elements');" class="elements">Components:</i> <b><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['count'];?>
</b>
    </span>
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_events');" class="events">Events:</i> <b><?php echo $_smarty_tpl->tpl_vars['events']->value['callsCount'];?>
</b>
    </span>
    <span class="dev_tools_item">
        <i onclick="OWshowDevToolTab('ow_dev_tools_database');" class="database">Database:</i> <b><?php echo $_smarty_tpl->tpl_vars['database']->value['qc'];?>
</b>qrs | <b> <?php echo sprintf('%.3f',$_smarty_tpl->tpl_vars['database']->value['qet']);?>
</b>s
    </span>
    <span class="ow_dev_tools_close_bg" style="display:block; position:absolute; top:7px; right:10px; cursor: pointer;font-size: 14px;color: red;" onclick="OWremoveDevTools()"></span>
    <?php if (!empty($_smarty_tpl->tpl_vars['clrBtnUrl']->value)){?><span style="display:block; position:absolute; top:10px; right:40px; cursor: pointer;font-size: 10px;color: green;" onclick="if(confirm('Are you sure you want to clear smarty and themes cache?')) window.location = '<?php echo $_smarty_tpl->tpl_vars['clrBtnUrl']->value;?>
';"><b>CLEAR CACHE</b></span><?php }?>
</div>

<div id="ow_dev_tools_screen" style="position:fixed; width:80%;left:10%;height:80%;top:8%;background:#fff;z-index:1000000;border:5px solid #aaa;display:none;">
    <div style="padding-right:10px;padding-top:2px;">
    <div style="padding:7px;float:left;font-size:18px;font-family: Arial;">Developer tools</div>
    <a href="javascript://" style="float:right;margin-top:7px;" onclick="OWhideDevToolScreen();" class="ow_dev_tools_close_bg"></a>
    <div style="clear:both"></div>
    </div>
    
    <div style="height: 95%; width: 100%;overflow: scroll;">
    
    <div id="ow_dev_tools_profiler" class="ow_prf_item" style="display: none;">
        <div class="ow_dev_tools_info">Total page generation time: <b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['total'];?>
</b> seconds</div>
        <div class="ow_dev_tools_info">Memory usage: <b><?php echo $_smarty_tpl->tpl_vars['memoryUsage']->value;?>
</b> MB</div>
        
        <h3>Profiler marks</h3>
        
        <table class="ow_dev_tools">
            <tr>
                <th style="width: 30%;">Mark name</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%;">Time</th>
            </tr>
            <tr>
                <td>Page start</td>
                <td>Script start.</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['start'];?>
</b></td>
            </tr>
            <tr>
                <td>Before application init</td>
                <td>Registering system data (includes system constants define, adding of standard package pointers, registering base classes, etc).</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['before_app_init'];?>
</b></td>
            </tr>
            <tr>
                <td>After application init</td>
                <td>Application initialization (includes setting application defaults, base managers init, active plugins init, creating default document, registering all static documents, etc). </td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['after_app_init'];?>
</b></td>
            </tr>
            <tr>
                <td>After routing</td>
                <td>Routing process (searching controller+action which should handle the request).</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['after_route'];?>
</b></td>
            </tr>
            <tr>
                <td>After controller action call</td>
                <td>Calling controller action (plugin custom logic).</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['after_controller_call'];?>
</b></td>
            </tr>
            <tr>
                <td>After finalize</td>
                <td>Getting final markup from all renderable objects. Compiling document body.</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['after_finalize'];?>
</b></td>
            </tr>
            <tr>
                <td>Page end</td>
                <td>Processing all headers and sending rendered document.</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['profiler']->value['marks']['end'];?>
</b></td>
            </tr>
        </table>
    </div>
    <div id="ow_dev_tools_database" class="ow_prf_item" style="display: none">
        <div class="ow_dev_tools_info">Total queries count: <b><?php echo $_smarty_tpl->tpl_vars['database']->value['qc'];?>
</b> </div>
        <div class="ow_dev_tools_info">Total execution time: <b><?php echo sprintf('%.3f',$_smarty_tpl->tpl_vars['database']->value['qet']);?>
</b> seconds</div>
        <h3>Query log</h3>
        <table class="ow_dev_tools">
            <tr>
                <th style="width: 70%;">Query</th>
                <th style="width: 20%;">Params</th>
                <th style="width: 10%;">Time</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['query'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['query']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value['ql']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['query']->key => $_smarty_tpl->tpl_vars['query']->value){
$_smarty_tpl->tpl_vars['query']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['query']->value['query'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['query']->value['params'];?>
</td>
                <td><b><?php echo sprintf('%.6f',$_smarty_tpl->tpl_vars['query']->value['execTime']);?>
</b></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="ow_dev_tools_request" class="ow_prf_item" style="display:none;">
        <div class="ow_dev_tools_info">Controller: <b><?php echo $_smarty_tpl->tpl_vars['requestHandler']->value['controller'];?>
 :: <?php echo $_smarty_tpl->tpl_vars['requestHandler']->value['action'];?>
</b></div>
        <div class="ow_dev_tools_info">Params: <b><?php echo $_smarty_tpl->tpl_vars['requestHandler']->value['paramsExp'];?>
</b></div>

        
    </div>
    <div id="ow_dev_tools_elements" class="ow_prf_item" style="display:none">
        <div class="ow_dev_tools_info">Components count: <b><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['count'];?>
</b> </div>
       <h3>Rendered elements</h3>
		<table class="ow_dev_tools">
            <tr>
                <th style="width: 15%;">Type</th>
                <th style="width: 15%;">Class</th>
                <th style="width: 70%;">Path (class, template)</th>
            </tr>
            <?php if (!empty($_smarty_tpl->tpl_vars['renderedItems']->value['items']['mp'])){?>
            <tr>
                <td>Master Page</td>
                <td><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['mp']['class'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['mp']['src'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['mp']['tpl'];?>
</td>
            </tr>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['renderedItems']->value['items']['ctrl'])){?>
            <tr>
                <td>Controller</td>
                <td><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['ctrl']['class'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['ctrl']['src'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['renderedItems']->value['items']['ctrl']['tpl'];?>
</td>
            </tr>
            <?php }?>
            <?php  $_smarty_tpl->tpl_vars['cmp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cmp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['renderedItems']->value['items']['cmp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cmp']->key => $_smarty_tpl->tpl_vars['cmp']->value){
$_smarty_tpl->tpl_vars['cmp']->_loop = true;
?>
            <tr>
                <td>Component</td>
                <td><?php echo $_smarty_tpl->tpl_vars['cmp']->value['class'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['cmp']->value['src'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['cmp']->value['tpl'];?>
</td>
            </tr>
            <?php } ?>
        </table>
        
    </div>
    <div id="ow_dev_tools_info" class="ow_prf_item" style="display:none">
        <div class="ow_dev_tools_info">Soft version: <b><?php echo $_smarty_tpl->tpl_vars['oxwall']->value['version'];?>
</b></div>
        <div class="ow_dev_tools_info">Soft build: <b><?php echo $_smarty_tpl->tpl_vars['oxwall']->value['build'];?>
</b></div>
    </div>
    <div id="ow_dev_tools_events" class="ow_prf_item" style="display:none">
        <div class="ow_dev_tools_info">Binded events: <b><?php echo $_smarty_tpl->tpl_vars['events']->value['bindsCount'];?>
</b></div>
        <div class="ow_dev_tools_info">Called events: <b><?php echo $_smarty_tpl->tpl_vars['events']->value['callsCount'];?>
</b></div>
        <h3>Called events</h3>
		<table class="ow_dev_tools">
            <tr>
                <th style="width: 30%;">Event</th>
                <th style="width: 50%;">Listener</th>
                <th style="width: 20%;">Params</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value['call']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
            <tr>
                <td>
                    <b><?php echo $_smarty_tpl->tpl_vars['event']->value['name'];?>
</b><br /><br />
                    Type: <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['event']->value['type'];?>
</span><br />
                    Called at: <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['event']->value['start'];?>
</span><br />
                    Exec time: <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['event']->value['exec'];?>
</span>
                </td>
                <td>
                    <?php  $_smarty_tpl->tpl_vars['listener'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['listener']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['event']->value['listeners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['listener']->key => $_smarty_tpl->tpl_vars['listener']->value){
$_smarty_tpl->tpl_vars['listener']->_loop = true;
?>
                    <div class="ow_dtools_clb"><?php echo $_smarty_tpl->tpl_vars['listener']->value;?>
()</div>
                    <?php }
if (!$_smarty_tpl->tpl_vars['listener']->_loop) {
?>
                    No listeners
                    <?php } ?>
                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['event']->value['params'];?>

                </td>
            </tr>
            <?php } ?>
        </table>
        <h3>Binded events</h3>
		<table class="ow_dev_tools">
            <tr>
                <th style="width: 40%;">Event</th>
                <th style="width: 60%;">Listener</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value['bind']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
            <tr>
                <td><b><?php echo $_smarty_tpl->tpl_vars['event']->value['name'];?>
</b></td>
                <td>
                    <?php  $_smarty_tpl->tpl_vars['listener'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['listener']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['event']->value['listeners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['listener']->key => $_smarty_tpl->tpl_vars['listener']->value){
$_smarty_tpl->tpl_vars['listener']->_loop = true;
?>
                    <div class="ow_dtools_clb"><?php echo $_smarty_tpl->tpl_vars['listener']->value;?>
()</div>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>    
    </div>
</div>
<?php }} ?>