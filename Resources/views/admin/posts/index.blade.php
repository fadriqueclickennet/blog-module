@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                {{ trans('blog::post.title.post') }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('blog::post.title.post') }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-end">
                <div class="btn-group" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.blog.post.create') }}" class="btn btn-primary" style="padding: 4px 10px;">
                        <i class="fas fa-plus mr-1"></i> {{ trans('blog::post.button.create post') }}
                    </a>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Img</th>
                                <th>{{ trans('blog::post.table.status') }}</th>
                                <th>{{ trans('blog::post.table.title') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                           <img src="{{$post->files()->first()['path']}}" height="40px" width="100px">
                                        </a>
                                    </td>
                                    <?php date_default_timezone_set('Europe/Madrid');?>
                                    <?php $ahora = date('Y-m-d H:i:s'); ?>
                                    @if($post->status==4 && $post->fecha_publicacion <= $ahora)
                                    <td>
                                        <span class="badge badge-success">
                                                Publicado
                                        </span>
                                    </td>
                                    @else 
                                        <td>
                                            <span class="badge {{ $post->present()->statusLabelClass }}">
                                                {{ $post->present()->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                            {{ $post->created_at }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.blog.post.edit', [$post->id]) }}" class="btn btn-default"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger " data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.blog.post.destroy', [$post->id]) }}"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Img</th>
                                <th>{{ trans('blog::post.table.status') }}</th>
                                <th>{{ trans('blog::post.table.title') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                <!-- /.box-body -->
                </div>
            <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('blog::post.title.create post') }}</dd>
    </dl>
@stop

@section('scripts')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'c', route: "<?= route('admin.blog.post.create') ?>" }
            ]
        });
    });
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[ 0, "desc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
    });
</script>
@stop
