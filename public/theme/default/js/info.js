$(function(){
    $.each($('#myCanvas'),function(i,n){
        coverimg($('#myCanvas').get(0),$.trim($('#myCanvas').attr('title')),$.trim($('#myCanvas').attr('data')));
    });
    // 点赞
    var admire = 0;
    $('#admire-box').on('click',function(){
        if(admire>0){
            return false;
        }
        var id = $(this).attr('data');
        var token = $('input[name="_token"]').attr('value');
        $(this).children('div').css('opacity','0.4');
        admire++;
        $.post('/admire/post/'+id, {'_token':token}, function(data){});
    });
    // 评论点赞
    // var comment_admire = 0;
    $('.comment-box-content-info-content-admire').on('click',function(){
        if($(this).attr('flag') == 'true'){
            return false;
        }
        var id = $(this).attr('data');
        var token = $('input[name="_token"]').attr('value');
        $(this).attr('flag', 'true');
        // comment_admire++;
        $(this).children('img').attr('src', '/images/dianzanhover.svg');
        $.post('/admire/comment/'+id, {'_token':token}, function(data){});
    });
    // 键盘提交
     $('#div1').on('keydown', function(event){
        if(event.ctrlKey && event.key == 'Enter'){
            $('#submit').click();
        }
     });
     // 修改wangEditor.js 4040行
    var E = window.wangEditor
    var editor = new E('#div1')
    var $text1 = $('#comment')
    editor.customConfig.menus = [
        'head',  // 标题
        'bold',  // 粗体
        'fontSize',  // 字号
        'fontName',  // 字体
        'italic',  // 斜体
        'underline',  // 下划线
        'strikeThrough',  // 删除线
        'foreColor',  // 文字颜色
        'backColor',  // 背景颜色
        'link',  // 插入链接
        // 'list',  // 列表
        'justify',  // 对齐方式
        // 'quote',  // 引用
        'emoticon',  // 表情
        'image',  // 插入图片
        'table',  // 表格
        'video',  // 插入视频
        // 'code',  // 插入代码
        'undo',  // 撤销
        'redo'  // 重复
    ]
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.customConfig.uploadImgMaxSize = 300 * 1024;
    editor.customConfig.uploadImgServer = '/upload/img/comment';  // 上传图片到服务器
    // editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
    editor.create()
    // 初始化 textarea 的值
    // $text1.val(editor.txt.html());

    $('#uploadBook').on('click',function(){
        var temp = Math.floor(Math.random()*9999);
        $('#upload').append('<form id="uploadBook'+temp+'" enctype="multipart/form-data"><input  type="file" name="uploadbook"></form>');
        $('#uploadBook'+temp+' input').click();
        $('#uploadBook'+temp+' input').on('change',function(){
            var file = this.files[0];
            if(file.size <= 30*1024*1024){
                var fileName = file.name;
                fileName = fileName.match(/([^\\\/]*\.(epub|mobi|pdf|azw|txt|mobi|doc|docx|azw3|rtf|html|htm|zip)$)/i);
                if(fileName && fileName.hasOwnProperty(1)){
                    $('table').append(
                        '<tr data="uploadBook'+temp+'"><td colspan="2">'+fileName[1]+'</td><td><progress></progress></td><td class="progress">准备上传</td><td class="start">上传</td><td class="del">删除</td></tr>');
                }else{
                    $('#notice').css('display', 'block');
                    $('#notice p').html('格式不支持!');
                    setTimeout(function(){
                        $('#notice').css('display', 'none');
                    },2000);
                }
            }else{
                $('#notice').css('display', 'block');
                $('#notice p').html('文件大小超过限制大小：30MB!');
                setTimeout(function(){
                    $('#notice').css('display', 'none');
                },2000);
            }
            
        });
    });
    //删除图书
    $("table").on('click','.del',function(){
        var id = $(this).parent().attr('data');
        $('input[data="'+id+'"]').remove();
        $(this).parent().remove();
    }).on('click','.start',function(){
        var post_id = $('#admire-box').attr('data');
        var id = $(this).parent().attr('data');
        var formData = new FormData($('#'+id)[0]);
        $('table tr[data="'+id+'"] .start').text('上传中');
        $.ajax({
            url: '/upload/book/add/'+post_id,
            type: 'POST',
            xhr: function(){
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ 
                    myXhr.upload.addEventListener('progress',function(e){
                        if(e.lengthComputable){
                            $('table tr[data="'+id+'"] progress').attr({value:e.loaded,max:e.total});
                            $('table tr[data="'+id+'"] .progress').text(Math.ceil(e.loaded/e.total*99)+'%');
                        }
                    }, false); // for handling the progress of the upload
                }
                return myXhr;
            },
            //Ajax事件
            // beforeSend: beforeSendHandler,
            success: function(data, status){
                // JSON.perase()
                // $('#bookList').append('<input type="hidden" name="book[] value="'+data.+'">');
                if(data.errno == 0){
                    $('table tr[data="'+id+'"] .del').remove();
                    $('table tr[data="'+id+'"] .start').text('成功').removeClass().attr('colspan','2');
                    $('table tr[data="'+id+'"] .progress').text('100%');
                }else{
                    $('table tr[data="'+id+'"] .start').text('失败');
                }

            },
            error: function(){
                $('table tr[data="'+id+'"] .start').text('失败');
            },
            // Form数据
            data: formData,
            //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false
        });

    });
});
// canvas绘制封面
function coverimg(canvas,title='无名天书',author='佚名'){
    if(author == ''){
        author = '佚名';
    }
    var temp = Math.floor(Math.random()*999);
    var ctx = canvas.getContext("2d");
    var img = document.getElementById("coverimg");
    ctx.drawImage(img,0,0,180,240);
    ctx.textAlign = "center";
    ctx.textBaseline = "middle"; 
    ctx.font = '25px Arial';
    ctx.fillText(title,90,92,180);
    ctx.font = '20px Arial';
    ctx.fillStyle="blue";
    ctx.fillText(author,90,148,180);        
}