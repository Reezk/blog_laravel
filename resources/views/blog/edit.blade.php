@extends('layouts.app')
@section('content')

<div class="container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold"> Edit Post</h1>
</div>

<div class="container m-auto pt-15 pb-5">
    <form action="/blog/{{ $post->slug }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $post->title }}"
            class="w-full h-20 text-6xl rounded-lg shadow-lg border-b p-15 mb-15">
        <textarea name="discription" class="w-full h-20 text-l rounded-lg shadow-lg border-b p-15  mb-15">
            {{ $post->discription }}
        </textarea>
        <div class="flex ">
            <div class="mb-3 w-96">
                <label for="formFileLg" class="form-label inline-block mb-2 text-gray-700">
                    Large image input example
                </label>
                <input name="image" class="form-control
              block
              w-full
              px-2
              py-1.5
              text-xl
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file">
            </div>
        </div>
        <button type="submit" class="bg-green-700 hover:bg-green-200 text-gray-200 hover:text-gray-700
        transition duration-300 cursor-pointer p-5 rounded-lg font-bold uppercase ">submit the
            post</button>
    </form>
</div>

@endsection