<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session()->has('success'))
                        <div class="bg-green-900 text-white">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div>
                        <a class="bg-blue-500 p-1" href="{{ route('articles.edit', ['article' => $article]) }}">Editer</a>
                        <form method="POST" action="{{ route('articles.delete', ['article' => $article]) }}">
                            @method('DELETE')
                            @csrf
                            <input class="bg-red-500 p-1" type="submit" value="supprimer">
                        </form>

                    </div>
                    <h1 class="font-extrabold">{{ $article->title }}</h1>
                    <div class="grid grid-cols-3 gap-4 justify-items-center w-full">
                        <p>{{ $article->published_at->diffForHumans() }}</p>
                        <p>{{ $article->user->name }}</p>
                        <p>Commentaire(s) : {{ $article->comments_count }}</p>
                    </div>

                    <p>{{ $article->content }}</p>
                    <h2 class="text-3xl my-5">Commentaires</h2>
                    @foreach ($article->comments as $comment)
                        @if ($comment->pseudo !== null)
                            <p class="font-bold">{{ $comment->pseudo }}</p>
                        @else
                            <p class="font-bold">{{ $comment->user->name }}</p>
                        @endif
                        <p>{{ $comment->created_at->diffForHumans() }}</p>
                        <p>{{ $comment->content }}</p>
                        <div class="grid grid-cols-2 gap-4 justify-items-center">
                            <a class="bg-blue-500 p-1"
                                href="{{ route('comments.edit', ['comment' => $comment]) }}">Editer</a>
                            <form method="POST" action="{{ route('comments.delete', ['comment' => $comment]) }}">
                                @method('DELETE')
                                @csrf
                                <input class="bg-red-500 p-1" type="submit" value="supprimer">
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
