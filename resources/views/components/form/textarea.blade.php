{{--@props([--}}
{{--'type'=>'text','name','value'=>'','label'--}}
{{--])--}}

<label for="">{{$label}}</label>

<textarea name="{{$name}}"
          @class(['form-control','is-invalid'=>$errors->has($name)])>{{old($name,$value)}}</textarea>
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
