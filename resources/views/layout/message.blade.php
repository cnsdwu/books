<div id="notice" class="notice">
    <p>这是一段提示文本！</p>
</div>
<div id="session" class="session">
	@if ($errors->any())
		<span id="error">2</span>
		<span id="message">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
    	</span>
    @else
	<span id="error">{{session('error')}}</span>
	<span id="message">
		{{session('message')}}
	</span>
    @endif
</div>