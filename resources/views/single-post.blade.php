@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1>{{ $post->title }}</h1>

            <div>
                {!! $post->body !!}
            </div>

            <p>By <span class="text-primary">{{ $post->user->name }}</span></p>

        </div>

    </section>
@endsection
