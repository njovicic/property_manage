$(document).ready(function () {
    fixFooter();

    $(".form-ajax-btn").click(function(e){
        e.preventDefault();
        var btn=$(this);
        formAjaxSubmit(btn,commonSucHdl,commonErrHdl);
    });

    /*$("#addItem").click(function(){
        var count = $("#itemCount"), countNum = count.val();
        count.val(++countNum);
        var btnValue = $(this).val(), url = './new_package_page.php', data = {'action': btnValue, 'count': count};
        $("#itemDiv").append("<label>Location: </label><select id='loc"+count+"'></select>" +
            "<label>Item: </label><select id='item"+count+"'></select><br>");

        $.ajax({
            url:url,
            type:'post',
            data:data
        }).then(function(r){
            var result = JSON.parse(r);
            var itemSelect = $("#item"+count);
            for (var item in result.data.response['items']){
                var itemOptions = document.createElement("option");
                itemOptions.text = item.get("itemName");
                itemSelect.add(itemOptions);
            }
            var locSelect = $("#loc"+count);
            var locOptions = "";
            for (var location in result.data.response["locations"]){
                itemHtml = "<option value='"+location.locId+"'>location.locName</option>";
            }
            locSelect.add(locHtml);
        }).catch(function(){alert("error")});
    });*/
});
//get the height of current browser, calculate current windows' component height
function fixFooter(){
    var windowHeight=$(window).height();
    var headHeight=$("#head").height();
    var footHeight=$("#foot").height();
    var bodyHeight=windowHeight-headHeight-footHeight;
    $("#body").css("min-height",bodyHeight);
}

function formAjaxSubmit(btn,success,error){
    var f=btn.closest("form.form-ajax-post");
    //var f=$(".form-ajax-post");
    var u=f.attr("data-action");
    var data=f.serialize();
    $.ajax({
        url:u,
        type:'post',
        data:data,
        success:function(result){
            var r=JSON.parse(result);
            if(r.success){
                success(r);
                headerPage(f.attr('data-url'));
            }
            else{
                error(r);
            }
        },
        error:function(r){
            alert("connection error");
        }
    })
}
function commonSucHdl(r){
    alert(r.info);
}
function commonErrHdl(r){
    alert(r.error);
}
function headerPage(url){
    window.location.href=url;
}


