<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_offer{{$order->id}}">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Add New Seller
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <form class="card-body flex flex-col gap-5 p-10" method="post"
                  action="{{ route('sell-cars.send-offer', ['id' => $order->id]) }}">
            @csrf

            <div class="flex flex-col gap-5">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        {{ __('web.Price') }} ({{ __('web.SAR') }})
                    </label>
                    <input type="number" class="input" name="price" id="price" />
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Description
                    </label>
                    <input type="text" class="input" name="description" id="description"
                           placeholder="{{ __('web.Car price Offer description') }}">
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <button type="submit" class="btn btn-success">
                        {{ __('web.Send') }}
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
