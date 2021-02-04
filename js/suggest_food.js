let user_ingredient = [];
let food = {"chickenpulao":["Chicken","Rice"],"chickenwings":["Chicken","legs"]};
let suitable_food = [];

document.getElementById("add_ingredient").addEventListener('click',function(){
    let e = document.getElementById("ingredients");
    let selected_ingredient = e.options[e.selectedIndex].text;
    let n = user_ingredient.includes(selected_ingredient);
    if(n === false){
        user_ingredient.push(selected_ingredient);
    }
    for(let key in food){
        for(let i=0;i<2;i++){
            console.log(food[key][i]);
        }
    }
    console.log(user_ingredient);
});

document.getElementById("suggest_food").addEventListener('click',function(){
    for(let i =0; i<user_ingredient.length;i++){
        for(let key in food){
            for(let j=0;j<2;j++){
                if(user_ingredient[i] === food[key][j]){
                    suitable_food.push(key);
                }
            }
        }
    }

    console.log(suitable_food);

    let mf = 1;
    let m = 0;
    let item;

    for (let i=0; i<suitable_food.length; i++)
    {
        for (var j=i; j<suitable_food.length; j++)
        {
                if (suitable_food[i] == suitable_food[j])
                 m++;
                if (mf<m)
                {
                  mf=m; 
                  item = suitable_food[i];
                }
        }
        m=0;
    }

    console.log(item);
});