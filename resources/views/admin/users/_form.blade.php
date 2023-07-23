<div class="row">
    <div class="col-12">
        <x-form.input label="User name" id="name" name="name" value="{{ $user->name }}" />
    </div>
    <div class="col-12">
        <x-form.input type="email" label="User email" id="email" name="email" value="{{ $user->email }}" />
    </div>
    <div class="col-12">
        <x-form.input type="password" label="password" id="password" name="password" />
    </div>
    <div class="col-12">
        <x-form.input type="password" label="password" id="password" name="password_confirmation" />
    </div>
    {{-- <div class="col-12">
        <x-form.input type="password" label="password_confirmation" id="password_confirmation" name="password_confirmation"  />
    </div> --}}

</div>
<button type="submit" class="btn btn-primary">{{ $submit_label ?? 'save' }}</button>
