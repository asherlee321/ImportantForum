
    let oldPostCount = 0;
    let time;
    let user;
    // Update page
    setInterval(
        function(){
            

           
            $.ajax({
                type: "POST",
                url:"CheckSession.php",
                dataType: "text",
                data: {},
                success : function(result){
                   user = result;

                }
            });
            if (user.length == 0){
                document.location.href = "index.php";
            }
          
            $.ajax({
                type: "POST",
                url: "getPostCount.php",
                dataType: "text",
                data: {},
                success: function(result){
                    if(result > oldPostCount){
                        document.getElementById("forumPost").contentWindow.location.reload(true);
                        oldPostCount = result;
                    }
                },
            });
        },
        1000
        
    );

   $.ajax({
        type: "POST",
        url: "getPostCount.php",
        dataType: "text",
        data: {},
        success: function(result){
            oldPostCount = result;
        },
        error: function(){alert("error")}
    });

    $("#submitBtn").click(function(){
        let data = $("#UserInput").val();
        data = evalString(data);
        if(user.length > 0){
            if(data.length > 0){
                $.ajax({
                    type: "POST",
                    url: "userPageSubmit.php",
                    dataType: "text",
                    data: {
                        UserInput: data,
                        CurrentTime: time
                    },
                    success: function(){
                        $("#UserInput").val("");
                    }
                });
            }
        }
        else {
            document.location.href = "index.php";
        }
        
    })
    
   


    function getTime(){
        let date = new Date();
        let currtime = (date.getHours()+":"+date.getMinutes()+":"+date.getSeconds());
        time = currtime;
        setTimeout(getTime, 1000);
        
    }

    getTime();

    function evalString(data){
        let temp = data;
        for(let i = -1; i < data.length; i++){
            if(data[i] == "'") {
                temp = data.substring(0,i)+"'"+data.substring(i,data.length);
            }
                
        }
        return temp;
    }
