@extends('layout.layout')

@section('content')

<section class="wrapper style2"
id="three">
<div class="inner">
<div>
<div class="content">

<div class="row">

    <form method="POST" action="{{ route('poem-updater', ['id' => $poem->id]) }}">
      @method('PUT')
        @csrf
        <div class="field">
            <label class="label">title</label>
            <div class="control">
            <input class="input" name="title" type="text" placeholder="title" value="{{$poem->title}}">
            </div>
          </div>

          <div class="field">
            <label class="label">poem</label>
            <div class="control">
            <textarea name="poem" class="textarea is-large" placeholder="poem text, use spaces to indent" rows="10">{{$poem->poem}}</textarea>
            </div>
          </div>

          <div class="field">
                <label class="label">meaning</label>
                <div class="control">
                  <textarea name="meaning" class="textarea is-large" placeholder="poem meaning" rows="2">{{$poem->meaning}}</textarea>
                </div>
              </div>
        <p>Publish this poem?</p>
          <div class="field">

            <div class="control">
              <label class="radio">
                <input type="radio" value="1" name="published" checked>Yes
              </label>
              <label class="radio">
                <input type="radio" value="0" name="published">No
              </label>
            </div>
          </div>
          <div class="field">
                <label class="label">price to license this poem</label>
                <div class="control">
                <input class="input" name="price" type="number" placeholder="$0.00" value="{{$poem->price}}">
                </div>
              </div>

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link">Update</button>
            </div>
            <div class="control">
            <a href="{{route('mine')}}" class="button is-text">Cancel</a>
            </div>
          </div>
    </form>


</div>
</div>
</div>
</div>
</section>

@endsection
