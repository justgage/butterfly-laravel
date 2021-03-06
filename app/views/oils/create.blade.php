@extends('layout.main')

@section('head')
<link rel="stylesheet" href="/js/tagsinput/bootstrap-tagsinput.css">
@stop

@section('content')

@include('includes.invalid', $errors)

{{ Form::open(["route" => "oils.store", "files" => true, 'class' => 'form-horizontal'])}}

<?php $col_size = "col-md-6"; ?>

<h1>Create new Product</h1>
<div class="row">
    <div class="{{ $col_size }}">

        {{-- NAME --}}
        <div class="form-group">
            {{ Form::label('name', 'Name', [ 'class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-2">
                {{ Form::text('prefix', Input::old('prefix'), [
                    'placeholder' => 'le',
                    'class' => 'form-control'
                ]) }} 
            </div>
            <div class="col-sm-7">
                {{ Form::text('name', Input::old('name'), [
                    'placeholder' => 'Spice Traders',
                    'class' => 'form-control'
                ]) }} 
            </div>
        </div>

        {{-- Sci Name --}}
        <div class="form-group">
            {{ Form::label('sciName', 'Scientific Name', [ 'class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-9">
                {{ Form::text('sciName', Input::old('sciName'), [
                    'placeholder' => 'Pimenta dioica',
                    'class' => 'form-control'
                ]) }} 
            </div>
        </div>
    
        {{-- Type --}}
        <div class="form-group">
            {{ Form::label('type', 'Type', [ 'class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-9">
                {{ Form::text('type', Input::old('type'), [
                    'placeholder' => '10ml',
                    'class' => 'form-control'
                ]) }} 
            </div>
        </div>
    
       {{-- PRICE --}}
        <div class="form-group">
          {{ Form::label('price', 'price', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-9">
              <div class="input-group">
                  <span class="input-group-addon">$</span>
                  {{ Form::text('price', Input::old('price') , [
                      'placeholder' => '10.00',
                      'class' => 'form-control'
                  ]) }} 
                </div>
            </div>
        </div>
       
        {{-- TAGS --}}
        <div class="form-group">
          {{ Form::label('tags', 'Uses tags', ['class' => 'col-sm-3 control-label']) }}
           <div class="input-group col-sm-9">
               {{ Form::text('tags', Input::old('tags') , [
                   'class' => 'form-control',
                   'data-role' => 'tagsinput',
                   'placeholder' => '',
                   'id' => 'tags_input'
               ]) }} 
            <em>push enter to add a tag</em>
           </div>
        </div>
    
 </div>

   <div class="{{ $col_size }}">
       {{-- INFO --}}
          {{ Form::label('info', 'Oil Info') }}
          <p> {{ Form::textarea('info', Input::old('info'), [
              'placeholder' => 'This is what the oil is (basic description, ingredints, etc..)',
              'class' => 'form-control',
              'rows' => 10
          ]) }} </p>

       {{-- CAT DROP DOWN  --}}
        <h3> 
            {{ Form::label('cat_id', 'Category') }} 
            {{ Form::select('cat_id', $cats, null, [
                'id' => 'cat_select',
                'class' => 'form-control'
            ]) }} 
        </h3>
       
       {{-- IMAGE UPLOAD --}}
       {{ Form::label('image', 'Product_Images') }}
          <button type="button" class='upload_button btn btn-default pull-right'>Add more a photos</button>
          <p class="upload_input"> {{ Form::file('image[]') }} </p>
       
    {{-- VISIBLE --}}
       <h4>
          Show in shop {{ Form::checkbox('visible', 'visible', ['checked' => Input::old('visible')] ) }} 
       </h4>
    {{-- SUBMIT --}}
       {{ Form::submit('Save', [
           'class' => 'btn-lg btn-primary pull-right' 
       ]) }}
   </div>

</div>
{{ Form::close() }}
@stop

@section('script')
<script type="text/javascript" src="/js/tagsinput/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="/js/typeaheadjs/typeahead.js"></script>
<script type="text/javascript" charset="utf-8">
$( document ).ready(function () {

    // add another form for adding pictures
    $('.upload_button').click(function (e){
         console.log('click');
         e.preventDefault();
         var copy = $('.upload_input').first().clone();
         $(copy).insertBefore(this);
     });

    // Adding custom typeahead support using http://twitter.github.io/typeahead.js
    $('#tags_input').tagsinput('input').typeahead({                                
          name: 'uses',                                                          
          prefetch: "{{ URL::route('tags.ajax')}}"
      }).bind('typeahead:selected', $.proxy(function (obj, datum) {  
            this.tagsinput('add', datum.value);
            var $input = this.tagsinput('input')
            $input.typeahead('setQuery', '');

          }, $('#tags_input')));;

});
</script>
@stop
