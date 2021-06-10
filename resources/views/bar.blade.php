<!DOCTYPE html>
<html>
 <head>
  <title>Google Chart</title>
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

  <script type="text/javascript" >

   var analytics = <?php echo $nazwa; ?>;
   var analytics_n = <?php echo $nazwa_n; ?>;

   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);

   function drawChart()
   {
    for (var i = analytics.length-1; i > 0; i--) {
        if(analytics_n[i][0]!=document.getElementById("select_bar").value){
            console.log(analytics[i]);
            analytics.splice(i, 1);
        }
    }
    var nazwa_m = document.getElementById("select_bar").value;
    var data = google.visualization.arrayToDataTable(analytics);
    var options = {
        hAxis: { textPosition: 'none' },
        title : 'Wykres liniowy ceny metalu: '+nazwa_m,
        width: 615,
        height: 495,
        legend: {position: 'none'}
    };
    var chart = new google.visualization.LineChart(document.getElementById('pie_chart'));
    

    chart.draw(data, options);
   }
  </script>
 </head>
 <body>

 <div style="width:57%; background-color:LightGray; display:block; padding-left: 14px; position:fixed">
 <h3  style="margin:10px">Wybór wykresu
 
 <form style="display:inline-block; height: auto; margin-left: 14px" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <div class="form-group">
                    <select id="select_pie" onchange="changeview()" style="height:30px; width: 160px; font-size: 20px; border:1px solid black">
                    <optgroup label="Wykresy kołowe">
                        <option>Najczęstsze metale - masa</option>
                        <option>Najczęstsze metale - cena</option>
                    <optgroup label="Wykresy liniowe">
                        <option>Historia ceny</option>
                    
                        
                    </select>
                </div>
            </div>
 </form>

 <form style="display:inline-block; height: auto; margin-left: 14px" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <div class="form-group">
                    <select id="select_bar" onchange="changebar()" style="height:30px; width: 100px; font-size: 20px; border:1px solid black">

                    @foreach($metale as $metal )
                        <option value="{{ $metal->nazwa }}">{{ $metal->nazwa }}</option>
                    @endforeach
                        
                    </select>
                </div>
            </div>
 </form>
 </h3>
 </div>
    <div id="pie_chart" style=" display:block; width:615px; height:495px; margin-left: 4px; margin-top:10%"></div>  
</div>
    <script> 
    document.getElementById("select_bar").selectedIndex= localStorage.getItem("persist");
    document.getElementById("select_pie").selectedIndex= <?php echo $selected; ?>;
        function changeview(){
            let url = "{{ url('/mainview/id3/id/id2') }}";
            let url2 = "<?php echo URL::current(); ?>";
            let url3 = url2.slice(-1);
            let url4 = url2.slice(-5,-4);
            url = url.replace('id2', url3);
            url = url.replace('id3', url4);
            url = url.replace('id', document.getElementById("select_pie").selectedIndex+1);
            

            window.location.href=url;
        }
        function changebar(){
            var per_index = document.getElementById("select_bar").selectedIndex;
            localStorage.setItem("persist", per_index);
            location.reload(true);
        }
    
    </script>  
 </body>

</html>