
    var data = [
      {"Name":"Test1","dec":"123"},
      {"Name":"user","dec":"456"},
      {"Name":"Ropbert","dec":"789"},
      {"Name":"hitesh","dec":"101112"}
      ]
    //console.log(data)
    //delete data.result[1]
    //data.splice(2,1); 
    // for (let [i, user] of data.entries()) {
    //   if (user.FirstName === "user") {
    //     data.splice(i, 1); // Tim is now removed from "users"
    //     break;
    //   }
    //   console.log(i)
    // }
    // for (let [i, user] of data.entries()) {
    //     if (user.Name === "user") {
    //       data[i]['img']='kkkkkk';
    //       break;
    //     }
    //     //console.log(i)
    // }

    var filtered = data.filter(a => a.Name == "user");
    console.log(filtered);

    data.filter(function(item,index){
      if(item.Name == "user"){
        console.log(data[index].dec) ;
      }       
    });

    
    

    console.log("**********")
    //console.log(data)
    // count=0
    // for( i=count-1;i>=0;i--){
    //   console.log(i)
    // }
    // console.log(i)
    // console.log(count)
