<div v-if="part != null" class="modal" role="dialog" data-modal="true" aria-modal="true"
     :id="part.view_model_id" :data-id="part.view_model_id">
    <div class="modal-content pt-7.5 my-[3%] w-full container-fixed px-5 overflow-hidden">
        <div class="modal-header p-0 border-0">
            Part Order Details Part ID: @{{ part.id }}/ Req. ID @{{ part.request_id }} /  @{{ part.number }}

            @include("cpanel.includes.vuejs-alerts")

            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body scrollable-y py-0 mb-5 pl-6 pr-3 mr-3">
            <div class="flex grow gap-5 lg:gap-7.5">
                <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">

                    <div class="card pb-2.5" style="max-width: 1150px;">
                        <div class="card-header" id="part_data" :class="{'bg-success-light':part.is_active_last_long}">
                            <h3 class="card-title">
                                <i v-if="part.is_active_last_long == 1" class="ki-filled ki-copy-success" style="color: green;"></i>
                                Part Data
                                <span v-if="part.is_active_last_long == 1">(Active Last Long)</span>
                            </h3>
                        </div>
                        <div class="card-table pb-3">
                            <table class="table align-middle text-sm text-gray-500">
                                <tbody>
                                <tr>
                                    <td class="text-gray-700 text-2sm font-normal min-w-32 ">
                                        Status:
                                        <span v-if="part.status == 'PENDING' || part.status == 'RETURNED' || part.status == 'DECLINED'"
                                              class="badge badge-danger badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-danger me-1.5">
                                                </span>
                                                  @{{ part.status }}
                                           </span>
                                        <span v-else-if="part.status == 'ACCEPTED' || part.status == 'CONFIRMED'" class="badge badge-primary badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-danger me-1.5">
                                                </span>
                                                 @{{ part.status }}
                                           </span>
                                        <span v-else class="badge badge-success badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-danger me-1.5">
                                                </span>
                                                  @{{ part.status }}
                                           </span>
                                    </td>

                                    <td class="w-28 text-gray-600 font-normal">
                                        Vehicle:
                                        <div class="flex items-center gap-2.5">
                                            <img alt="" class="rounded-full size-9 shrink-0" :src="part.brand_image"/>
                                            <div class="flex flex-col">
                                                <a class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" href="#">
                                                    @{{ part.brand_name }} / @{{ part.model_name }} / @{{ part.year_value }}
                                                </a>
                                                <a class="text-2sm text-gray-700 font-normal hover:text-primary-active" type="button">
                                                    @{{ part.part_name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-gray-700 text-2sm font-normal min-w-32">
                                        Vehicle Class:
                                        @{{ part.vehicle_class }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal">
                                        Customer:
                                        @{{ part.user_name }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        Mob. @{{ part.user_mobile }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                            <span class="badge badge-primary badge-outline rounded-[30px]">
                                                 @{{ part.user_type }}
                                           </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal">
                                        Description: @{{ part.description }}
                                    </td>
                                    <td class="text-gray-700">
                                        Need Status: @{{ part.need_status_description }}
                                    </td>
                                    <td class="text-gray-600 font-normal min-w-36">
                                        Part Fees: @{{ part.part_tashleeh_fee }} SAR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal min-w-36">
                                        Request Fees: @{{ part.tashleeh_fee }} SAR
                                    </td>
                                    <td class="text-gray-600 font-normal min-w-36">
                                        Fee Status: @{{ part.is_tashleeh_fee_paid_text }}
                                    </td>
                                    <td class="text-gray-600 font-normal min-w-36">
                                        Coupon Used:
                                        <span class="badge badge-sm badge-outline">
                                           @{{ part.request_discount_code }}
                                        </span>
                                        @{{ part.request_coupon_amount }}

                                        <span v-if="part.wallet_used_amount > 0" class="badge badge-sm badge-primary">
                                            Wallet Used: @{{ part.wallet_used_amount }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal">
                                        Warranty Status
                                        <span v-if="part.warranty_status == 'UNDER_GUARANTEE'" class="badge badge-danger badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-danger me-1.5">
                                                </span>
                                                 @{{ part.warranty_status }}
                                           </span>
                                        <span v-else-if="part.warranty_status == 'DONE'" class="badge badge-success badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-success me-1.5">
                                                </span>
                                                  @{{ part.warranty_status }}
                                           </span>
                                        <span v-else class="badge badge-primary badge-outline rounded-[30px]">
                                                <span class="size-1.5 rounded-full bg-primary me-1.5">
                                                </span>
                                                 @{{ part.warranty_status }}
                                           </span>
                                    </td>
                                    <td class="text-gray-800 font-normal min-w-60">
                                        Review Status: @{{ part.is_reviewed_text }}
                                    </td>
                                    <td class="text-gray-600 font-normal min-w-[280px]">
                                        City : @{{ part.city_name }}
                                    </td>
                                    <td class="text-gray-600 font-normal min-w-[280px]">
                                        Created At: @{{ part.created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <td v-if="part.bill_link" class="text-gray-600 font-normal min-w-36">
                                        <a class="btn btn-primary" target="_blank" :href="part.bill_link">
                                            View Request Bill
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td v-if="part_images.length > 0" v-for="(image, imageIndex) in part_images" class="max-w-16 text-center">
                                        <button type="button" @click="deletePartImage(part, image)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                                            <i class="ki-filled ki-trash-square">
                                            </i>
                                        </button>
                                        <img :src="image.image" alt="part.description">
                                    </td>
                                    <td v-if="voice_note != null" class="text-gray-600 font-normal min-w-36">
                                        <a class="btn btn-primary" target="_blank" :href="voice_note">
                                            Voice Note
                                        </a>
                                        <button type="button" @click="deleteOrderVoice(part)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                                            <i class="ki-filled ki-trash-square">
                                            </i>
                                        </button>
                                    </td>
                                    <td v-if="video_note != null" class="text-gray-600 font-normal min-w-36">
                                        <a class="btn btn-primary" target="_blank" :href="video_note">
                                            Video Note
                                        </a>
                                        <button type="button" @click="deleteOrderVideo(part)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                                            <i class="ki-filled ki-trash-square">
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-if="!isFromViewUser" class="card pb-2.5">
                        <div class="card-header" id="offers_data">
                            <h3 class="card-title">
                                Offers Data
                            </h3>
                        </div>

                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.offer.table")
                                    <div v-if="offersLoading" class="flex flex-col gap-2.5">
                                        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="30px" height="30px" style="margin: 20px auto;">
                                    </div>
                                    <p v-if="offers.length == 0">There is no offers yet</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card pb-2.5" style="min-width: 900px;">
                        <div class="card-header" id="logs_data">
                            <h3 class="card-title">
                                Part Logs (Statuses)
                            </h3>
                        </div>
                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.logs")
                                    <div v-if="logsLoading" class="flex flex-col gap-2.5">
                                        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="30px" height="30px" style="margin: 20px auto;">
                                    </div>
                                    <p v-if="part_logs.length == 0">There is no logs yet</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card pb-2.5" style="min-width: 900px;">
                        <div class="card-header" id="payments_data">
                            <h3 class="card-title">
                                Payment Data
                            </h3>
                        </div>
                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.payment")
                                    <div v-if="paymentsLoading" class="flex flex-col gap-2.5">
                                        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="30px" height="30px" style="margin: 20px auto;">
                                    </div>
                                    <p v-if="payments.length == 0">There is no online payments yet</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="!isFromListingNotes" class="card pb-2.5" style="min-width: 900px;">
                        <div class="card-header" id="payments_data">
                            <h3 class="card-title">
                                Customer Care Notes
                            </h3>
                        </div>
                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.customer-care-notes-table-data")
                                    <div v-if="customerCareNotesLoading" class="flex flex-col gap-2.5">
                                        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="30px" height="30px" style="margin: 20px auto;">
                                    </div>
                                    <p v-if="customer_care_notes.length == 0">There is no customer care notes on this part yet</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

