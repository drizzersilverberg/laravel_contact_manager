@include('layouts.partials.header')
    <!-- navbar -->
    @include('layouts.partials.navbar')

    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <?php $selected_group = Request::get("group_id") ?>

            <a href="{{ route('contacts.index') }}" class="list-group-item {{ empty($selected_group) ? 'active' : '' }}">All Contact <span class="badge">{{ App\Contact::count() }}</span></a>

            @foreach (App\Group::all() as $group)
              <a href="{{ route('contacts.index', ['group_id' => $group->id]) }}" class="list-group-item {{ $selected_group == $group->id ? 'active' : '' }}">{{ $group->name }} <span class="badge">{{ $group->contacts->count() }}</span></a>
            @endforeach
          </div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-9">
          @if(session('message'))
            <div class="alert alert-success">
              {{ session('message') }}
            </div>
          @endif

          @yield('content')
        </div>
      </div>
    </div>

    @include('layouts.partials.footer')