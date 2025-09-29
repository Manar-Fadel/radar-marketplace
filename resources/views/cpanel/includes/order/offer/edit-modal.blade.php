<div v-if="editModal != null" class="modal" role="dialog" data-modal="true" aria-modal="true"
     :id="editModal.edit_model_id">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Update Offer

            @include("cpanel.includes.vuejs-alerts")

            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0 close-link" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <div class="card-body flex flex-col gap-5 p-10">
                @csrf
                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            State
                        </label>
                        <select class="select" v-model="editModal.state"
                                :name="editModal.state" :id="editModal.state">
                            <option value=""> -- Choose -- </option>
                            @foreach($state_options as $state_option)
                            <option value="{{ $state_option->name }}">{{ $state_option->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Condition State
                        </label>
                        <select class="select" v-model="editModal.condition_status"
                                :name="editModal.condition_status" :id="editModal.condition_status">
                            <option value=""> -- Choose -- </option>
                            @foreach($condition_options as $condition_option)
                                <option value="{{ $condition_option->name }}">{{ $condition_option->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Condition State
                        </label>
                        <select class="select" v-model="editModal.original_status"
                                :name="editModal.original_status" :id="editModal.original_status">
                            <option value=""> -- Choose -- </option>
                            @foreach($original_statuses as $original_status)
                                <option value="{{ $original_status->name }}">{{ $original_status->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Price
                        </label>
                        <input v-model="editModal.price" :name="editModal.price" :id="editModal.price"
                               placeholder="Offer price" type="number" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Delivery Price
                        </label>
                        <input v-model="editModal.delivery_fees" :name="editModal.delivery_fees" :id="editModal.delivery_fees"
                               placeholder="Offer delivery_fees" type="number" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Kilometres
                        </label>
                        <input v-model="editModal.kilometres" :name="editModal.kilometres" :id="editModal.kilometres"
                               placeholder="Offer kilometres" type="number" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Guarantee Days
                        </label>
                        <input v-model="editModal.guarantee_days" :name="editModal.guarantee_days" :id="editModal.guarantee_days"
                               placeholder="Offer guarantee days" type="number" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Seller Note
                        </label>
                        <input v-model="editModal.note" :name="editModal.note" :id="editModal.note"
                               placeholder="Seller note" type="text" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Super Seller Note
                        </label>
                        <input v-model="editModal.tracking_note" :name="editModal.tracking_note" :id="editModal.tracking_note"
                               placeholder="Super seller note" type="text" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <button @click="storeOffer(editModal, key, index)" class="btn btn-success">
                            update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
