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
                    <form method="POST" action="{{ route('articles.store') }}">
                        @csrf
                        <div>
                            <label for="title">Titre de l'article</label>
                            <input type="text" name="title" maxlength="250"/>
                        </div>
                        <div>
                            <label for="content">Contenu de l'article</label>
                            <textarea name="content" rows="30" cols="50" maxlength="5000"></textarea>
                        </div>
                        <div>
                            <label for="title">Catégories</label>
                            <select name="category">
                            <option value="">--Choissir une catégorie--</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="published_at">Date de publication</label>
                            <input type="datetime-local" name="published_at"
                                min="{{ date_create()->format('Y-m-d H:i:s') }}"
                                max="{{ date_create('+1 year')->format('Y-m-d H:i:s') }}" />
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
