@extends('layout.layout')

@section('content')


<section class="wrapper style2"
id="three">
<div class="inner">
<div>
<div class="content">

<div class="row">

<form method="POST" action="{{route('poem.store')}}">
        @csrf
        <div class="field form-group col-12">
            <label class="label">title</label>

              <input class="input" name="title" type="text" placeholder="title of poem">
          </div>

          <div class="field form-group">
            <label class="label">poem</label>
              <textarea name="poem" class="textarea is-large" placeholder="poem text, use spaces to indent" rows="10"></textarea>
          </div>

          <div class="field form-group">
                <label class="label">meaning</label>
                  <textarea name="meaning" class="textarea is-large" placeholder="poem meaning" rows="2"></textarea>
              </div>
            <div class="field form-group">
                <label class="label">genre</label>
                <div class="control">
                  <input class="input" name="genre" type="text" placeholder="Separate, genre, with, commas">
                </div>
              </div>
          <div class="field form-group">
                <label class="label">price to license this poem</label>
                <div class="control">
                  <input class="input" name="price" type="number" width="100px" placeholder=" $0.00 ($50+ suggested)">
                </div>
              </div>

          <div class="field is-grouped form-group">
            <div class="control">
              <button class="button is-link">Publish</button>

              <button class="button is-text">Cancel</button>
            </div>
          </div>
    </form>
</div>


</div>
</div>
</div>
</div>
</section>

@endsection
