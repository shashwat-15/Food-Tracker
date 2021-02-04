/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This javascript file updates the weight of the user shown in home.php file
*/

document.getElementById("editbtn").addEventListener('click',function(){
    document.getElementById("changetxtbox").innerHTML = "<input style = 'width:30px;font-size:17px;' type = 'textbox' name='addWeight' id = 'addWeight' autofocus/>";
    //let updated_weight = document.getElementById("addWeight").value;
   
    
});

document.getElementById("updatebtn").addEventListener('click',function(){
    //console.log(updated_weight);
    let updated_weight = document.getElementById("addWeight").value;
     document.getElementById("changetxtbox").innerHTML = updated_weight;
     let height = document.getElementById("height").value;
    let age = document.getElementById("age").value;
    let cal_required = 66 + (6.3 * updated_weight) + (12.9 * height) - (6.8 * age);

    let params = "updwt=" + updated_weight + "&cal=" + cal_required;

                    fetch("update_weight.php", {
                        method: 'POST',
                        credentials: 'include',
                        headers: { "Content-Type": "application/x-www-form-urlencoded" }, // parameter format
                        body: params // POST params are sent in the body
                    })
                    .then(response => response.text())
                    .then(success)

                    function success(data){
                        document.getElementById("changetxtbox").innerHTML = updated_weight;
                        
                        document.getElementById("calreq").innerHTML = cal_required;

                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        let cal_req = cal_required;
                        let cal_count = document.getElementById("calcount").innerHTML; 
                        let deadline = document.getElementById("deadline").innerHTML;
                        
                        function drawChart() {
                            var data = new google.visualization.DataTable();
                            data.addColumn('string','Day');
                            data.addColumn('number','Expected');
                            data.addColumn('number','Actual');
                            for(let i = 0; i<parseInt(deadline);i++){
                                data.addRow(['Day '+i,  cal_req,     parseFloat(cal_count)]);
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



                    }
});
