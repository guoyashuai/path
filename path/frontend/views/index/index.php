<input type="button" value="签到" id="but" onclick="check_but()">
<div id="tab">
</div>
<script src="jquery-2.1.4.min.js"></script>
<script>
    function check_but(){
        //alert(1)
        var qian=1;
        $.ajax({
            type: "GET",
            url: "index.php?r=index/qian",
            data: "qian="+qian,
            success: function(msg){
                //alert(msg);
                if(msg==1){
                    alert("今日已经签到了，请明天再来！");
                }else{
                    $("#tab").html(msg);
                }

            }
        });
    }
</script>