@extends('layouts.app')
@section('content')
@if (session()->has('message'))
<div class="bg-red-500 rounded-lg py-5 px-6 mb-4 text-base text-green-800" role="alert">
    <h4 class="text-2xl font-medium leading-tight mb-2">{{ session()->get('message')}}</h4>

</div>
@endif
<div class="container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold"> All Posts</h1>
</div>



@if (Auth::check())
<div class="container sm:grid mx-auto px-5 border-b border-gray-300">
    <a href="blog/create"
        class="bg-green-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l place-self-start">
        New Post
    </a>
</div>
@endif


@foreach ( $posts as $post)
<div class="container sm:grid grid-cols-2 gap-15 mx-auto py-15 px-5 border-b border-gray-300">
    <div class="flex">
        <img class="object-cover" src="images/{{ $post->image_path }}" alt="">
    </div>
    <div class="">
        <h2 class="text-gray-700 font-bold text-4xl py-5 md:pt-0">
            {{ $post->title }}
        </h2>
        <span>
            By : <span class="text-gray-500 italic">{{ $post->user->name }}</span>
            on : <span class="text-gray-500 italic">{{ date('d-m-y',strtotime($post->updated_at)) }}</span>
            <p class="text-l text-gray-700 py-8 leading-6">
                {{ $post->discription }}
            </p>
            <a href="blog/{{ $post->slug }}"
                class="bg-gray-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l place-self-start">
                Read More
            </a>
        </span>
    </div>
</div>
@endforeach


@endsection