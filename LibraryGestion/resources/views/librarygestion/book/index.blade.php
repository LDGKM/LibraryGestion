<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library</title>
</head>
<body>
	
	
	
</body>
</html>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

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
								<a href="{{ route('book.show',$b->id) }}"><button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M322.5-437.5Q340-455 340-480t-17.5-42.5Q305-540 280-540t-42.5 17.5Q220-505 220-480t17.5 42.5Q255-420 280-420t42.5-17.5Zm200 0Q540-455 540-480t-17.5-42.5Q505-540 480-540t-42.5 17.5Q420-505 420-480t17.5 42.5Q455-420 480-420t42.5-17.5Zm200 0Q740-455 740-480t-17.5-42.5Q705-540 680-540t-42.5 17.5Q620-505 620-480t17.5 42.5Q655-420 680-420t42.5-17.5ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></button></a>

								<a href="{{ route('book.borrow',$b->id) }}"><button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg></button></a>
								<br>
								@if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
								<a href="{{ route('book.edit',$b->id) }}"><button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg></button>
								</a>
								@endif

								<br>

								@if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
								<form action="{{ route('book.destroy',$b->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></button>
								</form>
								@endif
							</td>
						</tr>
						@endforeach
					</table>


    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
    <a href="{{ route('book.create') }} "><button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg></button></a>
    @endif
</x-app-layout>
