<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
</head>

<body>
    <header>
        <a href="{{route('home')}}">Accueil</a>
    </header>
    <main>
        @foreach ($articles as $article)
        <a href="{{route('article', ['id' => $article->id])}}">{{ $article->title }}</a>
        <p>Nombre de commentaire(s) : {{count($article->comments)}}</p>
        @php
            $trimedText = Str::limit($article->content, 500);
            $shortText = substr($trimedText, 0, strrpos($trimedText, ' ')) . '...';
        @endphp
        <p>{{ $shortText }}</p>
        
        @endforeach
        {{ $articles->links() }}
    </main>
</body>

</html>