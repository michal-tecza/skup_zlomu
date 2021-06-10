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
  </style>
 </head>
 <body>

 <div style="width:57%; background-color:LightGray; display:block; padding-left: 14px; position:fixed">
 <h3 style="margin:10px">Wybór tabeli
 
 <form style="display:inline-block; height: auto; margin-left: 14px" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <div class="form-group">
                    <select id="select_form" onchange="changeform()" style="height:30px; width: 120px; font-size: 20px; border:1px solid black">
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
 </h3>
 </div>

<div style="display:block; padding-top: 84px">
    <form action="metal_add" method="post">

        <div class="form-group" style="display:inline-block">
            <input id="txt_1" type="text" class="form-control" name="nazwa" placeholder="Nazwa metalu" value="{{old('nazwa')}}" onkeyup='saveValue(this);'> 
            <span style="color:red">@error('nazwa'){{$message}} @enderror</span>
            
        </div>
        <div class="form-group" style="display:inline-block">
            <input id="txt_2" type="text" class="form-control" name="cena" placeholder="Cena za kg metalu" value="{{old('cena')}}" onkeyup='saveValue(this);'>
            <span style="color:red">@error('cena'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
        </div>
    </form>
</div>    
<script type="text/javascript">
        document.getElementById("select_form").selectedIndex= <?php echo $selected; ?>;
        document.getElementById("txt_1").value = localStorage.getItem("txt_1");    
        document.getElementById("txt_2").value = localStorage.getItem("txt_2");    

        
        function saveValue(e){
            var val1 = document.getElementById("txt_1").value;
            var val2 = document.getElementById("txt_2").value;
            localStorage.setItem("txt_1", val1);
            localStorage.setItem("txt_2", val2);
        }

        
        function changeform(){
            let url = "{{ url('/mainview/id3/id/id2') }}";
            let url2 = "<?php echo URL::current(); ?>";
            let url3 = url2.slice(-3,-2);
            let url4 = url2.slice(-1);
            url = url.replace('id3', document.getElementById("select_form").selectedIndex+1);
            url = url.replace('id2', url4);
            url = url.replace('id', url3);

            window.location.href=url;
        }
</script> 
        
 </body>

</html>