<!-- Sidebar -->
<div
    class="sidebar dark:bg-coal-600 bg-light border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0"
    data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false"
    id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0"
         id="sidebar_header">
        <a class="dark:hidden" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ URL::asset("assets/logo.svg") }}"
                 style="width: 70px;"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ URL::asset("assets/logo.svg") }}"/>
        </a>
        <a class="hidden dark:block" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ URL::asset("assets/logo.svg") }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ URL::asset("assets/logo.svg") }}"/>
        </a>
        <button
            class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4"
            data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300">
            </i>
        </button>
    </div>
    <div class="sidebar-content flex grow shrink-0 pt-2 lg:pt-0 pe-2" id="sidebar_content">
        <div class="scrollable-y-hover grow shrink-0 flex ps-2 lg:ps-5 pr-1 lg:pe-3" data-scrollable="true"
             data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px"
             data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <!-- Sidebar Menu -->
            <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false"
                 id="sidebar_menu">
                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <a class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                        tabindex="0" href="{{ route("admin.dashboard") }}">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-element-11 text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                          Dashboards
                        </span>
                    </a>
                </div>

                <?php $user = auth()->user(); ?>

                @if($user->type == "ADMIN")
                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <a class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       tabindex="0" href="{{ route("admin.advertisements.index") }}">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-slider text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                          Advertisements
                        </span>
                    </a>
                </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                      <i class="ki-filled ki-chart-line-down text-lg">
                      </i>
                     </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                        Statistics (Insights)
                    </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                      <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                      </i>
                      <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                      </i>
                    </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.statistics.number-insights") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Numeric Count Insights
                               </span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.statistics.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Orders & Offers Charts
                               </span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.statistics.users") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Customers & Sellers Charts
                               </span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.statistics.cities") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Cities Orders & Sellers Charts
                               </span>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-car text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Countries & Cities
                        </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                        </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.countries.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Countries & Cities
                               </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-car text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Car Data
                        </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                        </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.brands.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Brands & Models
                               </span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.parts.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Car Parts
                               </span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.years.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Years
                               </span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.colors.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Colors
                               </span>
                            </a>
                        </div>
                    </div>

                </div>
                @endif

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-users text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Users
                        </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                        </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.customers.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Customers
                               </span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.sellers.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Service Providers
                               </span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.referral.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Referred Accounts
                               </span>
                            </a>
                        </div>

                        @if($user->type == "ADMIN")
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.admins.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Tashleeh Admins
                               </span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-data text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Orders
                        </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                        </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.orders.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Parts Orders by Date
                               </span>
                            </a>

                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.offers.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Parts Offers by Date
                               </span>
                            </a>

                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.offers.requested") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Parts Offers Need Attachment
                               </span>
                            </a>

                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.vehicle-orders.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Sell Vehicles Orders by Date
                               </span>
                            </a>

                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.vehicle-offers.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                    Sell Vehicles Offers by Date
                               </span>
                            </a>

                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.addresses.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Customer Addresses
                               </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-save-deposit text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Payments & Wallet
                        </span>
                        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                        </span>
                    </div>
                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.payments.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Payments (Tap Gateway)
                               </span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                        <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                               href="{{ route("admin.wallet.index") }}" tabindex="0">
                               <span
                                   class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                                <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Users Wallets
                               </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.coupons.index") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-discount text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                            Discount Codes (Coupons)
                        </span>
                    </a>
                </div>

                <div class="menu-item pt-2.25 pb-px">
                    <span class="menu-heading uppercase text-2sm font-medium text-gray-500 pl-[10px] pr-[10px]">
                      Seller Garage
                    </span>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.garage-parts.index") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-car text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                          Seller Garage Parts
                         </span>
                    </a>
                </div>

                <div class="menu-item pt-2.25 pb-px">
                    <span class="menu-heading uppercase text-2sm font-medium text-gray-500 pl-[10px] pr-[10px]">
                      Customer Care Notes
                    </span>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.customer-care-notes.index") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-notepad text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                           Customer Care Notes
                         </span>
                    </a>
                </div>

                @if($user->type == "ADMIN")
                <div class="menu-item pt-2.25 pb-px">
                    <span class="menu-heading uppercase text-2sm font-medium text-gray-500 pl-[10px] pr-[10px]">
                     Notifications & SMS
                    </span>
                </div>
                    <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                        <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                      <i class="ki-filled ki-notification text-lg">
                      </i>
                     </span>
                            <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
                        System Notifications
                    </span>
                            <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                      <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                      </i>
                      <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                      </i>
                    </span>
                        </div>
                        <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                            <div class="menu-item">
                                <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                                   href="{{ route("admin.notifications.index") }}" tabindex="0">
                                    <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                                    </span>
                                    <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                        All Sent Notifications Logs
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                            <div class="menu-item">
                                <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                                   href="{{ route("admin.notifications.scheduled") }}" tabindex="0">
                                    <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                                    </span>
                                    <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                        Admin Scheduled Notifications
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                            <div class="menu-item">
                                <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                                   href="{{ route("admin.fcm.index") }}" tabindex="0">
                                   <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                                   </span>
                                    <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                        FCM Users Tokens
                                   </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.sms.verifications") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-sms text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                          Verifications SMS
                         </span>
                    </a>
                </div>

                <div class="menu-item pt-2.25 pb-px">
                    <span class="menu-heading uppercase text-2sm font-medium text-gray-500 pl-[10px] pr-[10px]">
                     Logs
                    </span>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.logs.index") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-setting-2 text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                          System Logs
                         </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.omnix-logs.index") }}"
                       tabindex="0">
                     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                      <i class="ki-filled ki-call text-lg">
                      </i>
                     </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                      Omnix Logs
                     </span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.omnix-templates.index") }}"
                       tabindex="0">
                 <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                  <i class="ki-filled ki-call text-lg">
                  </i>
                 </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                  Omnix WhatsApp Templates
                 </span>
                    </a>
                </div>

                <div class="menu-item pt-2.25 pb-px">
                    <span class="menu-heading uppercase text-2sm font-medium text-gray-500 pl-[10px] pr-[10px]">
                     Settings
                    </span>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.need-status.index") }}"
                       tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-price-tag text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                          Need Status Types
                         </span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.sellers.points.index") }}"
                       tabindex="0">
                     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                      <i class="ki-filled ki-pointers text-lg">
                      </i>
                     </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                            Points Types
                        </span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                         href="{{ route("admin.settings.index") }}"
                         tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-setting text-lg">
                          </i>
                         </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                          System Dynamics
                         </span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-label border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
                       href="{{ route("admin.jobs.index") }}"
                       tabindex="0">
                     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                      <i class="ki-filled ki-setting text-lg">
                      </i>
                     </span>
                        <span class="menu-title text-sm font-medium text-gray-800">
                            Queued Jobs
                     </span>
                    </a>
                </div>
                @endif

            </div>
            <!-- End of Sidebar Menu -->
        </div>
    </div>
</div>
<!-- End of Sidebar -->
