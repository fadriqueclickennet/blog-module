@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> {{ trans('blog::category.title.edit category') }} <small>{{ $category->name }}</small></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>
                        {{ trans('core::core.breadcrumb.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.category.index') }}">{{ trans('blog::category.title.category') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('blog::category.title.edit category') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@stop

@section('content')
{!! Form::open(['route' => ['admin.blog.category.update', $category->id], 'method' => 'put']) !!}
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="nav-tabs-custom">
            @include('partials.form-tab-headers')
            <div class="card card-primary tab-content">
                <?php $i = 0; ?>
                <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                    <?php $i++; ?>
                    <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        @include('blog::admin.categories.partials.edit-fields', ['lang' => $locale])
                    </div>
                <?php endforeach; ?>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('core::core.button.update') }}</button>
                    <a class="btn btn-danger float-right" href="{{ route('admin.blog.category.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>
        </div> {{-- end nav-tabs-custom --}}
    </div>
</div>
</div>

{!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index', ['name' => 'categories']) }}</dd>
    </dl>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.blog.category.index') ?>" }
                ]
            });
        });
    </script>
@stop
