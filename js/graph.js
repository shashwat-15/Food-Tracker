/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.
 This javascript file creates a graph of total calorie intake of user per week
*/


/*
create and store total calorie count per day in an array. Use for loop
*/
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      let cal_req = document.getElementById("calreq").innerHTML;
      let cal_count = document.getElementById("calcount").innerHTML; 
      let deadline = document.getElementById("deadline").innerHTML;
      // for(let i=0;i<4;i++){
      //       item.push('Week 1', 1000, 400);
      // }
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string','Day');
        data.addColumn('number','Expected');
        data.addColumn('number','Actual');
        for(let i = 0; i<parseInt(deadline);i++){
          data.addRow(['Day '+i,  parseFloat(cal_req),     parseFloat(cal_count)]);
          //data.addRow(['Week 2',  1170,      460]);
        }
        // data.setValue()
        // [
        //   ['Year', 'Expected', 'Actual'],
        //   item
          // ['Week 1',  1000,      400],
          // ['Week 2',  1170,      460],
          // ['Week 3',  660,       1120],
          // ['Week 4',  1030,      540],
          // ['Week 5',  1030,      540],
          // ['Week 6',  1030,      540],
          // ['Week 7',  1030,      540],
          // ['Week 8',  1000,      400],
          // ['Week 9',  1170,      460],
          // ['Week 10',  660,       1120],
          // ['Week 11',  1030,      540],
          // ['Week 12',  1030,      540],
          // ['Week 13',  1030,      540],
          // ['Week 14',  1030,      540],
          // ['Week 15',  1000,      400],
          // ['Week 16',  1170,      460],
          // ['Week 17',  660,       1120],
          // ['Week 18',  1030,      540],
          // ['Week 19',  1030,      540],
          // ['Week 20',  1030,      540],
          // ['Week 21',  1030,      540],
          // ['Week 1',  1000,      400],
          // ['Week 2',  1170,      460],
          // ['Week 3',  660,       1120],
          // ['Week 4',  1030,      540],
          // ['Week 4',  1030,      540],
          // ['Week 4',  1030,      540],
          // ['Week 4',  1030,      540]
       

        
        
        var options = {
          title: 'Calorie Intake',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }