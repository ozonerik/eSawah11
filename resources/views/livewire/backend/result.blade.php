<div>
    <x-content_header name="Search result" >
        <li class="breadcrumb-item active">Search result</a></li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_list width="12" title="{{ $user->count() }} result searching for '{{ $search }}' ">
        @if($user->isNotEmpty())
            @foreach($user as $row)
            <x-card_listitem photo="{{asset('dist/img/default-150x150.png')}}" link="#" title="{{$row->name}}" desc="Sawah Mundu" value="1.000.000" />
            @endforeach
        @else
            <h4 class="text-center text-info my-5"> Sorry, No result found ! </h4>
        @endif
        </x-card_list>
    </div>
</div>