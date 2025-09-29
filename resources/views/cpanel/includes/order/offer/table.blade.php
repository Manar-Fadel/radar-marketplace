<table v-if="offers != null && offers.length > 0" class="table table-auto table-border" data-datatable-table="true">
    <thead>
        <tr>
            <th class="min-w-[20px]">
                 Actions
            </th>
            <th class="min-w-[100px]">
                 #
            </th>
            <th class="min-w-[150px]">
                 Offer Number
            </th>
            <th class="min-w-[150px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Part Number
                </span>
               </span>
            </th>
            <th class="min-w-[300px]">
               <span class="sort asc">
                    <span class="sort-label font-normal text-gray-700">
                     Seller
                    </span>
               </span>
            </th>
            <th class="min-w-[100px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Status
                </span>
               </span>
            </th>
            <th class="min-w-[250px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 State /Condition /original Status
                </span>
               </span>
            </th>
            <th class="min-w-[200px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Price / Delivery / Total
                </span>
               </span>
            </th>
            <th class="min-w-[80px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Kilometres
                </span>
               </span>
            </th>
            <th class="min-w-[150px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Guarantee Days
                </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Description
                </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 New Image Requested
                </span>
               </span>
            </th>
            <th class="min-w-[150px]">
               <span class="sort">
                    <span class="sort-label font-normal text-gray-700">
                     Tracking Note
                    </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Images
                </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Voice Note
                </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Video Note
                </span>
               </span>
            </th>
            <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Created At
                </span>
               </span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(offer, offerIndex) in offers" :key="offerIndex">
            <td class="text-center">
                <div class="menu flex-inline" data-menu="true">
                    <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                        <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                            <i class="ki-filled ki-dots-vertical">
                            </i>
                        </button>
                        <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                            <div class="menu-item">
                                <button class="menu-link"
                                        :data-modal-toggle="offer.edit_model_id_toggle"
                                        @click="editOffer(offer, key, offerIndex)">
                                    <span class="menu-icon">
                                     <i class="ki-filled ki-pencil">
                                     </i>
                                    </span>
                                    <span class="menu-title">
                                     Edit
                                    </span>
                                </button>
                            </div>

                            <div class="menu-separator">
                            </div>
                            <div class="menu-item">
                                <button class="menu-link text-left" :data-modal-toggle="offer.upload_attachments_model_toggle"
                                        @click="uploadOfferAttachment(offer, key, offerIndex)">
                                <span class="menu-icon">
                                     <i class="ki-filled ki-cloud-download">
                                     </i>
                                </span>
                                    <span class="menu-title">
                                 Upload Attachments
                                </span>
                                </button>
                            </div>

                            <div class="menu-separator">
                            </div>
                            <div class="menu-item">
                                <button v-if="offer.offers_table_from == 'FROM_LISTING_OFFERS'" class="menu-link"
                                        @click="deleteOffer(offer, key, offerIndex)">
                                    <span class="menu-icon">
                                     <i class="ki-filled ki-trash">
                                     </i>
                                    </span>
                                    <span class="menu-title">
                                     Delete
                                    </span>
                                </button>

                                <button v-if="offer.offers_table_from == 'FROM_VIEW_PART_OFFERS'" class="menu-link"
                                        @click="deleteOffer(offer, offerIndex)">
                                    <span class="menu-icon">
                                     <i class="ki-filled ki-trash">
                                     </i>
                                    </span>
                                    <span class="menu-title">
                                     Delete
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ (offerIndex + 1) + (offers_per_page * (offers_current_page - 1)) }}
            </td>
            <!--td class="text-gray-800 font-normal">
                @{{ offer.id }}
            </td-->
            <td class="text-gray-800 font-normal">
                <button class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px">
                    @{{ offer.offer_number }}
                </button>
            </td>
            <td class="text-gray-800 font-normal">
                <button class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" style="color: blue"
                        :data-modal-toggle="offer.view_model_id_toggle" @click="viewModal(offer.part)">
                    @{{ offer.part_number }}
                </button>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.seller_name  }} /
                @{{ offer.seller_mobile }}
            </td>
            <td>
                <span v-if="offer.status == 'PENDING' || offer.status == 'RETURNED' || offer.status == 'DECLINED'" class="badge badge-danger badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
                <span v-else-if="offer.status == 'ACCEPTED' || offer.status == 'CONFIRMED'" class="badge badge-primary badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
                <span v-else class="badge badge-success badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.state }} / @{{ offer.condition_status }} / @{{ offer.original_status }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.price }} / @{{ offer.delivery_fees }} / @{{ offer.total_price }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.kilometres }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.guarantee_days }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.note }}
            </td>
            <td class="text-gray-800 font-normal">
                <button v-if="offer.is_new_image_requested" class="btn btn-warning btn-outline">
                    @{{ offer.is_new_image_requested_text }}
                </button>
                <button v-if="!offer.is_new_image_requested" class="btn btn-primary btn-outline">
                    @{{ offer.is_new_image_requested_text }}
                </button>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.tracking_note }}
            </td>
            <td class="flex text-gray-800 font-normal" style="overflow: hidden;">
                <div class="mr-2.5" v-for="image in offer.images" style="width: 100px;max-height: 60px;">
                    <button type="button" @click="deleteOfferImage(image, key, offerIndex)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                        <i class="ki-filled ki-trash-square">
                        </i>
                    </button>
                    <a :href="image.image" target="_blank" style="width: 100px;max-height: 60px;">
                        <img :src="image.image" width="100px">
                    </a>
                </div>
            </td>
            <td class="text-gray-800 font-normal">
                <a v-if="offer.voice_note" class="btn btn-primary" :href="offer.voice_note" target="_blank">
                    Voice Note
                </a>
                <button v-if="offer.voice_note" type="button"
                        @click="deleteOfferVoice(offer, key, offerIndex)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                    <i class="ki-filled ki-trash-square">
                    </i>
                </button>
                <span v-else >Not Attached</span>
            </td>
            <td class="text-gray-800 font-normal">
                <a v-if="offer.video_note" class="btn btn-primary" :href="offer.video_note" target="_blank">
                    Video Note
                </a>
                <button v-if="offer.video_note" type="button"
                        @click="deleteOfferVideo(offer, key, offerIndex)" style="position: relative;top: 20px;color: red; font-size: 18px;">
                    <i class="ki-filled ki-trash-square">
                    </i>
                </button>
                <span v-else >Not Attached</span>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ offer.created_at }}
            </td>
        </tr>
    </tbody>
</table>
