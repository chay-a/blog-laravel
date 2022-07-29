<x-guest-layout>
    <main>
        @if (session()->has('success'))
            <div class="bg-green-900 text-white">
                {{ session()->get('success') }}
            </div>
        @endif
        <h1 class="font-extrabold text-2xl">{{ $article->title }}</h1>
        <div class="grid grid-cols-3 gap-4 justify-items-center w-full">
            <p>{{ $article->published_at->diffForHumans() }}</p>
            <p>{{ $article->user->name }}</p>
            <p>Commentaire(s) : {{ $article->comments_count }}</p>
        </div>
        <p>{{ $article->content }}</p>
        <h2 class="text-2xl my-5">Commentaires</h2>
        @foreach ($article->comments as $comment)
            <div class="my-10">
                @if ($comment->pseudo !== null)
                    <p class="font-bold">{{ $comment->pseudo }}</p>
                @else
                    <p class=font-bold>{{ $comment->user->name }}</p>
                @endif
                <p>{{ $comment->created_at->diffForHumans() }}</p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
        <div>

            <h3 class="text-2xl my-5">Ajouter un commentaire</h3>
            <form action="{{ route('comments.create') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $article->id }}" name="articleId">
                @auth
                    <p>Name : {{ Auth::user()->name }}</p>
                    @elseguest
                    <div>
                        <label>Pseudo</label>
                        <input type="text" name="pseudo" />
                    </div>
                    <div>
                        <label>email</label>
                        <input type="text" name="email" />
                    </div>
                @endauth
                <div>
                    <label>Commentaire</label>
                    <textarea name="content" id="comment-content" cols="30" rows="10" maxlength="2000"></textarea>
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
    </main>
</x-guest-layout>
