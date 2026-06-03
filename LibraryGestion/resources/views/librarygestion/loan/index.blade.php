<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emprunter</title>
</head>
<body>
	@if(auth()->check())
	<form action="{{ route('borrow.pendingStore') }}" method='POST'>
		@csrf
		<input type="text" name='user_id' value='{{ auth()->id() }}' hidden>
		<input type="text" name="book_id" value="{{ $book->id }}" hidden>
		<label>Titre</label>
		<p>{{ $book->titre }}</p>

		<label>Categories</label>
		<p>
		@foreach($book->categories as $c)
		{{ $c->name }}@if(!$loop->last),@endif
		@endforeach
		</p>

		<label>Authors</label>
		<p>
		@foreach($book->authors as $a)
		{{ $a->first_name }} {{ $a->last_name }} @if(!$loop->last),@endif
		@endforeach
		</p>

		<label>ISBN</label>
		<p>{{ $book->isbn }}</p>
		<button type="submit">Emprunter</button>
	</form>
	@endif
</body>
</html>