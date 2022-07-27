<x-guest-layout>
    <header>
        <a href="{{route('home')}}">Accueil</a>
    </header>
    <main>
        @foreach ($articles as $article)
        <a href="{{route('article', ['article' => $article])}}">{{ $article->title }}</a>
        <p>{{$article->published_at->diffForHumans()}}</p>
        <p>Nombre de commentaire(s) : {{$article->comments_count}}</p>
        @php
        $trimedText = Str::limit($article->content, 500);
        $shortText = substr($trimedText, 0, strrpos($trimedText, ' ')) . '...';
        @endphp
        <p>{{ $shortText }}</p>

        @endforeach
        {{ $articles->links() }}
    </main>
</x-guest-layout>