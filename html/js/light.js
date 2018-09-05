$(document).ready(function(){
    var entries =0;
    var time = [];
    var lightLevel = [];
    var lightIntensity = [];
    var roomNo = [];
    var dataRender = function(chart)
    {//console.log('light render');
    $.ajax({
      url : "/light.php",
      type : "GET",

      success : function(data){
        //console.log(data);
        obj =JSON.parse(data);
        //console.log(obj);

      var length = Object.keys(obj).length;
    if(length>entries){
          for(var i=entries; i<length ;i++) {          

            time.push(obj[i].time);          
            lightIntensity.push(obj[i].LightIntensity);
            lightLevel.push(obj[i].LightLevel);
            roomNo.push(obj[i].RoomNo)
          }
          entries=length;
      //console.log(entries);
      chart.update();
      }
      
    }

    });

  };

        var intialiseChart = function(){

         var chartdata = {
          labels: time,
          datasets: [
            {
              label: "LightIntensity",
              fill: false,
              lineTension: 0.1,
              //backgroundColor: "rgba(230, 230, 0, 0.75)",
              borderColor: "#3e95cd",
              pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
              pointHoverBorderColor: "rgba(59, 89, 152, 1)",
              data: lightIntensity
            }
            

          ],
         
        };

        var ctx = $("#light");
        var LineGraph = new Chart(ctx, {
          type: 'line',
          data: chartdata
        });

        dataRender(LineGraph);

        return LineGraph;
      }

    var chart = intialiseChart();

     function createInterval(f,dynamicParameter,interval) { setInterval(function() { f(dynamicParameter); }, interval); }

    createInterval(dataRender,chart,1000);

    });

  