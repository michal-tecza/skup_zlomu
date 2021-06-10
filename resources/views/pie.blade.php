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

   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);

   function drawChart()
   {
    var data = google.visualization.arrayToDataTable(analytics);
    var options = {
        title : '<?php echo $chart_nazwa; ?>',
        width: 615,
        height: 495
    };
    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
    

    chart.draw(data, options);
   }
  </script>
 </head>
 <body>

 <div style="width:57%; background-color:LightGray; display:block; padding-left: 14px; position:fixed">
 <h3 style="margin:10px">Wybór wykresu
 
 <form style="display:inline-block; height: auto; margin-left: 14px" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <div class="form-group">
                    <select id="select_pie" onchange="changeview()" style="height:30px; width: 270px; font-size: 20px; border:1px solid black">
                    <optgroup label="Wykresy kołowe">
                        <option>Najczęstsze metale - masa</option>
                        <option>Najczęstsze metale - cena</option>
                    <optgroup label="Wykresy liniowe">
                        <option>Historia ceny</option>
                    
                        
                    </select>
                </div>
            </div>
 </form>
 </h3>
 </div>
    <div id="pie_chart" style=" display:block; width:615px; height:495px; margin-left: 4px; margin-top:10%"></div>  
</div>
    <script> 
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
    </script>  
 </body>

</html>