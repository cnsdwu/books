$(function(){
    $('#aUploadBook').on('click',function(){
        var temp = Math.floor(Math.random()*9999);
        $('#upload').append('<form id="uploadBook'+temp+'" enctype="multipart/form-data"><input  type="file" name="uploadbook"></form>');
        $('#uploadBook'+temp+' input').click();
        $('#uploadBook'+temp+' input').on('change',function(){
            var file = this.files[0];
            if(file.size <= 30*1024*1024){
                var fileName = file.name;
                fileName = fileName.match(/([^\\\/]*\.(epub|mobi|pdf|azw|txt|pdf|mobi|doc|docx|azw3|rtf|html|htm|zip)$)/i);
                if(fileName && fileName.hasOwnProperty(1)){
                    if($('#bookList div p').text().indexOf(fileName[1])){
                        $('#bookList').append(
                            '<div data="uploadBook'+temp+'"><p>'+fileName[1]+'</p><progress></progress><s>准备上传</s><span class="start">上传</span><span class="del">删除</span></div>');
                        $('#uploadBook'+temp).attr('data','true');
                    }else{
                        $('#uploadBook'+temp).remove();
                        error('文件已存在!');
                    }
                }else{
                    $('#uploadBook'+temp).remove();
                    error('文件格式不支持!');
                }
            }else{
                error('文件大小超过限制大小：30MB!');
            }
        });
    });

            
    //上传封面
    $('#aUploadCover').on('click',function(){
        var temp = Math.floor(Math.random()*9999);
        $('#upload #cover input').click();
        $('#upload #cover input').on('change',function(){
            var file = this.files[0];
            if(file.size <= 3*1024*1024){
                var fileName = file.name;
                fileName = fileName.match(/([^\\\/]*\.(png|jpg|gif|jpeg|bmp|tiff|pcx|tga|exif|fpx|svg|psd|cdr|pcd|dxf|ufo|eps|ai|raw|WMF|webp)$)/i);
                if(fileName && fileName.hasOwnProperty(1)){
                    $('#coverList').html('<div><p>'+fileName[1]+'</p><progress></progress><s>准备上传</s><span class="start">上传</span><span class="del">删除</span></div>');
                }else{
                    error('文件格式不正确!');
                }
            }else{
                error('文件大小超过限制大小：3MB!');
            }
        });
        
    });
    //删除图书
    $("#bookList").on('click','.del',function(){
        var id = $(this).parent().attr('data');
        $('input[data="'+id+'"]').remove();
        $(this).parent().remove();
    }).on('click','.start',function(){
        var id = $(this).parent().attr('data');
        var formData = new FormData($('#'+id)[0]);
        $('#bookList div[data="'+id+'"] .start').text('上传中');
        $.ajax({
            url: '/upload/book/book',
            type: 'POST',
            xhr: function(){
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ 
                    myXhr.upload.addEventListener('progress',function(e){
                        if(e.lengthComputable){
                            $('#bookList div[data="'+id+'"] progress').attr({value:e.loaded,max:e.total});
                            $('#bookList div[data="'+id+'"] s').text(Math.ceil(e.loaded/e.total*99)+'%');
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
                    $('#bookList').append('<input type="hidden" name="book[]" data="'+id+'" value="'+data.data+'">');
                    $('#bookList div[data="'+id+'"] .start').text('成功').removeClass();
                    $('#bookList div[data="'+id+'"] s').text('100%');
                }else{
                    error(data.data);
                }

            },
            // error: errorHandler,
            // Form数据
            data: formData,
            //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false
        });

    });
    //删除封面
    $("#coverList").on('click','.del',function(){
        $('#coverList input').remove();
        $(this).parent().remove();
        // console.log();
    }).on('click','.start',function(){
        var formData = new FormData($('#upload #cover')[0]);
        $('#coverList div .start').text('上传中');
        $.ajax({
            url: '/upload/book/cover',
            type: 'POST',
            xhr: function(){
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ 
                    myXhr.upload.addEventListener('progress',function(e){
                        if(e.lengthComputable){
                            $('#coverList div progress').attr({value:e.loaded,max:e.total});
                            $('#coverList div s').text(Math.ceil(e.loaded/e.total*99)+'%');
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
                    $('#coverList').append('<input type="hidden" name="cover" value="'+data.data+'">');
                    $('#coverList div .start').text('成功').removeClass();
                    $('#coverList div s').text('100%');
                }else{
                    error(data.data);
                }

            },
            // error: errorHandler,
            // Form数据
            data: formData,
            //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false
        });

    });
    //点击添加标签
    var tempNum = 1;
    $("#tag>span").on('click',function(){
        if(tempNum>5){
            error('标签最多添加5个!');
            return false;
        }
        var temp = $.trim($('#tag>input')[0].value);
        if(temp){
            $('#tagInput').append('<input type="hidden" name="tag[]" value="'+temp+'">');
            $('#tag>p').append('<span>'+temp+'<s title="删除" data="'+temp+'">×</s></span>');
            $('#tag>input')[0].value = '';
            tempNum++;
        }
    });
    //删除标签
    $('#tag>p').on('click','s',function(){
        $('#tag input[value="'+$(this).attr('data')+'"]').remove();
        
        $(this).parent().remove();
        tempNum--;
    });
    //回车添加表单
    $('#tag>input').on('keydown',function(event){
        if(event.key == 'Enter'){
            $('#tag>span').click();
            event.preventDefault();
        }
    });

    function error(message=''){
        $('#uploadError div').html(message);
        $('#uploadError').css('display','block');
        setTimeout(function(){
            $('#uploadError').css('display','none');
        },1000);
    }
     // 修改wangEditor.js 4040行
    var E = window.wangEditor
    var editor = new E('#div1')
    var $text1 = $('#bookInfo')
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
        'list',  // 列表
        'justify',  // 对齐方式
        'quote',  // 引用
        'emoticon',  // 表情
        'image',  // 插入图片
        'table',  // 表格
        'video',  // 插入视频
        'code',  // 插入代码
        'undo',  // 撤销
        'redo'  // 重复
    ]
    editor.customConfig.onblur = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.customConfig.uploadImgMaxSize = 1024 * 1024;
    editor.customConfig.uploadImgServer = '/upload/img/post';  // 上传图片到服务器
    // editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
    editor.create()
    // 初始化 textarea 的值
    // $text1.val(editor.txt.html())
});