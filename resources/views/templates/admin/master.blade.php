@include('templates.admin.header')
    @yield('content')
@include('templates.admin.footer')
    </div>
    {{ Html::script(asset('js/app.js')) }}
    {{ Html::script(asset('js/admin.js'))}}
</body>
</html>
