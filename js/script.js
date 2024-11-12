console.log('ok');
$('select').change(function() {
    let a = $(this).val();
    if (a == '2') {
        $("#card").show();
    }
    else{
        $("#card").hide();
    }
})
$('#card').click(function(){
    $('.have').css('display','block');
});

$(function(){
    // 1回目のアクセス
    if($.cookie("access") === undefined) {
      //alert("初回です");
      $.cookie("access","onece");
    //   $(".mod_message").css("display","block")
    	
    $(".top").addClass("anime");
    // 2回目以降
    } else {
        console.log('a');
      //alert("二回目以降です");
    }
  });