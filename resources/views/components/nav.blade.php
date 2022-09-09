{{--@foreach($items as $item)--}}
{{--    <li class="nav-item">--}}
{{--        <a href="{{route($item['route'])}}" class="nav-link {{$item['route']==$active?'active':''}}">--}}
{{--            <i class="{{$item['icon']}}"></i>--}}
{{--            <p>--}}
{{--                {{$item['title']}}--}}
{{--                @if(isset($item['badge']))--}}
{{--                    <span class="right badge badge-danger">{{$item['badge']}}</span>--}}
{{--                @endif--}}
{{--            </p>--}}
{{--        </a>--}}
{{--    </li>--}}

{{--@endforeach--}}
<li class="nav-item menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            {{$name}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        @for($i=0;$i<count($items);$i++)
            @foreach($items[array_keys($items)[$i]] as $value)
{{--                @if((array_keys($items)[$i])=='Categories')--}}
                    <li class="nav-item">
                        <a href="{{route($value['route'])}}"
                           class="nav-link {{$value['route']==$active?'active':''}}">
                            <i class="{{$value['icon']}}"></i>
                            <p>
                                {{$value['title']}}
                            </p>
                        </a>
                    </li>
{{--                @endif--}}
            @endforeach
        @endfor

    </ul>
</li>
