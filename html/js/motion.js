$(document).ready(function(){
  var entries =0;
  var time = [];
      var motion = [];
      var roomNo = [];
  var dataRender = function(chart)
  {//console.log('motion render');
  $.ajax({
    url : "/motion.php",
    type : "GET",
    
    success : function(data){
      //console.log(data);
      obj =JSON.parse(data);
      //console.log(obj);
      

      
      
      var length = Object.keys(obj).length;
if(length>entries){
      for(var i=entries; i<length ;i++) {
        
        time.push(obj[i].Time);
        
        motion.push(obj[i].MotionLevel);
        
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
            label: "MotionLevel",
            fill: false,
            lineTension: 0.1,
            //backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "#8e5ea2",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            data: motion
          },
          
          
        ]
      };

      var ctx = $("#motion");
      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
      
      dataRender(LineGraph);

      
      return LineGraph;
    }

 

  var chart = intialiseChart();
  
  
   function createInterval(f,dynamicParameter,interval) { setInterval(function() { f(dynamicParameter); }, interval); }
   
  createInterval(dataRender,chart,60000);

  });
  

