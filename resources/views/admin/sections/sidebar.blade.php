<!--sidebar start-->

<aside>

    <div id="sidebar" class="nav-collapse">

        <!-- sidebar menu start-->

        <div class="leftside-navigation">

            <ul class="sidebar-menu" id="nav-accordion">

                <li>
                    <a href="{{ url('admin/dashboard') }}" {{ setActive(['admin/dashboard']) }}>
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{--<li>
                    <a href="{{ url('admin/send-message-to-drivers') }}" {{ setActive(['admin/send-message-to-drivers']) }}>
                        <i class="fa fa-envelope"></i>
                        <span>Send Message to Drivers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/send-message-to-riders') }}" {{ setActive(['admin/send-message-to-riders']) }}>
                        <i class="fa fa-envelope"></i>
                        <span>Send Message to Riders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/rides') }}" {{ setActive(['admin/rides']) }}>
                        <i class="fa fa-car"></i>
                        <span>Rides</span>
                    </a>
                </li>                
                <li>
                    <a href="{{ url('admin/schedule-rides') }}" {{ setActive(['admin/schedule-rides']) }}>
                        <i class="fa fa-car"></i>
                        <span>Schedule Rides</span>
                    </a>
                </li>--}}
                <li>
                    <a href="{{ url('admin/ride-requests') }}" {{ setActive(['admin/ride-requests']) }}>
                        <i class="fa fa-car"></i>
                        <span>Ride Requests</span>
                    </a>
                </li>
                {{--<li>
                    <a href="{{ url('admin/drivers') }}" {{ setActive(['admin/drivers','admin/driver-car']) }}>
                        <i class="fa fa-users"></i>
                        <span>Drivers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/riders') }}" {{ setActive(['admin/riders']) }}>
                        <i class="fa fa-users"></i>
                        <span>Riders</span>
                    </a>
                </li>--}}
                <li>
                    <a href="{{ url('admin/makes') }}" {{ setActive(['admin/makes']) }}>
                        <i class="fa fa-car"></i>
                        <span>Makes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/models') }}" {{ setActive(['admin/models']) }}>
                        <i class="fa fa-car"></i>
                        <span>Models</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/categories') }}" {{ setActive(['admin/categories','admin/category-models']) }}>
                        <i class="fa fa-list"></i>
                        <span>Categories</span>
                    </a>
                </li>
                {{--<li>
                    <a href="{{ url('admin/cancelation-reasons') }}" {{ setActive(['admin/cancelation-reasons']) }}>
                        <i class="fa fa-th-list"></i>
                        <span>Cancelation Reasons</span>
                    </a>
                </li>--}}
                <li>
                    <a href="{{ url('admin/calculator') }}" {{ setActive(['admin/calculator']) }}>
                        <i class="fa fa-calculator"></i>
                        <span>Calculator</span>
                    </a>
                </li>
                {{--<li>
                    <a href="{{ url('real-map') }}" target="_blank">
                        <i class="fa fa-map-marker"></i>
                        <span>Real Map</span>
                    </a>
                </li>

                <li>

                    <a href="{{ url('admin/sliders') }}" {{ setActive(['admin/sliders']) }}>
                        <i class="fa fa-picture-o"></i>
                        <span>Sliders</span>
                    </a>
                </li>--}}
<!--
                <li>

                    <a href="{{ url('jobs') }}" {{ setActive(['jobs']) }}>

                        <i class="fa fa-shopping-cart"></i>

                        <span>Jobs</span>

                    </a>

                </li>

                <li>

                    <a href="{{ url('job-book-in') }}" {{ setActive(['job-book-in']) }}>

                        <i class="fa fa-file-text"></i>

                        <span>Job Book In</span>

                    </a>

                </li> -->

                <!-- <li>

                    <a  href="{{ url('company/customers') }}" {{ setActive(['company/customers']) }}>

                        <i class="fa fa-users"></i>

                        <span>Customers</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/stores') }}" {{ setActive(['company/stores']) }}>

                        <i class="fa fa-home"></i>

                        <span>Stores</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/categories') }}" {{ setActive(['company/categories']) }}>

                        <i class="fa fa-sitemap"></i>

                        <span>Categories</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/products') }}" {{ setActive(['company/products','company/product-stocks']) }}>

                        <i class="fa fa-shopping-cart"></i>

                        <span>Products</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/sales') }}" {{ setActive(['company/sales','company/invoice']) }}>

                        <i class="fa fa-file-text"></i>

                        <span>Sales</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/manage-stocks') }}" {{ setActive(['company/manage-stocks']) }}>

                        <i class="fa fa-filter"></i>

                        <span>Manage Stocks</span>

                    </a>

                </li>

                <li>

                    <a  href="{{ url('company/suppliers') }}" {{ setActive(['company/suppliers']) }}>

                        <i class="fa fa-users"></i>

                        <span>Suppliers</span>

                    </a>

                </li> -->

                <li>

                    <a  href="{{ url('admin/settings') }}" {{ setActive(['admin/settings']) }}>

                        <i class="fa fa-cogs"></i>

                        <span>Settings</span>

                    </a>

                </li>

                <!-- <li class="sub-menu">

                    <a href="javascript:void(0);" {{ setActive(['company/reports']) }}>

                        <i class="fa fa-area-chart"></i>

                        <span>Reports</span>

                    </a>

                    <ul class="sub">

                        <li {{ setActive(['company/reports/retail-report']) }}><a href="{{ url('company/reports/retail-report') }}">Retail Dashboard</a></li>                        

                        <li {{ setActive(['company/reports/stores-stock']) }}><a href="{{ url('company/reports/stores-stock') }}">Stocks Report</a></li>                        

                        <li {{ setActive(['company/reports/sales-report']) }}><a href="{{ url('company/reports/sales-report') }}">Sales Report</a></li>                        

                        <li {{ setActive(['company/reports/products-report']) }}><a href="{{ url('company/reports/products-report') }}">Products Report</a></li>                        

                        <li {{ setActive(['company/reports/customers-report']) }}><a href="{{ url('company/reports/customers-report') }}">Customers Report</a></li>                        

                        <li {{ setActive(['company/reports/staff-report']) }}><a href="{{ url('company/reports/staff-report') }}">Staff Report</a></li>                        

                    </ul>

                </li> --> 

<!--                <li class="sub-menu">

                    <a href="javascript:void(0);" {{ setActive(['company/roles','company/permissions']) }}>

                        <i class="fa fa-key"></i>

                        <span>Roles & Permissions</span>

                    </a>

                    <ul class="sub">

                        <li {{ setActive(['company/roles']) }}><a href="{{ url('company/roles') }}">Roles</a></li>

                        <li {{ setActive(['company/permissions']) }}><a href="{{ url('company/permissions') }}">Permissions</a></li>

                    </ul>

                </li>                -->

                <!-- <li class="sub-menu">

                    <a href="javascript:void(0);" {{ setActive(['company/settings','company/customer-groups','company/currencies','company/tax-rates','company/shipping-options','company/variants','company/roles','company/permissions']) }}>

                        <i class="fa fa-cogs"></i>

                        <span>Settings</span>

                    </a>

                    <ul class="sub">

                        <li {{ setActive(['company/settings']) }}><a href="{{ url('company/settings') }}">System Settings</a></li>

                        <li {{ setActive(['company/customer-groups']) }}><a href="{{ url('company/customer-groups') }}">Customer Groups</a></li>

                        <li {{ setActive(['company/currencies']) }}><a href="{{ url('company/currencies') }}">Currencies</a></li>

                        <li {{ setActive(['company/tax-rates']) }}><a href="{{ url('company/tax-rates') }}">Tax Rates</a></li>

                        <li {{ setActive(['company/shipping-options']) }}><a href="{{ url('company/shipping-options') }}">Shipping Options</a></li>

                        <li {{ setActive(['company/variants']) }}><a href="{{ url('company/variants') }}">Attributes</a></li>

                        <li {{ setActive(['company/roles']) }}><a href="{{ url('company/roles') }}">Roles</a></li>

                        <li {{ setActive(['company/permissions']) }}><a href="{{ url('company/permissions') }}">Permissions</a></li>                        

                      <li {{ setActive(['company/modifiers']) }}><a href="{{ url('company/modifiers') }}">Modifiers</a></li>

                    </ul>

                </li> -->                

            </ul>

        </div>

        <!-- sidebar menu end-->

    </div>

</aside>

<!--sidebar end-->

