<h1 class="text-center">

	<h3>Hello there</h3>
	<p>A new post has been created by {{$post->user->name}} </p>
	<h3>{{$post->title}}</h3>
	<p>{{$post->body}}</p>
	<small>{{$post->created_at}}</small>
</h1>