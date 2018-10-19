<section>
    @isset($namespaces)
        <div style="float:left">
            <ul>
                @foreach($namespaces as $namespace)
                    <li>
                        <a href="/{{config('artisan-gui.route-prefix')}}/{{$namespace->id}}">{{ $namespace->id }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endisset

    @isset($commands)
        <div style="float:left">
            <ul>
                @foreach($commands as $command)
                    <li>
                        <a href="{{$id}}/{{ array_last(explode(':', $command->name)) }}">
                            {{ array_last(explode(':', $command->name)) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endisset

    @isset($detail)
        <div style="float:left">
            <span>{{ $detail->description }}</span>

            <form action="/{{config('artisan-gui.route-prefix')}}/call" method="post">
                <input type="hidden" name="command_name" value="{{ $detail->name }}">
            @foreach($detail->definition->arguments as $key => $value)
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">{{ $key }}</label>
                    <div class="col-md-10">
                        <input class="form-control" name="{{ $value->name }}" type="text" value="" minlength="1" maxlength="255" placeholder="" {{ $value->is_required?'required':'' }}>
                        <span>{{ $value->description }}</span>
                    </div>
                </div>
            @endforeach

            @foreach($detail->definition->options as $key => $value)
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">{{ $key }}</label>
                    <div class="col-md-10">
                    @if($value->accept_value)
                        <input class="form-control" name="{{ $value->name }}" type="text" value="" minlength="1" maxlength="255" placeholder="" {{ $value->is_value_required?'required':'' }}>
                        <span>{{ $value->description }}</span>
                    @else
                    <input class="form-control" name="{{ $value->name }}" type="checkbox" value="true" placeholder="" {{ $value->is_value_required?'required':'' }}>
                    <span>{{ $value->description }}</span>
                    @endif
                    </div>
                </div>
            @endforeach

                <input type="submit">
            </form>

            {{ dd($detail) }}

        </div>
    @endisset

</section>
