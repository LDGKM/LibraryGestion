<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajouter un auteur</title>
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

	<form action="{{ route('author.store-missing') }}" method='POST'>
		@csrf

		@foreach ($manquants as $index => $auteur)

		<label>Auteur {{ $index+1 }}</label>
		<br>

		<label>First Name</label>
		<input type="text" name="authors[{{ $index }}][first_name]" value="{{ $auteur['first_name'] }}">
		<br>

		<label>Last Name</label>
		<input type="text" name="authors[{{ $index }}][last_name]" value="{{ $auteur['last_name'] }}">
		<br>

		<label>Biographie</label>
		<input type="text" name="authors[{{ $index }}][bio]">
		<br>
		<label>Birth Date</label>
		<input type="date" name="authors[{{ $index }}][birth_date]">
		<br>

		<label>Death Date</label>
		<input type="date" name="authors[{{ $index }}][death_date]">
		<br>

		<label>Nationalité</label>
		<input type="text" name="authors[{{ $index }}][nationalite]">
		<br>

		<label>Photo</label>
		<input type="text" name="authors[{{ $index }}][photo_path]">
		<br>

		@if(!$loop->last)<br>
		<br> @endif


		@endforeach

		<button type="submit">Ajouter</button>
	</form>
	<a href="{{ route('book.index') }}"><button>Annuler</button></a>
</body>
</html>