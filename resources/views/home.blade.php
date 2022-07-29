<x-guest-layout>

    <main class="bg-grey-500">
        @foreach ($articles as $article)
            <div class="bg-white p-2">
                <a class="font-bold text-xl"
                    href="{{ route('articles.show', ['article' => $article]) }}">{{ $article->title }}</a>
                <p>{{ $article->published_at->diffForHumans() }}</p>
                <p>Nombre de commentaire(s) : {{ $article->comments_count }}</p>
                @php
                    $trimedText = Str::limit($article->content, 500);
                    $shortText = substr($trimedText, 0, strrpos($trimedText, ' ')) . '...';
                @endphp
                <p>{{ $shortText }}</p>
            </div>
        @endforeach
        {{ $articles->links() }}
    </main>
</x-guest-layout>
