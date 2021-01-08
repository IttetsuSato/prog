//index.php-----------------------------------------------------------------------------------------------------------------------
//アカウント作成フォーム表示
$(".btn_account").on("click",function(){
  $(".btn_account").css('display','none');
  $(".form_area").css('display','block');
});
//アカウント作成フォーム閉じ
$(".form_area .batsu").on("click",function(){
  $(".form_area").css('display','none');
  $(".btn_account").css('display','block');
});
//マッチング画面
$(".btn_match_start").on("click",function(){
  window.location.href = 'match.php'; 
});
//タイマー
let time =10;
function timer(){
  if(time>0){
    time -=1;
    $(".timer").html(time);
  }else if(time == 0){
    $(".zoom_trigger")[0].click();
  }
}
function timer_start(){
  timerID = setInterval(timer,1000);
}
//カード表示
$(".back").animate({
  width: 0
}, 500, function() {
  $(".card").animate({
    width: 300
  },500)
  $(".card_prof").animate({
    opacity: 1
  },1200)
  timer_start();
});

