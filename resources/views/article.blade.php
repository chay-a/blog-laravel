<x-guest-layout>
    <header>
        <a href="{{route('home')}}">Accueil</a>
    </header>
    <main>
        <h1>{{$article->title}}</h1>
        <p>{{ $article->published_at->diffForHumans() }}</p>
        <p>{{$article->user->name}}</p>
        <p>Commentaire(s) : {{$article->comments_count}}</p>
        <p>{{$article->content}}</p>
        <h2>Commentaires</h2>
        @foreach ($article->comments as $comment)
        @if ($comment->pseudo !== null)
        <p>{{$comment->pseudo}}</p>
        @else
        <p>{{$comment->user->name}}</p>
        @endif
        <p>{{ $comment->created_at->diffForHumans() }}</p>
        <p>{{$comment->content}}</p>
        @endforeach
        <div>

            <h3>Ajouter un commentaire</h3>
            <form action="{{route('create.comment')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$article->id}}" name="articleId">
                @if(Auth::check())
                <p>Name : {{Auth::user()->name}}</p>
                @else
                <div>
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" />
                </div>
                <div>
                    <label>email</label>
                    <input type="text" name="email" />
                </div>
                @endif
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