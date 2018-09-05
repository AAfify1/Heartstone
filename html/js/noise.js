$(document).ready(function(){
    var entries =0;
    var time = [];
        var noise = [];
        var noiseLevel = [];
        var roomNo = [];
    var dataRender = function(chart)
    {//console.log('noise render');
    $.ajax({
      url : "/noise.php",
      type : "GET",
      
      success : function(data){
        //console.log(data);
        obj =JSON.parse(data);
        //console.log(obj);
        
  
        
        
        var length = Object.keys(obj).length;
  if(length>entries){
        for(var i=entries; i<length ;i++) {
          
          time.push(obj[i].time);
          
          noiseLevel.push(obj[i].NoiseLevel);
          noise.push(obj[i].Noise);
          
          roomNo.push(obj[i].RoomNo)
          
         
        }
      }
      entries=length;
      //console.log(entries);
      chart.update();
    }
      
    });
    
  };
   
  
        var intialiseChart = function(){
          
         
   
  
  
         var chartdata = {
          labels: time,
          datasets: [
            {
              label: "NoiseLevel",
              fill: false,
              lineTension: 0.1,
              //backgroundColor: "rgba(59, 89, 152, 0.75)",
              borderColor: "#e8c3b9",
              pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
              pointHoverBorderColor: "rgba(59, 89, 152, 1)",
              data: noiseLevel
            }
           
            
          ]
        };
  
        var ctx = $("#noise");
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
    
  
  