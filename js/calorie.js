

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This javascript file displays the calories of the food selected from the food dropdown and multiplies it by the quantity selected from the quantity dropdown
*/
//let e = document.getElementById("breakfastmenu");
let e = document.getElementById("bcalories");
let f = document.getElementById("lcalories");
let g = document.getElementById("dcalories");
let m = document.getElementById("bnumbercalories");
let n = document.getElementById("lnumbercalories");
let o = document.getElementById("dnumbercalories");

//for(let i = 0; i<e.length;i++){
    e.addEventListener('change',function(){
        let strfood = e.options[e.selectedIndex].text;
        //console.log(strfood);
        let params = "food=" + strfood;
        
        fetch("countCalories.php", {
            method: 'POST',
            credentials: 'include',
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, // parameter format
            body: params // POST params are sent in the body
        })
        .then(response => response.text())
        .then(success1)
        
        function success1(data){
            let q1 = document.getElementById("bqtyselect");
            let selected_qty = q1.options[q1.selectedIndex].text;
            let ttlcalorie = parseInt(data) * parseInt(selected_qty);
            m.innerHTML = ttlcalorie;
            
            
            
            q1.addEventListener('change',function(){
                let selected_qty = q1.options[q1.selectedIndex].text;
                let ttlcalorie = parseInt(data) * parseInt(selected_qty);
                m.innerHTML =ttlcalorie;
            
            });
        }
    });


    f.addEventListener('change',function(){
        let strfood = f.options[f.selectedIndex].text;
        //console.log(strfood);
        let params = "food=" + strfood;
        
        fetch("countCalories.php", {
            method: 'POST',
            credentials: 'include',
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, // parameter format
            body: params // POST params are sent in the body
        })
        .then(response => response.text())
        .then(success2)
        
        function success2(data){
            
            let q2 = document.getElementById("lqtyselect");
            let selected_qty = q2.options[q2.selectedIndex].text;
            let ttlcalorie = parseInt(data) * parseInt(selected_qty);
            n.innerHTML = ttlcalorie;
            
            q2.addEventListener('change',function(){
                let selected_qty = q2.options[q2.selectedIndex].text; 

                let ttlcalorie = parseInt(data) * parseInt(selected_qty);
                
            
                n.innerHTML =ttlcalorie;
            
            });
        }
    });



    g.addEventListener('change',function(){
        let strfood = g.options[g.selectedIndex].text;
        //console.log(strfood);
        let params = "food=" + strfood;
        
        fetch("countCalories.php", {
            method: 'POST',
            credentials: 'include',
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, // parameter format
            body: params // POST params are sent in the body
        })
        .then(response => response.text())
        .then(success3)
        
        function success3(data){
            
            let q3 = document.getElementById("dqtyselect");
            let selected_qty = q3.options[q3.selectedIndex].text;
            let ttlcalorie = parseInt(data) * parseInt(selected_qty);
            o.innerHTML = ttlcalorie;
            
            q3.addEventListener('change',function(){
                let selected_qty = q3.options[q3.selectedIndex].text; 

                let ttlcalorie = parseInt(data) * parseInt(selected_qty);
                
            
                o.innerHTML =ttlcalorie;
            
            });
        }
    });

            
            
        

    
//} 



//e.onchange();