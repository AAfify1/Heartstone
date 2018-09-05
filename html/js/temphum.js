$(document).ready(function(){
  var entries =0;
  var time = [];
      var humidity = [];
      var temperature = [];
      var roomNo = [];
  var dataRender = function(chart)
  {
  $.ajax({
    url : "/temphum.php",
    type : "GET",
    
    success : function(data){
      //console.log(data);
      obj =JSON.parse(data);
      // console.log(obj);
      // console.log(obj[3].time);
      // console.log(obj[3].temperature);
      // console.log(obj[3].humidity);
      // console.log(obj[3].roomNo);

      
      
      var length = Object.keys(obj).length;
if(length>entries){
      for(var i=entries; i<length ;i++) {
        //console.log("entry:"+i);
        time.push(obj[i].time);
        //console.log("time:"+time[i]);
        humidity.push(obj[i].humidity);
        //console.log("hum:"+humidity[i]);
        temperature.push(obj[i].temperature);
        //console.log("temp:"+temperature[i]);
        roomNo.push(obj[i].roomNo)
        //console.log("room:"+roomNo[i]);
       
      }
    }
    entries=length;
    //console.log(entries);
    chart.update();
  }
    
  });
  
};
      //console.log(temperature);

      var intialiseChart = function(){
        
       
 
// var time = data[0];
// var humidity = data[1];
// var temperature = data[2];
// var roomNo = data[3];
// var entries = data[4];

       var chartdata = {
        labels: time,
        datasets: [
          {
            label: "Humidity",
            fill: false,
            lineTension: 0.1,
            //backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "#3cba9f",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            radius: 0,
            data: humidity
          },
          {
            label: "Temperature",
            fill: false,
            lineTension: 0.1,
            //backgroundColor: "rgba(29, 202, 255, 0.75)",
            borderColor: "#c45850",
            pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
            pointHoverBorderColor: "rgba(29, 202, 255, 1)",
            radius: 0,
            data: temperature
          },
          
        ]
      };

      var ctx = $("#temphum");
      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        
          animation: false
      
      });
      
      dataRender(LineGraph);

      
      return LineGraph;
    }

  //   function addData(chart, label, data) {
  //     chart.data.labels.push(label);
  //     chart.data.datasets.forEach((dataset) => {
  //         dataset.data.push(data);
  //     });
  //     chart.update();
  // }

  var chart = intialiseChart();
  
  
   function createInterval(f,dynamicParameter,interval) { setInterval(function() { f(dynamicParameter); }, interval); }
   
  createInterval(dataRender,chart,1000);

  });
  

