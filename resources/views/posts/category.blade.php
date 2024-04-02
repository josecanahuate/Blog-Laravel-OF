<x-app-layout>
</x-app-layout>

<div class="mx-auto max-w-5xl px-2 sm:px-6 lg:px-8 py-8">
    <h1 class="text-center text-3xl uppercase font-bold mb-4">Categoria: {{$category->name}}</h1>
    @foreach ($posts as $post )
    <x-card-post :post="$post" /> 
    @endforeach

    <div class="mt-4">
        {{$posts->links()}}
    </div>
</div>