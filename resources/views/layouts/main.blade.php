<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
	<a href="{{ route('contacts.index') }}">All Contacts</a>{{ App\Contact::count() }}
	@foreach (App\Group::all() as $group)
		<a href="{{ route('contacts.index', ['group_id' => $group->id]) }}"> {{ $group->name }} </a> {{ $group->contacts->count() }}
	@endforeach

	@yield('content')
</body>
</html>