
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传图书 - {{$admin->title}}</title>
    <link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/header.css">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/post.css">
    <script type="text/javascript" charset="utf-8" src="theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
    <script type="text/javascript" src="theme/{{$admin->theme}}/js/wangEditor.js"></script>
    <style>

       
    </style>
</head>
<body>
    @include('layout.header')

    <main class="main-wrapper" style="">
        <div class="wrapper" style="">
            <div class="article" style="">
                <form action="/post/add" method="post" enctype="multipart/form-data" autocomplete="on">
                    @csrf
                    <div class="middle-title-wrap">
                        <h2 class="middle-title">上传图书</h2>
                    </div>
                    <div class="upload-con-box">
                        <div class="upload-con-title">
                            图书信息
                        </div>
                        <div class="work-verify">
                            <input class="bookname" type="text" name="title" value="{{old('title')}}" placeholder="图书名称" pattern="[^$%#!@~^`&*]*" autofocus required>
                            <input class="author" type="text" name="author" value="{{old('author')}}" placeholder="图书作者" pattern="[^$%#!@~^`&*]*" autofocus required>
                            <div class="category">
                                <span>图书分类</span>
                                <select name="category" id="123">
                                    @foreach($category as $value)
                                        <option value="{{$value->id}}" 
                                            @if(old('category')==$value->id)
                                                selected
                                            @endif
                                            >{{$value->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="div1"></div>
                            <textarea id="bookInfo" class="bookInfo" name="bookInfo" cols="30" rows="10" placeholder="图书简介">{{old('bookInfo')}}</textarea>
                        </div>
                    </div>
                    <div class="upload-con-box">
                        <div class="upload-con-title">
                            上传图书
                        </div>
                        <div class="work-verify">

                                <div id="bookList" class="bookList">
                                </div>
                                <a id="aUploadBook" class="aUploadBook">本地上传</a>
                                <a>远程导入</a>
                        </div>
                    </div>
                    <div class="upload-con-box">
                        <div class="upload-con-title">
                            添加标签
                        </div>
                        <div class="work-verify">
                            <div id="tag" class="tag">
                                <div id="tagInput" class="tagInput">

                                </div>
                                <input type="text">
                                <span>贴标签</span>
                                <p>
                                
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="upload-con-box">
                        <div class="upload-con-title">
                            上传封面
                        </div>
                        <div class="work-verify">
                            <div id="uploadCoverDiv" >
                                <input id="uploadCover" class="uploadCover" type="file" name='uploadCover'>
                            </div>
                            <div id="coverList" class="coverList">
                            </div>
                            <a id="aUploadCover" class="aUploadCover">本地上传</a>
                            <a>远程导入</a>
                        </div>
                    </div>
                    <button id='submit' class="submit">提交审核</button>
                </form>
                <div id="upload">
                    <form id="cover" enctype="multipart/form-data"><input  type="file" name="uploadCover"></form>
                </div>
            </div>
        </div>
    </main>
    <!-- 错误提示信息 -->
    <div id="uploadError" class="uploadError">
        <img src="/images/fail.png" alt="">
        <div>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <script>
                    // $(function{
                        // alert(2222)
                        $('#uploadError').css('display','block');
                        setTimeout(function(){
                            $('#uploadError').css('display','none');
                        },2000);
                    // })
                </script>
            @endif
        </div>

    </div>

<script>
    $('#bbb').change(function(){
    //     console.log($(this))
    // var file = this.files[0];
    // name = file.name;
    // size = file.size;
    // type = file.type;
    //your validation
});


</script>
<script src="theme/{{$admin->theme}}/js/main.js"></script>
<script src="theme/{{$admin->theme}}/js/post.js"></script>
</body>
</html>