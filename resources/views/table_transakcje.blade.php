<!DOCTYPE html>
<html>
 <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <style type="text/css">
   .box{
    width:800px;
    margin:0 auto;
    }
    body {
    font-family: 'Nunito', sans-serif;
    }
    
   .selected {
    background-color: #3498DB;
    color: white;
    }
    ::-webkit-scrollbar{
    width:12px
    }
   ::-webkit-scrollbar-thumb
    {
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
    }
    
  </style>
 </head>
 <body>
 
 <div style="width:57%; background-color:LightGray; display:block; padding-left: 14px; position:fixed;">
 <h3 style="margin:10px">Wybór tabeli
 <form style="display:inline-block; height: auto; margin-left: 14px" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <div class="form-group">
                    <select id="select_table" onchange="changeview2()" style="height:30px; width: 120px; font-size: 20px; border:1px solid black">
                    @if ( Session::get('key') == 'Pracownik')
                        <option disabled>Metale</option>
                    @else
                        <option >Metale</option>
                    @endif
                    
                    <option >Transakcje</option>
                    
                    <option >Klienci</option>     

                    @if ( Session::get('key') == 'Pracownik')
                        <option disabled>Pracownicy</option>
                    @else
                        <option>Pracownicy</option>
                    @endif

                    @if ( Session::get('key') == 'Pracownik')
                        <option disabled>Oddzialy</option>  
                    @else
                        <option >Oddzialy</option>  
                    @endif
                    </select>
                </div>
            </div>
 </form>
 <form action="transakcja_del" method="post" style="display:inline-block; float:right;">
 <input type="text" name="id" class="ok_txt" style="display:none"/>
 <button type="submit" style="background-color: #FF3333; color:white; border:1px solid black; margin-right:50px">Usuń</button>
 </form>
 </h3>
 </div>

 <br>
 <br>
 
 <table id="table" class="table table-bordered" style="margin-top:10px; overflow:hidden; ">
    <thead >
        <tr style="background-color:white;">
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search1" placeholder="id_transakcja"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search2" placeholder="id_klient"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search3" placeholder="id_metal"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:120px" type="text" id="search4" placeholder="metal_data"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search5" placeholder="id_pracownik"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search6" placeholder="id_oddzial"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:120px" type="text" id="search7" placeholder="data"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="white-space:nowrap;"><input style="width:100px" type="text" id="search8" placeholder="kilogramy"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($transakcje_lista as $key => $value)
        <tr>
        <td class="col1">{{ $value->id_transakcja }}</td>
        <td class="col2">{{ $value->klienci->imie }} {{ $value->klienci->nazwisko }}</td>
        <td class="col3">{{ $value->metale->nazwa }}</td>
        <td class="col4">{{ $value->metal_data }}</td>
        <td class="col5">{{ $value->pracownicy->imie }} {{ $value->pracownicy->nazwisko }}</td>
        <td class="col6">{{ $value->oddzialy->miasto }}</td>
        <td class="col7">{{ $value->data }}</td>
        <td class="col8">{{ $value->kilogramy }}</td>            
        </tr>
    @endforeach
    </tbody>
 </table>
 
 <script> 
    document.getElementById("select_table").selectedIndex= <?php echo $selected; ?>;

    $(function() {    
    $('#search1').change(function() { 
        $("#table td.col1:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col1:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search2').change(function() { 
        $("#table td.col2:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col2:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search3').change(function() { 
        $("#table td.col3:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col3:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search4').change(function() { 
        $("#table td.col4:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col4:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search5').change(function() { 
        $("#table td.col5:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col5:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search6').change(function() { 
        $("#table td.col6:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col6:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search7').change(function() { 
        $("#table td.col7:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col7:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    $('#search8').change(function() { 
        $("#table td.col8:contains('" + $(this).val() + "')").parent().show();
        $("#table td.col8:not(:contains('" + $(this).val() + "'))").parent().hide();
    });
    });

        function changeview2(){
            let url = "{{ url('/mainview/id3/id/id2') }}";
            let url2 = "<?php echo URL::current(); ?>";
            let url3 = url2.slice(-3,-2);
            let url4 = url2.slice(-5,-4);
            url = url.replace('id2', document.getElementById("select_table").selectedIndex+1);
            url = url.replace('id3', url4);
            url = url.replace('id', url3);

            window.location.href=url;
        }

        $("#table tbody tr").click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');    
            var value=$(this).find('td:first').html();
            $('.ok_txt').prop('value', value);
        });
    </script> 

 </body>

</html>