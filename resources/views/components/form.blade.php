<form {!! html_attr($attr + ['method' => 'POST']) !!}>
    @foreach($fields as $field_id => $field)
        @if($field['type'] == 'hidden')
            <input {!! input_attr($field, $field_id) !!}>
        @else
            <div {!! html_attr(($field['extras']['attr'] ?? [])) !!}>
                <label class="col-form-label">
                    <span>{{$field['label']}}</span>
                </label>
                <div>
                    @if(in_array($field['type'], ['text', 'password', 'email', 'number', 'file']))
                        <input {!! input_attr($field, $field_id) !!}>
                    @elseif (in_array($field['type'], ['textarea']))
                        <textarea {!! textarea_attr($field, $field_id)!!}>{!! $field['value'] ?? '' !!}</textarea>
                    @elseif (in_array($field['type'], ['color']))
                        <input {!! color_attr($field, $field_id) !!} >
                    @elseif (in_array($field['type'], ['select']))
                        <select {!! select_attr($field, $field_id) !!}>
                            @if (isset($field['placeholder']))
                                <option disabled selected>{!! $field['placeholder'] !!}</option>
                            @endif
                            @foreach ($field['options'] ?? [] as $index => $option)
                                <option {!! option_attr($field, $index) !!}>{{$option}}</option>
                            @endforeach
                        </select>
                    @elseif (in_array($field['type'], ['radio']))
                        @foreach ($field['options'] as $index => $option)
                            <input {!! radio_attr($field, $index, $field_id) !!}>{{$option}}
                        @endforeach
                    @endif
                </div>
                @if ($errors->has($field_id))
                    <div class="alert alert-danger"><span>{{ $errors->first($field_id) }}</span></div>
                @endif
            </div>
        @endif
    @endforeach
    @foreach($buttons ?? [] as $button_index => $button)
        <button {!! button_attr($button, $button_index) !!}>
            {{$button['title']}}
        </button>
    @endforeach
    @csrf
</form>
