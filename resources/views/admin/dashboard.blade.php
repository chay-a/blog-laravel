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
                    <div class="p-1">
                        <a class="bg-purple-500 p-2" href="{{ route('articles.create') }}">Créer un article</a>
                    </div>

                    @foreach ($articles as $article)
                        <a class="font-bold" href="{{ route('articles.show.admin', ['article' => $article]) }}">{{ $article->title }}</a>
                        <p>Nombre de commentaire(s) : {{ $article->comments_count }}</p>
                        @php
                            $trimedText = Str::limit($article->content, 100);
                            $shortText = substr($trimedText, 0, strrpos($trimedText, ' ')) . '...';
                        @endphp
                        <p>{{ $shortText }}</p>
                        <div>
                            <a class="bg-blue-500 p-1" href="{{ route('articles.edit', ['article' => $article]) }}">Editer</a>
                            <form method="POST" action="{{ route('articles.delete', ['article' => $article]) }}">
                                @method('DELETE')
                                @csrf
                                <input class="bg-red-500 p-1" type="submit" value="supprimer">
                            </form>

                        </div>
                    @endforeach
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
