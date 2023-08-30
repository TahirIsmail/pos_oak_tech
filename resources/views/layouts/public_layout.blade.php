<!doctype html>
<!--
Author: OAK
Product Name: OAK POS 
Product Version: 6.0
Purchase: https://codecanyon.net/item/OAK-pos-multiple-store-point-of-sale-billing-and-inventory-management-application/25742626
Website: https://www.OAK.com
Contact: OAK@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the application.
-->
<html lang="en">
    @include('layouts.header')
    <div id="app">
        <body>
            <div class="wrapper">
                <div class="content">
                    @yield('content')
                </div>
            </div>     
        </body>
    </div>
    @include('layouts.scripts')
    @stack('scripts')
</html>