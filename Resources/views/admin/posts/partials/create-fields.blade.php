<div class="card-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<div class="invalid-feedback">:message</div>') !!}
    </div>

    @editor('summary', trans('blog::post.form.summary'), old("{$lang}.summary"), $lang)

    @editor('content', trans('blog::post.form.content'), old("{$lang}.content"), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
