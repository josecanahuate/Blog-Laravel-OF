<x-app-layout>
    <div class="container py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            @foreach ($posts as $post)
                <article class="w-full h-80 bg-cover bg-center @if ($loop->first) col-span-2 md:col-span-2 @endif" style="background-image: url(@if ($post->image) {{ Storage::url($post->image->url)}} @else https://cdn.pixabay.com/photo/2023/11/23/20/40/ocean-8408693_1280.jpg @endif)">
                    <div class="w-full h-full px-8 flex flex-col justify-center">

                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts.tag', $tag)}}" class="inline-bock px-3 h-6 bg-{{$tag->color}}-600 text-white rounded-full">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                        <h1 class="text-4xl text-white leading-8 font-bold mt-2">
                            <a href="{{route( 'posts.show', $post)}}">
                                {{$post->name}}</a>
                        </h1>
                    </div>
                </article>
            @endforeach
        </div>
        
        {{-- links - paginacion --}}
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>