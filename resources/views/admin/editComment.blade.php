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
                     <form action="{{ route('comments.update', ['comment' => $comment]) }}" method="POST">
                         @csrf
                         @method('PUT')
                         <input type="hidden" name="id" value="{{$comment->id}}">
                         <input type="hidden" name="articleId" value="{{$comment->article_id}}">
                         @if ($comment->user_id)
                             <p>Name : {{ $comment->user->name }}</p>
                         @else
                             <p>{{ $comment->pseudo }}</p>
                             <p>{{ $comment->email }}</p>
                         @endif
                         <div>
                             <label>Commentaire</label>
                             <textarea name="content" id="comment-content" cols="50" rows="30" maxlength="2000">{{$comment->content}}</textarea>
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
