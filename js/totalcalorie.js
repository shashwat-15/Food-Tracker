/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This javascript file adds the total calorie intake and displays it in the home.php file
*/

let btn1 = document.getElementById("badd");
let btn2 = document.getElementById("ladd");
let btn3 = document.getElementById("dadd");
let span = document.getElementById("calcount");

let old_deadline = document.getElementById("deadline").innerHTML;
// '<%Session["UserName"] = "' + old_deadline + '"; %>';
// let username = '<%= Session["UserName"] %>';
let tot_cal = 0;

let calorie_arr = [];

for(let i =0; i<parseInt(old_deadline);i++){
    calorie_arr[i] = 0;
}

let j = 0;


btn1.addEventListener('click',function(){

    let bcal = document.getElementById("bnumbercalories").innerHTML;
    tot_cal += parseInt(bcal);

    span.innerHTML = tot_cal;

    

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    let cal_req = document.getElementById("calreq").innerHTML;
    let cal_count = span.innerHTML; 
    
    calorie_arr[j] = parseFloat(cal_count);
    let new_deadline = document.getElementById("deadline").innerHTML;

    if(parseInt(old_deadline)>parseInt(new_deadline)){
        j++;
        console.log("yo");
        calorie_arr[j] = parseFloat(cal_count);
    }

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string','Day');
        data.addColumn('number','Expected');
        data.addColumn('number','Actual');
        for(let i = 0; i<parseInt(deadline);i++){
            data.addRow(['Day '+i,  parseFloat(cal_req),     calorie_arr[i]]);
        //data.addRow(['Week 2',  1170,      460]);
        }
        
        var options = {
        title: 'Calorie Intake',
        curveType: 'function',
        legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }



})

btn2.addEventListener('click',function(){

    let bcal2 = document.getElementById("lnumbercalories").innerHTML;
    tot_cal += parseInt(bcal2);

    span.innerHTML = tot_cal;

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    let cal_req = document.getElementById("calreq").innerHTML;
    let cal_count = span.innerHTML; 


    calorie_arr[j] = parseFloat(cal_count);
    let new_deadline = document.getElementById("deadline").innerHTML;

    if(parseInt(old_deadline)>parseInt(new_deadline)){
        j++;
    }
    
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string','Day');
        data.addColumn('number','Expected');
        data.addColumn('number','Actual');
        for(let i = 0; i<parseInt(deadline);i++){
            data.addRow(['Day '+i,  parseFloat(cal_req),     calorie_arr[i]]);
        //data.addRow(['Week 2',  1170,      460]);
        }
        
        var options = {
        title: 'Calorie Intake',
        curveType: 'function',
        legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }


})

btn3.addEventListener('click',function(){

    let bcal3 = document.getElementById("dnumbercalories").innerHTML;
    tot_cal += parseInt(bcal3);

    span.innerHTML = tot_cal;

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    let cal_req = document.getElementById("calreq").innerHTML;
    let cal_count = span.innerHTML; 


    calorie_arr[j] = parseFloat(cal_count);
    let new_deadline = document.getElementById("deadline").innerHTML;

    if(parseInt(old_deadline)>parseInt(new_deadline)){
        j++;
    }
    
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string','Day');
        data.addColumn('number','Expected');
        data.addColumn('number','Actual');
        for(let i = 0; i<parseInt(deadline);i++){
            data.addRow(['Day '+i,  parseFloat(cal_req),     calorie_arr[i]]);
        //data.addRow(['Week 2',  1170,      460]);
        }
        
        var options = {
        title: 'Calorie Intake',
        curveType: 'function',
        legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }



})