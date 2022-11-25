<!DOCTYPE html>
<html lang="en">

<x-general.head :title='$title'/>

<body>
    <div class="container p-5">
        <div class="row">
            <x-products.sidebar />
            @yield('content')
        </div>
    </div>

</body>
</html>