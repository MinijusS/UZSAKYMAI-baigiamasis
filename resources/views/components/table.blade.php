<table class="table table-striped">
    <thead class="thead-dark">
    @foreach($thead as $th)
        <th>{!! $th !!}</th>
    @endforeach
    </thead>
    <tbody>
    @foreach($tbody as $tr)
        <tr>
            @foreach($tr as $td)
                @if(!is_array($td))
                    <td>{!! $td !!}</td>
                @else
                    @foreach($td as $button)
                        <td>
                            @if(!isset($button['method']))
                                <a href="{!! $button['href'] !!}"
                                   class="btn {!!$button['class']!!}">{!!$button['name']!!}</a>
                            @else
                                <form method="post" action="{!! $button['href']!!}">
                                    <input type="hidden" name="_method" value="{{$button['method']}}">
                                    <button class="btn {{$button['class']}}">{!!$button['name']!!}</button>
                                    @csrf
                                </form>
                            @endif
                        </td>
                    @endforeach
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
