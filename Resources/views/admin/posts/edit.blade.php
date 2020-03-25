@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                {{ trans('blog::post.title.edit post') }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blog.post.index') }}">{{ trans('blog::post.title.post') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('blog::post.title.edit post') }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
{!! Form::open(['route' => ['admin.blog.post.update', $post->id], 'method' => 'put']) !!}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
                    <div class="nav-tabs-custom">
                        @include('partials.form-tab-headers', ['fields' => ['title', 'slug']])
                        <div class="card card-primary tab-content">
                            <?php $i = 0; ?>
                            <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                                <?php $i++; ?>
                                <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                    @include('blog::admin.posts.partials.edit-fields', ['lang' => $locale])
                                </div>
                            <?php endforeach; ?>
                            <?php if (config('asgard.blog.config.post.partials.normal.edit') !== []): ?>
                                <?php foreach (config('asgard.blog.config.post.partials.normal.edit') as $partial): ?>
                                    @include($partial)
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ trans('core::core.button.update') }}</button>
                                <a class="btn btn-danger float-right" href="{{ route('admin.blog.post.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="card card-primary" style="margin-top: 42px;">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label("category", 'Categoría:') !!}
                        <select name="category_id" id="category" class="form-control">
                            <?php foreach ($categories as $category): ?>
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label("status", 'Estado:') !!}
                        <select name="status" id="status" class="form-control">
                            <?php foreach ($statuses as $id => $status): ?>
                            <option value="{{ $id }}" {{ old('status', $post->status) == $id ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group" id="fecha_publicacion">
                        {!! Form::label("fecha_publicacion", 'Fecha de publicación:') !!}
                        <input type="datetime-local" name="fecha_publicacion" class="form-control" value="{{str_replace(' ', 'T', $post->fecha_publicacion)}}">
                    </div>
                    @tags('asgardcms/post', $post)
                    @mediaSingle('thumbnail', $post)
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
    <?php date_default_timezone_set('Europe/Madrid');?>
    <?php $ahora = date('Y-m-d H:i:s'); ?>
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index', ['name' => 'posts']) }}</dd>
    </dl>
@stop

@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'b', route: "<?= route('admin.blog.post.index') ?>" }
            ]
        });

        var ahora = '{{$ahora}}';
        var fecha_publicacion = '{{$post->fecha_publicacion}}';

        if(fecha_publicacion <= ahora){
            $('#status').val('2');
        }
        
        if($('#status').val()==4){
            $('#fecha_publicacion').show();
        }else{
            $('#fecha_publicacion').hide();
        }

        

        $('#status').on('change', function() {
            if($('#status').val()==4){
                $('#fecha_publicacion').show();
            }else{
                $('#fecha_publicacion').hide();
            }
        });
    });
</script>
@stop
