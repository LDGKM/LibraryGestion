<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajouter un livre</title>
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

	<form action="{{ route('book.store') }}" method='POST'>
		@csrf
		
		<label>Titre</label>
		<input type="text" name="titre">
		<br>

		<label>Description</label>
		<input type="text" name="description">
		<br>

		<label>Annee de publication</label>
		<input type="text" name="annee_de_publication">
		<br>
		<label>ISBN</label>
		<input type="text" name="isbn" maxlength="13">
		<br>

		<label>Nombre Exemplaire</label>
		<input type="text" name="nb_exemp">
		<br>

		<label>Image</label>
		<input type="text" name="image">
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
		<input type="text" name="authors">
		<br>

		<button type="submit">Ajouter</button>
	</form>
</body>
</html>