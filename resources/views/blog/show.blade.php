@extends('layouts.app')
@section('content')
@if (session()->has('message'))

<div class="bg-green-500 rounded-lg py-5 px-6 mb-4 text-base text-green-800" role="alert">
    <h4 class="text-2xl font-medium leading-tight mb-2">{{ session()->get('message')}}</h4>

</div>
@endif

<div class="container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold">{{ $post->title }}</h1>
    <div class="mt-2">
        By : <span class="text-gray-500 italic">{{ $post->user->name }}</span>
        on : <span class="text-gray-500 italic">{{ date('d-m-y',strtotime($post->updated_at)) }}</span>

    </div>
</div>

<div class="container m-auto pt-15 pb-5">
    <div class="flex h-96">
        <img class="object-cover w-full" src="/images/{{ $post->image_path }}" alt="">
    </div>
    <p class="text-l text-gray-700 py-8 leading-6">
        {{ $post->discription }}
    </p>
    @if (Auth::user() && Auth::user()->id == $post->user_id)
    <a href="{{ $post->slug }}/edit"
        class="bg-green-700 text-gray-100 py-4 px-5 mt-6 inline-block rounded-lg font-bold uppercase text-l place-self-start">
        Edit Post
    </a>
    <form action="/blog/{{ $post->slug }}" method="post" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="bg-red-700 text-red-100 py-4 px-5 mt-6 inline-block rounded-lg font-bold uppercase text-l place-self-start">
            Delete Post
        </button>
    </form>

    @endif
</div>

@endsection