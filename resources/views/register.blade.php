<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册 - {{$admin->title}}</title>
	<link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/message.css">
	<script type="text/javascript" charset="utf-8" src="../theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
	<style>
		body{
			background: #f4f4f4;
		}
		.passcard-box {
		    width: 900px;
		    padding-top: 48px;
		    margin: 0 auto;
		}
		.passcard-nav {
		    color: #444444;
		    padding-top: 40px;
		    line-height: 24px;
		    font-size: 24px;
		}
		.passcon {
		    min-height: 394px;
		    margin: 30px 0;
		    border-radius: 4px;
		    -webkit-border-radius: 4px;
		    -moz-border-radius: 4px;
		    background: #ffffff;
		}
		.passcon .passmail-title {
		    height: 76px;
		    line-height: 76px;
		    font-size: 24px;
		    text-align: center;
		    font-weight: normal;
		    border-top-left-radius: 4px;
		    border-top-right-radius: 4px;
		    background: #55c3dc;
		    color: #333333;
		}
		form {
		    display: block;
		    margin-top: 0em;
		}
		.passcon .retrieve-pass-box {
		    border-bottom-left-radius: 4px;
		    border-bottom-right-radius: 4px;
		    padding: 40px 0 40px;
    		border-top: none;
		}
		.passcon .retrieve-pass-box .retrie-center {
		    width: 500px;
		    margin: 0 auto;
		}
		.passcon .retrieve-pass-box .parent-input-box {
		    position: relative;
		}
		.country-phone-covers {
		    border: 1px solid #dddddd;
		    border-radius: 4px;
		    box-sizing: border-box;
		}
		input, textarea, select, button {
		    font-family: inherit;
		    font-size: 14px;
		    border: 0;
		    outline: none;
		    margin-bottom: 2px;
		}
		.passcon .retrieve-pass-box .passcard-btn, .passcon .retrieve-pass-box .qibtn {
		    width: 500px;
		    font-size: 16px;
		    height: 42px;
		    color: #fff;
		    background: #55c3dc;
		    border: 1px solid #55c3dc;
		    border-radius: 4px;
		    cursor: pointer;
		    text-align: center;
		    cursor: default;
		    font-family: inherit;
		    font-size: 14px;
		    border: 0;
		    outline: none;
		}
		.ipt-area-current {
		    width: 264px;
		    border-radius: 0 4px 4px 0;
		    float: left;
		    border: 0;
		    height: 42px;
		    padding-left: 20px;
		    padding-right: 20px;
		    color: #666666;
		    font-size: 14px;
		    border: 1px solid #dddddd;
		    background: #f4f4f4;
		    box-sizing: border-box;
		    border-radius: 4px;
		    font-family: inherit;
		    font-size: 14px;
		    border: 0;
		    outline: none;
		}
		.passcon .retrieve-pass-box .retrie-center .agreemen-txt {
		    font-size: 14px;
		    color: #666666;
		    margin: 20px 1px;
		}
		.checkbox-wrap label {
		    height: 14px;
		    line-height: 1;
		    display: inline-block;
		    vertical-align: middle;
		    zoom: 1;
		    cursor: pointer;
		    margin-right: 10px;
		    background-size: 14px;
		}

		.checkbox-wrap input[type="checkbox"]{
		    opacity: 0;
		    margin-right: 10px;
		    vertical-align: middle;
		    cursor: pointer;
		    box-sizing: border-box;
		    padding: 0;
		    margin-right: 10px;
		    background-size: 14px;
		    font-family: inherit;
		    font-size: 14px;
		    border: 0;
		    outline: none;
		}
		.checkbox-wrap .label-checkbox {
			background: url(/images/checkboxed.svg) no-repeat;
		}
		.checkbox-wrap .label-checkbox[checked='checked']{
			background: url(/images/checkbox.svg) no-repeat;
		}
		.passcon .retrieve-pass-box .parent-input-box {
	    position: relative;
	    display: block;
	}
	.passcon .retrieve-pass-box .retrie-center .text-wrong-style {
		    border: 1px solid #f75234;
		    background-color: #fdf6f5;
		    transition: 0.4s linear;
		    width: 500px;
		    padding-right: 40px;
		    height: 42px;
		    padding-left: 20px;
		    padding-right: 20px;
		    color: #666666;
		    font-size: 14px;
		    border: 1px solid #dddddd;
		    background: #f4f4f4;
		    box-sizing: border-box;
		    border-radius: 4px;
		    font-family: inherit;
		    font-size: 14px;
		    border: 0;
		    outline: none;
		}
		.passcon .retrieve-pass-box .retrie-center .form-eye-icon {
		    right: 10px;
		    top: 10px;
		    display: inline-block;
		    vertical-align: middle;
		    zoom: 1;
		    width: 22px;
		    height: 22px;
		    position: absolute;
		    cursor: pointer;
		    background-position: center;
		    background-image: url(/images/vericodeicon.png);
		    background-repeat: no-repeat;
        	font-style: normal;
		}
		.passcard-nav {
		    color: #444444;
		    padding-top: 40px;
		    line-height: 24px;
		    font-size: 24px;
		}
		.passcard-nav .login-nav {
		    color: #666666;
		    margin-left: 25px;
		    font-size: 14px;
		    float: right;
		}
		.passcard-nav .login-right-subnav {
		    margin-left: 25px;
		    font-size: 14px;
		    float: right;
	        color: #d36f16;
	        text-decoration: none;
		}
		.passcard-nav .login-nav:after {
		    content: '';
		    display: inline-block;
		    vertical-align: middle;
		    zoom: 1;
		    width: 1px;
		    height: 14px;
		    margin-top: -4px;
		    background: #666666;
		    margin-left: 20px;
		}
		.parent-input-box.js-h-from-ele div{
			position: relative;
		}
		.agreement{
			width: 900px;
			/*height: 100%;*/
			position: fixed;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			background-color: #fff;
			border: 1px solid eee;
			padding: 20px;
			/*margin-top: 100px;*/
			/*margin-bottom: 100px;*/
			display: none;
		}
		.agreement .head{
			font-size: 2em;
			font-weight: 900;
			text-align: center;
		}
		.agreement .article{
			height: 600px;
			overflow: auto;
		}
		.agreement .button{
			width: 100px;
			height: 40px;
			background-color: #55c3dc;
			border-radius: 20px;
			margin-top: 20px;
			position: relative;
			left: 50%;
			transform: translateX(-50%);
		}
	</style>
</head>
<body>
	<div class="passcard-box">

<div class="passcard-nav">
	<a href="#"></a>
	欢迎注册
	
		
		<a href="../" class="login-right-subnav main-link-color">返回首页</a>
		
				<span class="login-right-subnav login-nav">已有帐号，<a href="../login" class="main-link-color">马上登录</a></span>
			
	
</div>




		<!-- 登录导航以下内容 -->
        <div class="passcon">
            <h2 class="passmail-title main-bg-color">注册会员</h2>
            <form action="/register" id="form" method="POST" autocomplete="on">
                <div class="retrieve-pass-box z-p-covers">
                    <div class="retrie-center" id="inputparent">
                        <div class="parent-input-box js-h-from-ele">
                            <!-- <i class="setpassword"></i> -->
                            @csrf
                            <input type="text" autocomplete="on" name="username" id="username" pattern="[0-9a-zA-z-_]{1,100}" placeholder="用户名" maxlength="100" title="仅支持字母、数字、下划线、横线" class="text-style input-normal-style vericode transition-time text-wrong-style" value="{{old('username')}}" autofocus required>
                            <input type="email" autocomplete="on" name="email" id="email" placeholder="邮箱" title="邮箱可用于密码找回" class="text-style input-normal-style vericode transition-time text-wrong-style" value="{{old('email')}}" required>
                            <div>
                            	<input type="password" autocomplete="off" maxlength="100" name="password" id="password" placeholder="密码" title="不能使用中文作为密码" pattern="^[^\u2E80-\u9FFF]+$" class="text-style input-normal-style vericode transition-time text-wrong-style" required><i id="form-eye" class="form-eye-icon"></i>
                            </div>
                        </div>
                        <div class="agreemen-txt checkbox-wrap" id="checkbox-wrap">
                            <label id="checkbox" class="label-checkbox check-cd" for="Useragreement">
                                <input type="checkbox" checked="" name="autolog" id="Useragreement" class="check-c" required>我已阅读并接受<a href="javascript:;" id="agreement_click">用户协议</a>
                            </label>
                        </div>
                        <div class="passcard-btns register-btn">
                            <input type="submit" value="注册" id="z-p-registered" class="btn-disabled passcard-btn">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="agreement" class="agreement">
        	<div class="head">用户协议</div>
        	<div class="article">

				欢迎您使用本站服务（下称：本服务），您在使用本服务前请认真阅读以下协议（下称：本协议）。<br>
				一、站酷使用协议的接受<br>
				<br>
				当您在注册程序过程中在“已阅读，同意本《用户协议》”处打勾“√”并按照注册程序成功注册为本站用户，或您以其他本站允许的方式实际使用本站服务时，即表示您已充分阅读、理解并接受本协议的全部内容，并与本站达成协议<br>
				二、本协议的变更和修改<br>
				<br>
				本站有权随时对本协议进行修改，并且一旦发生协议条款的变动，本站将在相关页面上提示修改的内容；用户如果不同意本协议的修改，可以放弃使用或访问本网站或取消已经获得的服务；如果用户选择在本协议变更后继续访问或使用本网站，则视为用户已经接受本协议的修改。<br>
				三、服务说明<br>
				<br>
				1、本站是一个向广大用户提供信息存储空间，供用户上传、分享原创设计的交流平台。<br>
				<br>
				2、本站运用自己的系统通过互联网向用户提供服务，除非另有明确规定，增强或强化目前服务的任何新功能，包括新产品以及新增加的服务，均无条件地适用本协议。<br>
				四、用户行为<br>
				<br>
				用户需要实名认证完成账号注册，才能正常使用网站提供的服务。任何机构或个人注册和使用的互联网用户账号名称，必须符合《互联网用户账号名称管理规定》，用户必须承诺遵守法律法规、社会主义制度、国家利益、公民合法权益、公共秩序、社会道德风尚和信息真实性等七条底线。<br>
				<br>
				1、用户帐号、密码和安全<br>
				<br>
				（1）您在注册账号时必须通过实名认证，才能成为本站的合法用户，得到一个密码和账号。您可以利用账户，通过本服务上传您的作品，合法正当地使用平台提供的各项服务功能。<br>
				<br>
				（2）用户须对在本站的注册信息的真实性、合法性、有效性承担全部责任，用户不得使用他人的名义发布任何信息；当被发现用户冒用他人或机构的名义恶意注册帐号，本站有权立即停止提供服务，收回其帐号并由该用户承担由此而产生的一切法律及其他责任。<br>
				<br>
				（3）您应采取合理措施维护其密码和帐号的安全。用户对利用该密码和帐号所进行的一切活动负全部责任；由该等活动所导致的任何损失或损害由用户承担，本站不承担任何责任。<br>
				<br>
				（4）用户的密码和帐号遭到未授权的使用或发生其他任何安全问题，用户可以立即通知本站，并且用户在每次连线结束，应结束帐号使用，否则用户可能得不到本站公司的安全保护。<br>
				<br>
				（5）对于用户长时间未使用的帐号，本站有权予以关闭。<br>
				<br>
				2、用户发布内容的传播<br>
				<br>
				（1）您同意授权本站，有权通过本服务将您所上传的内容向全世界范围内不特定的网络用户展示。并授权本站以宣传为目的，在署名作者的前提下传播和使用您上传的内容。当任何第三方未经本站同意，转载、抓取、盗链包含用户内容在内的本站任何资料等行为时，用户同意并授权本站有权以本站的名义代表自己采取任何法律措施。<br>
				<br>
				（2）您理解并同意，您上传至本站的内容，若在上传过程中勾选了“禁止个人使用”，则未经您或本站的正式授权，任何个人或组织不得转载、保存或采集至任何第三方空间。若您在上传过程中勾选了“禁止匿名转载”，则任何个人及组织不得匿名转载您上传的内容至任何第三方空间。否则本站对前述行为有权要求第三方断开链接、删除并有权以本站的名义提起诉讼，以维护您的合法权益。<br>
				<br>
				（3）如果您通过本服务分享作品，则您保证：<br>
				<br>
				a 您所分享的作品均由您本人原创或已经依法获得原始权利人合法授权。<br>
				<br>
				b 您有权授权本站依据本服务的相关规则使用您的作品，包括但不限于将您上传的图片向其他用户推荐或推广。<br>
				<br>
				c 您所上传的图片符合国家相关法律法规和公序良俗，不会损害任何他方的合法权益或造成不良社会影响。<br>
				<br>
				d 本站依照本服务的规则使用您的作品，无须另行获得第三方同意或对第三方承担任何责任。<br>
				<br>
				3、禁止用户从事以下行为：<br>
				<br>
				（1）反对宪法所确定的基本原则的；<br>
				<br>
				（2）危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；<br>
				<br>
				（3）损害国家荣誉和利益的；<br>
				<br>
				（4）煽动民族仇恨、民族歧视，破坏民族团结的；<br>
				<br>
				（5）破坏国家宗教政策，宣扬邪教和封建迷信的；<br>
				<br>
				（6）散布谣言，扰乱社会秩序，破坏社会稳定的；<br>
				<br>
				（7）散布淫秽、赌博、暴力、凶杀、自残、恐怖或者教唆犯罪的；<br>
				<br>
				（8）侮辱或者诽谤他人，侵害他人合法权益（如名誉权、肖像权等）的；<br>
				<br>
				（9）侵害他人知识产权、商业秘密等合法权利的；<br>
				<br>
				（10）虚构事实、隐瞒真相以误导、欺骗他人的；<br>
				<br>
				（11）发布、传送、传播广告信息及垃圾信息的；<br>
				<br>
				（12）其他法律法规禁止的行为。<br>
				<br>
				如果您上传、发布或传输的内容含有以上违反法律法规的信息或内容，或者侵犯任何第三方的合法权益，您将直接承担以上导致的一切不利后果。<br>
				<br>
				4、用户对经由本网站上载、张贴、发送电子邮件或传送的内容承担全部责任<br>
				<br>
				（1）对于用户经由本站传送的内容，本站不保证其合法性、正当性、准确性、完整性或品质。用户在接受本网站服务后，在任何情况下，本站均不对任何内容承担任何责任，包括但不限于任何内容发生任何错误或纰漏以及衍生的任何损失或损害。本站有权（但无义务）自行拒绝或删除经由本网站提供的任何内容。<br>
				<br>
				（2）本站有权利在下述情况下，对内容进行保存或披露：<br>
				<br>
				a 法律程序所规定；<br>
				<br>
				b 本服使用协议规定；<br>
				<br>
				c 被侵害的第三人提出权利主张；<br>
				<br>
				d 为保护本站、其使用者及社会公众的权利、财产或人身安全；<br>
				<br>
				e 其他本站认为有必要的情况。<br>
				<br>
				5、对用户发布信息的存储和披露<br>
				<br>
				本站不对用户所发布信息的删除或储存失败承担责任。本站有权判断用户的行为是否符合本协议规定，如果本站认为用户违背了协议条款规定，有终止向其提供网站服务的权利。<br>
				五、关于隐私<br>
				<br>
				1、当您注册使用本服务时，需要自愿提供个人信息。在您的同意及确认下，本站将通过注册表格等形式要求您提供一些个人资料，您有权拒绝提供这些信息。<br>
				<br>
				2、在未经用户授权同意的情况下，本站不会公开、编辑或透露用户个人或企业信息，以下情况除外：<br>
				<br>
				（1）根据执法单位之要求或为公共之目的向相关单位提供个 人资料；<br>
				<br>
				（2）由于用户将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人资料泄露；<br>
				<br>
				（3）由于黑客攻击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被窜改等；<br>
				<br>
				（4）由于与本网站链接的其他网站所造成之个人资料泄露及由此而导致的任何法律争议和后果；<br>
				<br>
				（5）为免除访问者在生命、身体或财产方面之急迫危险；<br>
				<br>
				（6）为维护本站公司的合法权益。<br>
				<br>
				3、在以下（包括但不限于）几种情况下，本站有权搜集、使用用户的个人信息，收集信息是为了向您提供更好、更优、更个性化的服务：<br>
				<br>
				（1）企业会员所提供的资料将会被本网站统计、汇总，本网站会不定期地通过企业会员留下的信息资料同该企业会员保持联系。<br>
				<br>
				（2）本站可以将用户信息与第三方数据匹配。<br>
				<br>
				（3）本站会通过透露合计用户统计数据向第三方描述站酷服务。<br>
				<br>
				（4）本站所提供的服务会自动收集有关访问者的信息，这些信息包括访问者人数、访问时间、访问页面、来访地址等，本站使用这些信息来对我们的服务器进行分析和对网站进行管理。<br>
				<br>
				（5）将遵循由中国广告协会互动网络分会颁布的《中国互联网定向广告用户信息保护框架标准》，基于合法、合理和诚实信用的法定原则妥善处理或使用用户的个人信息。<br>
				<br>
				4、cookie是一个标准的互联网技术，它可以使我们存储和获得用户登录信息。本站使用cookie 来确保您不会重复浏览到相同的内容并可以获得最新的信息，并确认您是本站的成员之一。我们并不使用cookie来跟踪任何个人信息。<br>
				六、版权声明<br>
				<br>
				1、本站会员所发布展示的“原创作品”、“原创文章”等原创内容，版权由作者享有和解释，任何商业用途均须联系原作者。临摹作品，同人作品原型版权归原作者所有。<br>
				<br>
				2、原创内容的发布者必须确保其拥有发布内容的全部原创版权，或已经获得版权所有者及相关法律的授权，且不得侵犯他人著作权，肖像权，商标权等，不违背商业保密协议。本站默认所有原创类的内容的发布者已经获得发表、演绎等版权授权。若因发布内容产生法律纠纷，全部责任在于用户本人，本站不承担任何法律责任。<br>
				<br>
				3、会员在本站上发布的内容，视作授权其作品使用在本站平台上，授予本站免费的、非独家使用许可，本站有权将该内容用于本站各种形态的产品和服务上，包括但不限于本站网站以及本站官方发布的适用于手持终端设备的应用或其他互联网产品。<br>
				<br>
				4、如果任何第三方侵犯了本站用户相关的权利，用户同意授权本站或其指定的代理人代表本站自身或用户对该第三方提出警告、投诉、发起行政执法、诉讼、进行上诉（但非义务），或谈判和解，并且用户同意在本站认为必要的情况下参与共同维权。<br>
				<br>
				5、在未得到著作权人的授权时，也请不要将他人的作品全部或部分复制发表到本站，如转载站外信息到本站请署名和注明出处；否则，用户应承担相应的不利后果，站酷对此不承担任何责任。<br>
				<br>
				6、如个人或单位发现本站上存在侵犯其自身合法权益的内容，请及时与本站取得联系，并提供具有法律效应的证明材料，以便本站作出处理。本站有权（无义务）根据实际情况删除相关的内容，并追究相关用户的法律责任。给本站或任何第三方造成损失的，侵权用户应负全部责任。<br>
				<br>
				7、未经本站许可，任何人不得复制、转载、盗链、上载、下载、展示站酷上的任何资源、；不得复制或仿造本站或者在非本站所属服务器上建立镜像。否则，本站将依法追究法律责任。<br>
				<br>
				8、本站的标识、源代码、及所有页面的版式设计等，版权归本站所有。未经授权，不得用于除本站之外的任何站点。<br>
				七、免责声明<br>
				<br>
				1、除本站注明的服务条款外，其它因使用本站而导致任何意外、疏忽、合约毁坏、诽谤、版权或知识产权侵犯及其所造成的各种损失（包括因下载而感染电脑病毒），本站概不负责，亦不承担任何法律责任。<br>
				<br>
				2、本站不保证（包括但不限于）：<br>
				<br>
				（1）本网站适合用户的使用要求；<br>
				<br>
				（2）本网站不受干扰，及时、安全、可靠或不出现错误；<br>
				<br>
				（3）用户经由本网站取得的任何产品、服务或其他材料符合用户的期望。<br>
				<br>
				3、本服务可能会包含与其他网站或资源的链接，即第三方链接。本站对于前述网站或资源的内容、隐私政策和活动，无权控制、审查或修改，因而也不承担任何责任。建议您在离开本站服务，访问其他网站或资源前仔细阅读其服务条款和隐私政策。<br>
				<br>
				4、因用户内容在本网站的上载或发布，而导致任何第三方提出索赔要求或衍生的任何损害或损失，由用户承担全部责任，本站不承担任何责任。<br>
				<br>
				5、本站内会员所发言论仅代表网友自己，并不反映任何本站之意见及观点。<br>
				<br>
				6、本站认为，一切网民在进入本站主页及各层页面时已经仔细看过本条款并完全同意。<br>
				<br>
        	</div>
        	<button id="agreement_button" class="button">关闭</button>
        </div>
	</div>
	@include('layout.message')
<script>
$(function(){
	// alert(222)
	$('#checkbox-wrap label').on('click','input',function(){
		if($(this).parent().attr('checked') == 'checked'){
			console.log()
			$(this).parent().removeAttr('checked');
		}else{
			console.log(2)
			$(this).parent().attr('checked','checked');
		}
	});
	$('#form-eye').on('click',function(){
		if($(this).parent().children('input').attr('type') == 'password'){
			$(this).parent().children('input').attr('type','text');
			$(this).css('background-image','url(/images/disabledglance.png)');
		}else{
			$(this).parent().children('input').attr('type','password');
			$(this).css('background-image','url(/images/vericodeicon.png)');
		}
		
	});
	$('#agreement_button').on('click', function(){
		$('#agreement').css('display', 'none');
	});
	$('#agreement_click').on('click', function(){
		$('#agreement').css('display', 'block');
	})
});
</script>
<script src="../theme/{{$admin->theme}}/js/message.js"></script>
</body>
</html>
