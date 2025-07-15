  @props(
    [
        "name" => "",
        "label" => "",
        "type" => "file",
        "required" => "false",
         "value"    => ""
    ]
  )

<div>
    <label class="label" for="{{ $name }}"> {{ $label }} </label>
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        class="input w-full text-black {{ $type === "file" ? "file-input":"" }}" 
        name="{{ $name }}" 
        value="{{ $value }}"
    />
</div>