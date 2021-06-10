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
    <form action="transakcja_add" method="post">

        <div class="form-group" style="display:inline-block">
            <select id="combo_1" onchange="changemetal()" class="form-control" name="nazwa"> 
            @foreach($metale as $metal )
                <option value="{{ $metal->id_metal }}">{{ $metal->nazwa }}</option>
            @endforeach
            <select>
            <span style="color:red">@error('nazwa'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <select id="combo_2" onchange="changeklient()" class="form-control" name="klient"> 
            @foreach($klienci as $klient )
                <option value="{{ $klient->id_klient }}">{{ $klient->imie }} {{ $klient->nazwisko }}</option>
            @endforeach
            <select>
            <span style="color:red">@error('klient'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <select id="combo_3" onchange="changepracownik()" class="form-control" name="pracownik"> 
            @foreach($pracownicy as $pracownik )
                <option value="{{ $pracownik->id_pracownik }}">{{ $pracownik->imie }} {{ $pracownik->nazwisko }}</option>
            @endforeach
            <select>
            <span style="color:red">@error('pracownik'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <select id="combo_5" onchange="changeoddzial()" class="form-control" name="oddzial"> 
            @foreach($oddzialy as $oddzial )
                <option value="{{ $oddzial->id_oddzial }}">{{ $oddzial->miasto }}</option>
            @endforeach
            <select>
            <span style="color:red">@error('oddzial'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <input id="txt_15" type="text" class="form-control" name="kilogramy" placeholder="Kilogramy" value="{{old('kilogramy')}}" onkeyup='saveValue(this);'>
            <span style="color:red">@error('kilogramy'){{$message}} @enderror</span>
        </div>
        <div class="form-group" style="display:inline-block">
            <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
        </div>
    </form>
</div>    
<script type="text/javascript">
        document.getElementById("select_form").selectedIndex= <?php echo $selected; ?>;
        document.getElementById("combo_1").selectedIndex= localStorage.getItem("persist2"); 
        document.getElementById("combo_2").selectedIndex= localStorage.getItem("persist3");
        document.getElementById("combo_3").selectedIndex= localStorage.getItem("persist4");
        document.getElementById("combo_5").selectedIndex= localStorage.getItem("persist6");
        document.getElementById("txt_15").value = localStorage.getItem("txt_15"); 

        function saveValue(e){
            var val7 = document.getElementById("txt_15").value;
            localStorage.setItem("txt_15", val7);
        }

        function changemetal(){
            var per_index = document.getElementById("combo_1").selectedIndex;
            localStorage.setItem("persist2", per_index);
        }

        function changeklient(){
            var per_index = document.getElementById("combo_2").selectedIndex;
            localStorage.setItem("persist3", per_index);
        }

        function changepracownik(){
            var per_index = document.getElementById("combo_3").selectedIndex;
            localStorage.setItem("persist4", per_index);
        }

        function changeoddzial(){
            var per_index = document.getElementById("combo_5").selectedIndex;
            localStorage.setItem("persist6", per_index);
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