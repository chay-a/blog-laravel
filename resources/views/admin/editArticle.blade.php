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
                    <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{$article->id}}">
                        <div>
                            <label for="title">Titre de l'article</label>
                            <input type="text" name="title" maxlength="250" value="{{ $article->title }}" />
                        </div>
                        <div>
                            <label for="content">Contenu de l'article</label>
                            <textarea name="content" rows="30" cols="50" maxlength="5000">{{ $article->content }}</textarea>
                        </div>
                        <div>
                            <button class="bg-gray-800 text-white" type="submit">
                                Envoyer
                            </button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
