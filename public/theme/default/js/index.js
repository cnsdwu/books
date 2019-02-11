$(function(){
    $.each($('.myCanvas'),function(i,n){
        // console.log(this)
        coverimg(this,$.trim($(this).attr('title')),$.trim($(this).attr('data')));
    });
    // coverimg($(''))

});
if(window.location.pathname == '/new'){
    $('#forum-li a').css('border-bottom','2px solid #444').css('color', '#55c3dc');
}else if(window.location.pathname == '/click'){
    $('#data-li a').css('border-bottom','2px solid #444').css('color', '#55c3dc');
}else{
    $('#course-li a').css('border-bottom','2px solid #444').css('color', '#55c3dc');
}

function coverimg(canvas,title='无名天书',author='佚名'){
    if(author == ''){
        author = '佚名';
    }
    var temp = Math.floor(Math.random()*999);
    // $('body').append('<img id="coverimg'+temp+'" src="default/images/cover.jpg" style="display:none">');
    // var c=document.getElementById(canvas);
    var ctx = canvas.getContext("2d");
    // console.log(ctx)
    var img = document.getElementById("coverimg");
    ctx.drawImage(img,0,0,96,128);
    ctx.textAlign = "center";
    ctx.textBaseline = "middle"; 
    ctx.font = '15px Arial';
    ctx.fillText(title,48,49,96);
    ctx.fillStyle="blue";
    ctx.fillText(author,48,79,96);        
}