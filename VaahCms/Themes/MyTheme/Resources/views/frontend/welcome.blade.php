@extends("mytheme::frontend.layouts.default")

@section('vaahcms_extend_frontend_head')

@endsection

@section('vaahcms_extend_frontend_css')

@endsection

@section('vaahcms_extend_frontend_scripts')

@endsection

@section('content')
<div class="container has-text-centered mt-6">

        <div class="notification is-link is-light">
            This page should contain welcome message which does not require any database to run.
            You can write theme setup information.
        </div>

        <section class="hero">
            <div class="hero-body">
                <p class="title">MyTheme</p>

                <p class="subtitle">Welcome Page.</p>
                {!! config('settings.global.copyright_text_custom'); !!}
                {{--{!! config('settings.global.copyright_text'); !!}--}}
                {!! config('settings.global.site_title'); !!}
                {!! config('settings.global.copyright_link'); !!}


            </div>
        </section>

</div>
@endsection
