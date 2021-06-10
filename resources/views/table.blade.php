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
   .selected {
    background-color: #3498DB;
    color: white;
    }
   body {
    font-family: 'Nunito', sans-serif;
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
 
 <div style="width:57%; background-color:LightGray; display:block; padding-left: 14px; position:fixed">
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
 <form action="metal_del" method="post" style="display:inline-block; float:right;">
 <input type="text" name="id" class="ok_txt" style="display:none"/>
 <button type="submit" style="background-color: #FF3333; color:white; border:1px solid black; margin-right:50px">Usuń</button>
 </form>
 </h3>
 </div>

 <br>
 <br>
 
 <table id="table" class="table table-bordered" style="margin-top:10px; overflow:hidden;">
    <thead>
        <tr style="background-color:white; ">
            <th style="width:216px"><input type="text" id="search1" placeholder="id_metal"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="width:217px"><input type="text" id="search2" placeholder="metal_data"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="width:216px"><input type="text" id="search3" placeholder="nazwa"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            <th style="width:215px"><input type="text" id="search4" placeholder="cena_za_kg"/><img src='https://www.iconspng.com/uploads/simple-grey-search-icon.png' style="display:inline-block; width:20px; height:20px;"></th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($metale_lista as $key => $value)
        <tr>
            <td class="col1">{{ $value->id_metal }}</td>
            <td class="col2">{{ $value->metal_data }}</td>
            <td class="col3">{{ $value->nazwa }}</td>
            <td class="col4">{{ $value->cena_za_kg }}</td>

            
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