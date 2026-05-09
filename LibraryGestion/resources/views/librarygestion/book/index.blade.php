<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library</title>
</head>
<body>
	<form action="{{ route('book.search') }}" method="POST">
		@csrf
		<input type="text" name="search">
		<button type="submit"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg></button>
	</form>
	<table>
		<tr>
			<td>Nom du Livre</td>
			<td>Auteur/Autrice(s)</td>
			<td>Categorie(s)</td>
			<td>Actions</td>
		</tr>
		@foreach($books as $b)
		<tr>
			<td>{{ $b->titre }}</td>
			<td>
				@foreach($b->authors as $a)
				{{ $a->first_name }} {{ $a->last_name }} @if(!$loop->last), @endif

				@endforeach
			</td>
			<td>
				@foreach($b->categories as $c)
				{{ $c->name }} @if(!$loop->last), @endif
				@endforeach
			</td>
			<td>
				<a href="{{ route('book.show',$b->id) }}"><button>Détails</button></a>

				<br>
				<a href="{{ route('book.edit',$b->id) }}"><button>Modifier</button></a>

				<br>

				<form action="{{ route('book.destroy',$b->id) }}" method="POST">
					@csrf
					@method('DELETE')
					<button type="submit">Supprimer</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	<a href="{{ route('book.create') }} "><button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>Ajouter un livre</button></a>
</body>
</html>