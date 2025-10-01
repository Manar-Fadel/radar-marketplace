<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_dealer">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Add New Seller
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <form class="card-body flex flex-col gap-5 p-10" method="post" action="{{ route("admin.dealers.store") }}">
                @csrf
                <input type="hidden" name="type" id="name" value="DEALER">

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Full Name
                        </label>
                        <input type="text" class="input" name="user_name" id="user_name" placeholder="Enter user name ">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Mobile
                        </label>
                        <input type="text" class="input" name="mobile" id="mobile" placeholder="Enter mobile eg. 966591111111">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Email
                        </label>
                        <input type="text" class="input" name="email" id="email" placeholder="Enter email">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Workshop Name
                        </label>
                        <input type="text" class="input" name="work_shop_name" id="work_shop_name" placeholder="Enter workshop name">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Workshop Number
                        </label>
                        <input type="text" class="input" name="work_shop_number" id="work_shop_number" placeholder="Enter workshop number">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
