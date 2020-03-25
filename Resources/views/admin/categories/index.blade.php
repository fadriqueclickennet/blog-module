@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('blog::category.title.category') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard.index') }}"><i
                            class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('blog::category.title.category') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@stop

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="btn-group float-right" style="margin: 0 15px 15px 0;">
                <a href="{{ route('admin.blog.category.create') }}" class="btn btn-primary" style="padding: 4px 10px;">
                    <i class="fas fa-plus mr-1"></i> {{ trans('blog::category.button.create category') }}
                </a>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('blog::category.table.name') }}</th>
                            <th>{{ trans('blog::category.table.slug') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.blog.category.edit', [$category->id]) }}">
                                        {{ $category->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.category.edit', [$category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.category.edit', [$category->id]) }}">
                                        {{ $category->slug }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.category.edit', [$category->id]) }}">
                                        {{ $category->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.blog.category.edit', [$category->id]) }}" class="btn btn-default"><i class="far fa-edit"></i></a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.blog.category.destroy', [$category->id]) }}"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('blog::category.table.name') }}</th>
                            <th>{{ trans('blog::category.table.slug') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>
            <!-- /.card-body -->
            </div>
        <!-- /.card -->
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
        <dd>{{ trans('blog::category.title.create category') }}</dd>
    </dl>
@stop

@section('scripts')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'c', route: "<?= route('admin.blog.category.create') ?>" }
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
