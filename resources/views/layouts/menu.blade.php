
{{--<li class="{{ Request::is('*appSettings*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('appSettings.index') }}"><i class="fa fa-edit"></i><span>@lang('menu.App Settings')</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('*users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('*products*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

<li class="{{ Request::is('*types*') ? 'active' : '' }}">
    <a href="{{ route('types.index') }}"><i class="fa fa-edit"></i><span>Types</span></a>
</li>

{{--<li class="{{ Request::is('productUsers*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('productUsers.index') }}"><i class="fa fa-edit"></i><span>Product Users</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('*baskets*') ? 'active' : '' }}">
    <a href="{{ route('baskets.index') }}"><i class="fa fa-edit"></i><span>Baskets</span></a>
</li>

<li class="{{ Request::is('*addresses*') ? 'active' : '' }}">
    <a href="{{ route('addresses.index') }}"><i class="fa fa-edit"></i><span>Addresses</span></a>
</li>

<li class="{{ Request::is('*orders*') ? 'active' : '' }}">
    <a href="{{ route('orders.index') }}"><i class="fa fa-edit"></i><span>Orders</span></a>
</li>

<li class="{{ Request::is('*productOrders*') ? 'active' : '' }}">
    <a href="{{ route('productOrders.index') }}"><i class="fa fa-edit"></i><span>Product Orders</span></a>
</li>

<li class="{{ Request::is('*categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

{{--<li class="{{ Request::is('categoryProducts*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('categoryProducts.index') }}"><i class="fa fa-edit"></i><span>Category Products</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('*sliders*') ? 'active' : '' }}">
    <a href="{{ route('sliders.index') }}"><i class="fa fa-edit"></i><span>Sliders</span></a>
</li>

<li class="{{ Request::is('*settings*') ? 'active' : '' }}">
    <a href="{{ route('settings.index') }}"><i class="fa fa-edit"></i><span>Settings</span></a>
</li>
{{--<li class="{{ Request::is('homePages*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('homePages.index') }}"><i class="fa fa-edit"></i><span>Home Pages</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('messages*') ? 'active' : '' }}">
    <a href="{{ route('messages.index') }}"><i class="fa fa-edit"></i><span>Messages</span></a>
</li>

