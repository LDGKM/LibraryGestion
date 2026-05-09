<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modifier</title>
</head>
<body>
	@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<form action="{{ route('book.update',$book->id) }}" method='POST'>
		@csrf
		@method('PUT')
		<label>Titre</label>
		<input type="text" name="titre" value="{{ $book->titre }}">
		<br>

		<label>Description</label>
		<input type="text" name="description" value="{{ $book->description }}">
		<br>

		<label>Annee de publication</label>
		<input type="text" name="annee_de_publication" value="{{ $book->annee_de_publication }}">
		<br>
		<label>ISBN</label>
		<input type="text" name="isbn" value="{{ $book->isbn }}">
		<br>

		<label>Nombre Exemplaire</label>
		<input type="text" name="nb_exemp" value="{{ $book->nb_exemp }}">
		<br>

		<label>Image</label>
		<input type="text" name="image" value="{{ $book->image }}">
		<br>

		<label>Catégorie</label>
		<label>
		@foreach($categories as $c)
		<input type="checkbox" value="{{ $c->id }}" name="categories[]">
		{{ $c->name}}
		@endforeach
		</label>
		<br>

		<label>Auteur</label>
		<input type="text" name="titre" value="@foreach($book->authors as $a)
		{{$a->first_name}} {{ $a->last_name }} @if(!$loop->last), @endif
		@endforeach
		">
		<br>

		<button type="submit">Modifier</button>
	</form>

	<a href="{{ route('book.index') }}">
		<button>Annuler</button>
	</a>
</body>
</html>