<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Afficher</title>
</head>
<body>

	<label>Titre</label>
	<p>{{ $book->titre }}</p>

	<label>Description</label>
	<p>{{ $book->description }}</p>

	<label>Annee de publication</label>
	<p>{{ $book->annee_de_publication }}</p>
	<label>ISBN</label>
	<p>{{ $book->isbn }}</p>

	@if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
	<label>Nom d'exemplaire disponibles</label>
	<p>{{ $book->nb_exemp_dispo}}</p>

	<label>Nom d'exemplaire total</label>
	<p>{{ $book->nb_exemp_total}}</p>
	@endif

	<label>Image</label>
	<p>{{ $book->image }}</p>

	<label>Categorie(s)</label>
	<p>
		@foreach($book->categories as $c)
	    {{ $c->name }} @if(!$loop->last), @endif
		@endforeach
	</p>

	<label>Auteur/Autrice(s)</label>
	<p>
		@foreach($book->authors as $a)
	    {{ $a->first_name }} {{ $a->last_name }}@if(!$loop->last), @endif
	@endforeach

	</p>
	
	<a href="{{ route('book.index') }}"><button>Retourner à la librairie</button></a>

</body>
</html>