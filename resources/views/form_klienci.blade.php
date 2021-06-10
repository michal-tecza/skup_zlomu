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
    <form action="klient_add" method="post">

        <div class="form-group" style="display:inline-block">
            <input id="txt_5" type="text" class="form-control" name="imie" placeholder="Imię klienta" value="{{old('imie')}}" onkeyup='saveValue(this);'> 
            <span style="color:red">@error('imie'){{$message}} @enderror</span>
            
        </div>
        <div class="form-group" style="display:inline-block">
            <input id="txt_6" type="text" class="form-control" name="nazwisko" placeholder="Nazwisko klienta" value="{{old('nazwisko')}}" onkeyup='saveValue(this);'>
            <span style="color:red">@error('nazwisko'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <input id="txt_7" type="text" class="form-control" name="telefon" placeholder="Telefon klienta" value="{{old('telefon')}}" onkeyup='saveValue(this);'>
            <span style="color:red">@error('telefon'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
        </div>
    </form>
</div>    
<script type="text/javascript">
        document.getElementById("select_form").selectedIndex= <?php echo $selected; ?>;
        document.getElementById("txt_5").value = localStorage.getItem("txt_5");    
        document.getElementById("txt_6").value = localStorage.getItem("txt_6"); 
        document.getElementById("txt_7").value = localStorage.getItem("txt_7");  

        
        function saveValue(e){
            var val1 = document.getElementById("txt_5").value;
            var val2 = document.getElementById("txt_6").value;
            var val3 = document.getElementById("txt_7").value;
            localStorage.setItem("txt_5", val1);
            localStorage.setItem("txt_6", val2);
            localStorage.setItem("txt_7", val3);
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